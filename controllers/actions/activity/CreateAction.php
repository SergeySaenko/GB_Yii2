<?php


namespace app\controllers\actions\activity;


use app\base\BaseAction;
use app\models\Activity;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

class CreateAction extends BaseAction
{
  public function run()
  {
    $model = \Yii::$app->activity->getModel();
    if (\Yii::$app->request->isPost){
      $model->load(\Yii::$app->request->post());
      if (\Yii::$app->request->isAjax){
        \Yii::$app->response->format=Response::FORMAT_JSON;
        return ActiveForm::validate($model);
      }
      if (!\Yii::$app->activity->addActivity($model)){
        print_r($model->getErrors());
      }else{
        return $this->controller->render('view', ['model'=>$model]);
      }
    }
    return $this->controller->render('create',['model'=>$model]);
  }
}