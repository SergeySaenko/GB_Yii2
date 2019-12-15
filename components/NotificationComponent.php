<?php


namespace app\components;

use yii\console\Application;
use yii\mail\MailerInterface;
use yii\models\Activity;
use yii\base\Component;

class NotificationComponent extends Component
{
  /**
   * @var MailerInterface
   */
  private $mailer;

  public function getMailer(){
    return $this->mailer;
  }

  public function init()
  {
    parent::init();
    $this->mailer=\Yii::$app->mailer;
  }

  /**
   * @param Activity[] $activity
   */
  public function sendNotifications(array $activity)
  {
    foreach ($activity as $activity){
      $send=$this->getMailer()->compose('notif',['model'=>$activity])
        ->setSubject('Активность '.$activity->title.' начинается сегодня')
        ->setFrom('v4t4@yandex.ru')
        ->setTo($activity->email)
        ->send();

      if(!$send){
        if (\Yii::$app instanceof Application){
          echo 'Error email send to '.$activity->email;
        }
        return false;
      }

      if (\Yii::$app instanceof Application){
        echo 'Email send to '.$activity->email.PHP_EOL;
      }
    }
  }
}