<?php


namespace app\components\notifications;


use app\models\Activity;

interface Notification
{
  /**
   * @param Activity[] $activity
   * @return bool
   */

  public function sendNotifications(array $activity):bool;
}