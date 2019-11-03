<?php


namespace app\controllers\actions;


use app\base\BaseAction;
use app\models\Activity;

class CreateAction extends BaseAction
{
  public function run()
  {
    $model = \Yii::$app->activity->getModel();
    if (\Yii::$app->request->isPost){
      $model->load(\Yii::$app->request->post());
      if (\Yii::$app->activity->addActivity($model)){

      }
    }
    return $this->controller->render('create',['model'=>$model]);
  }
}