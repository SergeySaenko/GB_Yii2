<?php
/**
 * @var $model \app\models\Activity
 * @var @this \yii\web\View
 */
$array = $model::FREQUENCY;
$frequency = yii\helpers\ArrayHelper::getValue($array,$model->frequency);
?>




<section class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-md-2 col-sm-12">
          <?= yii\helpers\Html::img('/files/'.$model->file, ['alt'=>$model->title, 'class'=>'img-fluid'])?>
        </div>
        <div class="col-lg-6 col-md-10 col-sm-12 px-2 py-4 information">
            <header><h2 class="text-left text-white p-3"><?=$model->title?></h2></header>
            <div class="bg-light p-3">
                <h4><?='Запланировано на     '.Yii::$app->formatter->asDate($model->date, 'short').
                  ($model->time ? ' в '.Yii::$app->formatter->asTime($model->time, 'short') :'')?></h4>
                <h5><?= $model->endDate ?
                    'Дата окончания '.Yii::$app->formatter->asDate($model->endDate, 'short') :''?></h5>
                <ul>
                    <li><?= $frequency ?></li>
                    <li><?= $model->isBlocking ? 'Обязательно пойти' : 'Не обязательно'?></li>
                    <li><?= $model->reminder ? 'Напомнить' : 'Не напоминать' ?></li>
                    <li><?= $model->email ? 'Напоминалка в ящик: '.$model->email : '' ?></li>
                </ul>
                <p><?=$model->description ? $model->description : '';?></p>
            </div>
        </div>
    </div>
</section>
