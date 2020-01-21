<?php


namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\activity\CreateAction;
use app\controllers\actions\activity\IndexAction;
use app\models\Activity;
use app\models\ActivitySearch;
use yii\web\HttpException;

class ActivityController extends BaseController
{
  public function actions()
  {
    return [
      'create' =>['class'=>CreateAction::class],
      //'index' =>['class'=>IndexAction::class]
    ];
  }

  public function actionIndex() {
    $model=new ActivitySearch();
    $provider=$model->search(\Yii::$app->request->getQueryParams());

/*    $events = array();
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
    $events[] = $Event;*/

    $events = Activity::find()->all();
    foreach ($events as $event)
    {
      $Event = new \yii2fullcalendar\models\Event();
      $Event->id = $event->id;
      $Event->title = $event->title;
      $Event->start = $event->date;
      //$Event->time = $event->time;
      $events[] = $Event;
    }

    return $this->render('index', ['model'=>$model, 'provider'=>$provider, 'events' => $events]);
  }

  public function actionView($id)
  {
    if(empty($id)){
      return $this->redirect(['/activity/index']);
    }
    $model=Activity::findOne($id);

    if (!\Yii::$app->rbac->canViewActivity($model)) {
      throw new HttpException(403, 'Нет доступа к активности');
    }

    if (!$model){
      throw new HttpException(404, 'Активности не существует');
    }

    return $this->render('view',['model'=>$model]);
  }
}