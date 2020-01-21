<?php



/* @var $this \yii\web\View */
/* @var $model \app\models\ActivitySearch */
/* @var $provider \yii\data\ActiveDataFilter */
/* @var $events \app\controllers\actions\activity\IndexAction */

$dependency = [
  'class' => 'yii\caching\DbDependency',
  'sql' => 'select max(id) from activity',
];


?>
<div class="row">
    <?= \yii2fullcalendar\yii2fullcalendar::widget(['options' => ['lang' => 'ru'], 'events' => $events]); ?>
  <?php if($this->beginCache('activityIndex0',['dependency' => $dependency])):?>
  <div class="col-md-12">
    <?= \yii\grid\GridView::widget([
        //['class' => \yii\grid\SerialColumn::class],
        'dataProvider' => $provider,
        'filterModel' => $model,
        'rowOptions' => function($model, $key, $index, $grid){
        $class=$index%2?'odd':'even';
        return ['key'=>$key, 'index'=>$index, 'class'=>$class];
        },
        'columns' => [
          ['class' => \yii\grid\SerialColumn::class],
          'id',
          ['attribute' => 'title',
           'label' => 'Название',
            'value' => function($model){
                return \yii\bootstrap\Html::a(\yii\helpers\Html::encode($model->title), ['/activity/view','id'=>$model->id ]);
            },
            'format' => 'raw'
            ],
          'date',
          [
            'attribute' => 'user.email'
          ],
          [
            'attribute' =>  'createAt',
            'value' =>  function (\app\models\Activity $model){
              return $model->getDateCreated();
            }
          ]
        ]
    ]);?>
  </div>
  <?php $this->endCache(); endif;?>
</div>
