<?php


namespace app\components;


use app\models\Activity;
use yii\base\Component;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class ActivityComponent extends Component
{
  public $modelClass;

  public function init()
  {
    parent::init();
  }

  public function getModel()
    {
      return new $this->modelClass;
    }

  public function addActivity (Activity $activity): bool
  {
    $activity->file=UploadedFile::getInstance($activity, 'file');
    $activity->userId=\Yii::$app->user->getIdentity()->id;
      if ($activity->file){
        $activity->file=\Yii::$app->fileSaver->saveFile($activity->file);
        if(!$activity->file){
          return false;
        }
      }
      if(!$activity->save()){
        return false;
      }
      return true;
  }

  public function findTodayNotification(){
    return Activity::find()->andWhere('email is not null')
      ->andWhere('date>=:today',[':today'=>date('Y-m-d')])
      ->andWhere('date<=:tomorrow',[':tomorrow'=>date('Y-m-d').' 23:59:59'])
      ->all();
  }
}