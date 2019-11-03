<?php


namespace app\models;


use app\base\BaseModel;

class Activity extends BaseModel
{
  public $title;

  public $description;

  public $date;

  public $time;

  public $isBlocking;

  public $repeatable;

  public function rules()
  {
    return [
      ['title', 'required'],
      ["description", 'string', 'max' => 250],
      ['date', 'string'],
      ['time', 'string'],
      [['isBlocking', 'repeatable'], 'boolean']
    ];
  }

  public function attributeLabels()
  {
    return [
      'title' => 'Заголовок',
      'description' => 'Описание',
      'date' => 'Дата',
      'time' => 'Время',
      'isBlocking' => 'Блокирующее',
      'repeatable' => 'Повторяющееся'
    ];
  }
}