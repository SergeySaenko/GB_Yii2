<?php


namespace app\controllers;


use app\base\BaseController;
use app\components\DAOComponent;
use yii\filters\PageCache;

class DaoController extends BaseController
{
  /** @var DAOComponent */
  private $dao;

  public function behaviors()
  {
    return [
      ['class'=>PageCache::class, 'only'=>['test'], 'duration' => 20]
    ];
  }

  public function __construct($id, $module, $config = [])
  {
    $this->dao=\Yii::$app->dao;
    parent::__construct($id, $module, $config);
  }

  public function actionC()
  {
    \Yii::$app->cache->set('key1','value1');
    $val=\Yii::$app->cache->get('key1');

    $val2=\Yii::$app->cache->getOrSet('key2',function (){
      return 'val22';
    });
    echo $val.'</br>';
    echo $val2;
  }


  public function actionTest($userId='')
  {
//    $this->dao->insertTransactions();
    $users=$this->dao->getUsersList();
    $activityUser=$this->dao->getActivityUser($userId);
    $activity=$this->dao->getFirstActivity();
    $count=$this->dao->getCountActivity();
    $reader=$this->dao->getActivityReader();
    return $this->render('test',[
      'users'=>$users,
      'activityUser'=>$activityUser,
      'activity'=>$activity,
      'count'=>$count,
      'reader'=>$reader
    ]);
  }
}