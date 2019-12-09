<?php



/* @var $this \yii\web\View */
/* @var $model \app\models\ActivitySearch */
/* @var $provider \yii\data\ActiveDataFilter */
?>
<div class="row">
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
          ]
        ]
    ]);?>
  </div>
</div>
