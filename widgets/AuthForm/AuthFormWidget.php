<?php


namespace app\widgets\AuthForm;


use yii\bootstrap\Widget;

class AuthFormWidget extends Widget
{
  public $title;

  public $model;

  public function run()
  {
    return $this->render('form', ['title'=>$this->title, 'model'=>$this->model]);
  }
}