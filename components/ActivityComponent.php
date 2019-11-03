<?php


namespace app\components;


use app\models\Activity;
use yii\base\Component;

class ActivityComponent extends Component
{
  public $modelClass;

  public function init()
  {
    parent::init();
  }

  public function getModel()
    {
      return new $this->modelClass;
    }
  public function addActivity (Activity $activity): bool
  {
    if ($activity->validate()) {
      return true;
    }
     return false;
  }
}