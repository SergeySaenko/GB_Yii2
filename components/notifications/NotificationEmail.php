<?php


namespace app\components\notifications;


use app\components\logger\Logger;
use app\models\Activity;
use yii\console\Application;
use yii\mail\MailerInterface;

class NotificationEmail implements Notification
{

  private $mailer;
  private $logger;

  public function __construct(MailerInterface $mailer, Logger $logger)
  {
    $this->logger=$logger;
    $this->mailer=$mailer;
  }


  /**
   * @param Activity[] $activity
   * @return bool
   */
  public function sendNotifications(array $activity): bool
  {
    foreach ($activity as $activity){
      $send=$this->mailer()->compose('notif',['model'=>$activity])
        ->setSubject('Активность '.$activity->title.' начинается сегодня')
        ->setFrom('v4t4@yandex.ru')
        ->setTo($activity->email)
        ->send();

      if(!$send){
          $this->logger->log('Error email send to '.$activity->email);
        return false;
      }
      $this->logger->log('Email send to '.$activity->email.PHP_EOL);
    }
    return true;
  }
}