<?php


namespace app\behaviors;


use yii\base\Behavior;

class DateCreatedBehaviors extends Behavior
{
  public $attributeName;

  public function getDateCreated(){
    return $this->owner->{$this->attributeName};
  }
}