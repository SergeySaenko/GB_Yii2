<?php


namespace app\base;


use yii\web\Controller;
use yii\web\HttpException;

class BaseController extends Controller
{
  public function beforeAction($action)
  {
    if (\Yii::$app->user->isGuest){
      throw new HttpException(401, 'Пользователь не авторизован');
    }

    $lastPage = \Yii::$app->lastPage->lastPage();
    return parent::beforeAction($action);
  }

  public function afterAction($action, $result)
  {
    \Yii::$app->lastPage->setPage();
    return parent::afterAction($action, $result);
  }
}