<?php


namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\activity\CreateAction;
use app\models\Activity;
use yii\web\HttpException;

class ActivityController extends BaseController
{
  public function actions()
  {
    return [
      'create' =>['class'=>CreateAction::class],
    ];
  }

  public function actionView($id)
  {
    $model=Activity::findOne($id);

    if (!\Yii::$app->rbac->canViewActivity($model)) {
      throw new HttpException(403, 'Нет доступа к активноти');
    }

    if (!$model){
      throw new HttpException(404, 'Активности не сущеивует');
    }

    return $this->render('view',['model'=>$model]);
  }
}