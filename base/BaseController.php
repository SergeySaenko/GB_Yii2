<?php


namespace app\base;


use yii\web\Controller;

class BaseController extends Controller
{
  public function beforeAction($action)
  {
    $lastPage = \Yii::$app->lastPage->lastPage();
    return parent::beforeAction($action);
  }

  public function afterAction($action, $result)
  {
    \Yii::$app->lastPage->setPage();
    return parent::afterAction($action, $result);
  }
}