<?php


namespace app\models;


use app\base\BaseModel;
use app\behaviors\DateCreatedBehaviors;
use app\behaviors\LogBehavior;

class Activity extends ActivityBase
{

  const NON_REPEATABLE = 0;
  const DAY = 1;
  const WEEK = 2;
  const MONTH = 3;
  const FREQUENCY = [self::NON_REPEATABLE=>"Без повторений", self::DAY=>"Каждый день", self::WEEK=>"Каждую неделю", self::MONTH=>"Каждый месяц"];

  public function behaviors()
  {
    return [
      ['class'=>DateCreatedBehaviors::class, 'attributeName'=>'createAt'],
      LogBehavior::class
    ];
  }

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
    return array_merge([
      ['title', 'trim'],
      ['file', 'file', 'extensions' => 'png, jpg'],
      [['title', 'date', 'frequency'], 'required'],
      ['description', 'string', 'max' => 250, 'min' => 5],
      ['description', 'default', 'value'=>$this->title],
      ['time', 'string'],
      [['date', 'endDate'], 'date', 'format' => 'php:Y-m-d'],
      ['endDate', 'default', 'value'=>$this->date],
      [['isBlocking', 'reminder'], 'boolean'],
      ['email', 'email'],
      ['email', 'required', 'when' => function($model){
        return $model->reminder;
      }],
      ['frequency', 'in', 'range' => array_keys( self::FREQUENCY)]
    ], parent::rules());
  }

  public function attributeLabels()
  {
    return [
      'title' => 'Заголовок',
      'description' => 'Описание',
      'date' => 'Дата начала',
      'time' => 'Время',
      'endDate' => 'Дата окончания',
      'isBlocking' => 'Блокирующее',
      'frequency' => 'Повторить',
      'reminder' => 'Напоминание',
      'email' => 'Эл.почта',
      'file' => 'Файл'
    ];
  }
}