<?php
/**
 * @var $model \app\models\Activity
 * @var @this \yii\web\View
 */
?>
<h1><?=$model->title?></h1>
<h2><?=$model->date?></h2>
<h3><?=$model->description ? $model->description : '';?></h3>
<?= yii\helpers\Html::img('/files/'.$model->file, ['alt'=>$model->title])?>
