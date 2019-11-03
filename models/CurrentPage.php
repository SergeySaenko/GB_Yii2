<?php


namespace app\models;


use app\base\BaseModel;

class CurrentPage extends BaseModel
{
  public $currentUrl;

  public $lastUrl;

  public function rules()
  {
    return [
      [['currentUrl', 'lastUrl'], 'string']
    ];
  }
}