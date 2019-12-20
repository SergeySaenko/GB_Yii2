<?php


namespace app\commands;


use app\components\notifications\Notification;
use yii\console\Controller;
use yii\helpers\Console;

class NotificationController extends Controller
{
  public $name;

  private $notification;

  public function __construct($id, $module, Notification $notification, $config = [])
  {
    $this->notification=$notification;
    parent::__construct($id, $module, $config);
  }

  public function options($actionID)
  {
    return ['name'];
  }

  public function optionAliases()
  {
    return [
      'n'=>'name'
    ];
  }

  public function actionTest(...$args){
    echo 'test action '.$this->name.PHP_EOL;

    print_r($args);
  }

  public function actionSendTodayActivity()
  {
    $activities=\Yii::$app->activity->findTodayNotification();
    if(count($activities)==0){
      \Yii::$app->end(0);
    }

    echo Console::ansiFormat('Count activity:'.count($activities),[Console::BG_GREEN, Console::FG_BLACK]).PHP_EOL;

    $this->notification->sendNotifications($activities);
  }
}