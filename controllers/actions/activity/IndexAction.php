<?php


namespace app\controllers\actions\activity;


use app\base\BaseAction;
use app\models\ActivitySearch;
use yii\bootstrap\ActiveForm;
use yii\web\HttpException;
use yii\web\Response;

class IndexAction extends BaseAction
{
  public function run()
  {
    if (!\Yii::$app->rbac->canCreateActivity()){
      throw new HttpException(403, 'Действие не авторизовано');
    }
    $model=new ActivitySearch();
    $provider=$model->search(\Yii::$app->request->getQueryParams());

    $events = array();
    //Testing
    $Event = new \yii2fullcalendar\models\Event();
    $Event->id = 1;
    $Event->title = 'Testing';
    $Event->start = date('Y-m-d\Th:m:s\Z');
    $events[] = $Event;

    $Event = new \yii2fullcalendar\models\Event();
    $Event->id = 2;
    $Event->title = 'Testing';
    $Event->start = date('Y-m-d\Th:m:s\Z',strtotime('tomorrow 6am'));
    $events[] = $Event;

    return $this->render('index', ['model'=>$model, 'provider'=>$provider, 'events' => $events]);
  }
}