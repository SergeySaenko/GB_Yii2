<?php
namespace app\components;
use yii\base\Component;
use yii\caching\DbDependency;
use yii\caching\TagDependency;
use yii\db\Connection;
use yii\db\Exception;
use yii\db\Query;
class DAOComponent extends Component
{
  private function getConnection(): Connection
  {
    return \Yii::$app->db;
  }

  public function getUsersList(): ?array
  {
    $sql='select * from users;';
    return $this->getConnection()->createCommand($sql)->cache(10)->queryAll();
  }

  public function getActivityUser($userId): ?array
  {
    $sql='select * from activity where userId=:user';
    return $this->getConnection()->createCommand($sql,[':user'=>$userId])->cache(10, new DbDependency(['sql' => 'select max(id) from activity']))->queryAll();
  }

  public function getFirstActivity()
  {
//    TagDependency::invalidate(\Yii::$app->cache,'tag1');
    $query=new Query();
    $record=$query->from('activity')
      ->select('*')
      ->andWhere(['isBlocking'=>1])
      ->limit(2)
      ->orderBy(['date'=>SORT_DESC])
      ->cache(10,new TagDependency(['tags'=>'tag1']))
      ->one($this->getConnection());
    return $record;
  }
  public function getCountActivity()
  {
    $query=new Query();
    $record=$query->from('activity')
      ->select('count(id)')
      ->cache(10)
      ->scalar($this->getConnection());
    return $record;
  }

  public function getActivityReader(){ //для больших объемов данных
    $query=new Query();
    $record=$query->from('activity')
                  ->createCommand()->query();
    return $record;
  }
  public function insertTransactions()
  {
    $trans = $this->getConnection()->beginTransaction();
    try {
      $i = $this->getConnection()
        ->createCommand()
        ->insert('activity', ['title' => 'new1', 'userID' => 1, 'date' => date('Y-m-d')])
        ->execute();

      $this->getConnection()->createCommand()
        ->update('activity', ['title' => 'update1'], ['id' => 1])
        ->execute();

      $trans->commit();

    } catch (\Exception $e) {
      $trans->rollBack();
      \Yii::error($e->getTrace());
    }
  }
}