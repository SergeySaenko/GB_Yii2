<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActivityS */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Activities';
$this->params['breadcrumbs'][] = $this->title;
$dependency = [
  'class' => 'yii\caching\DbDependency',
  'sql' => 'select max(id) from activity',
];
?>
<div class="activity-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Activity', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if($this->beginCache('activityIndexC',['dependency' => $dependency])):?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description:ntext',
            'date',
            'time',
            //'isBlocking',
            //'frequency',
            //'reminder',
            //'email:email',
            //'file',
            //'createAt',
            //'userId',
            //'endDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php $this->endCache(); endif;?>

</div>
