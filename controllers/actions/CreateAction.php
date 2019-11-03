<?php


namespace app\controllers\actions;


use app\base\BaseAction;
use app\models\Activity;

class CreateAction extends BaseAction
{
  public function run()
  {
    $model = new Activity();
    if (\Yii::$app->request->isPost){
      $model->load(\Yii::$app->request->post());
      if (!$model->validate()){
        \Yii::error($model->getErrors());
      }
    }
    return $this->controller->render('create',['model'=>$model]);
  }
}