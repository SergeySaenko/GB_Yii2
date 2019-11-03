<?php


namespace app\components;


use yii\base\Component;

class CurrentPageComponent extends Component
{

  public $pageClass;

  public function init()
  {
    parent::init();
  }

  public function getPage()
  {
    return new $this->$pageClass;
  }

  public function setPage ()
  {
    $currentUrl = \Yii::$app->request->getUrl();
    \Yii::$app->session->set('url', $currentUrl);
  }

  public function lastPage ()
  {
    $lastUrl = \Yii::$app->session->get('url');
    if (!$lastUrl){
      $lastUrl = null;
    }
  }
}