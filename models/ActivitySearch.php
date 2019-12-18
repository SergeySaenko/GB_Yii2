<?php


namespace app\models;


use yii\data\ActiveDataProvider;

class ActivitySearch extends Activity
{
  public function search($params=[]): ActiveDataProvider
  {
    $query=Activity::find();

    $provider=new ActiveDataProvider(
      [
        'query' => $query,
        'sort'  => [
          'defaultOrder'  => [
            'date'  =>  SORT_DESC
          ]
        ]/*,
        'pagination' => [
          'pageSize' => 5
        ]*/
      ]
    );
    $query->with('user');
    $query->andFilterWhere(['title'=>$this->title]);

    return $provider;
  }
}