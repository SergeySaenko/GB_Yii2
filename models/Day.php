<?php


namespace app\models;


use app\base\BaseModel;

class Day extends BaseModel
{
  public $name;

  public $weekend;

  public $connectedActivity;

  public function rules()
  {
    return [
      ['name', 'required', 'string'],
      ['weekend', 'required', 'boolean'],
      ['connectedActivity', 'string']
    ];
  }
}