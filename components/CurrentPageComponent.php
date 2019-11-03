<?php


namespace app\components;


use yii\base\Component;

class CurrentPageComponent extends Component
{
  public function init()
  {
    parent::init();
  }

  public function setPage (CurrentPage $currentUrl): string
  {
    $currentUrl = \Yii::$app->request->getUrl();
    \Yii::$app->session->set('url','currentUrl');
  }

  public function getPage (CurrentPage $lastUrl): string
  {
    $lastUrl = \Yii::$app->session->get('url');
    if (!$lastUrl){
      $lastUrl = null;
    }
  }
}