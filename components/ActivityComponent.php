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

    if ($activity->validate()) {
      if ($activity->file && !\Yii::$app->fileSaver->saveFile($activity->file)){
        return false;
      }
      return true;
    }
     return false;
  }

//  private function saveFile(UploadedFile $file): ?string{
//    $name=$this->genFileName($file);
//    $path=$this->getPathToSave().$name;
//
//    if ($file->saveAs($path)){
//      return $name;
//    }
//    return null;
//  }
//
//  private function getPathToSave(){
//    $path = \Yii::getAlias('@webroot/files/');
//    FileHelper::createDirectory($path);
//    return $path;
//  }
//
//  private function genFileName(UploadedFile $file){
//    return time().$file->getBaseName().'.'.$file->getExtension();
//  }
}