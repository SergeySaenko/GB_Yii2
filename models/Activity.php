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
  public $frequency;

  const NON_REPEATABLE = 0;
  const DAY = 1;
  const WEEK = 2;
  const MONTH = 3;
  const FREQUENCY = [self::NON_REPEATABLE=>"Без повторений", self::DAY=>"Каждый день", self::WEEK=>"Каждую неделю", self::MONTH=>"Каждый месяц"];

  public $reminder;
  public $email;
  public $file;

  public function beforeValidate()
  {
    if (!empty($this->date)){
      $date=\DateTime::createFromFormat('d.m.Y', $this->date);
      if ($date){
        $this->date=$date->format('Y.m.d');
      }
    }
    return parent::beforeValidate();
  }

  public function rules()
  {
    return [
      ['title', 'trim'],
      ['file', 'file', 'extensions' => 'png, jpg'],
      [['title', 'date', 'frequency'], 'required'],
      ['description', 'string', 'max' => 250, 'min' => 5],
      //['description', 'defaultValue'=>$this->title],
      [['date', 'time'], 'string'],
      ['date', 'date', 'format' => 'php:Y-m-d'],
      [['isBlocking', 'reminder'], 'boolean'],
      ['email', 'email'],
      ['email', 'required', 'when' => function($model){
        return $model->reminder;
      }],
      ['frequency', 'in', 'range' => array_keys( self::FREQUENCY)]
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
      'frequency' => 'Повторить',
      'reminder' => 'Напоминание',
      'email' => 'Эл.почта',
      'file' => 'Файл'
    ];
  }
}