<?php
/**
 * @var $model \app\models\Activity
 */
?>
<h1>Новая активность</h1>
<div class="row">
    <div class="col-md-8">
        <?php $form = \yii\bootstrap\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>
            <?=$form->field($model,'title');?>
            <?=$form->field($model,'description')->textarea();?>
            <?=$form->field($model,'date')->input('date');?>
            <?=$form->field($model,'time')->input('time');?>
            <?=$form->field($model,'endDate')->input('date');?>
            <?=$form->field($model,'isBlocking')->checkbox();?>
            <?=$form->field($model,'frequency')->dropDownList($model::FREQUENCY);?>
            <?=$form->field($model,'reminder')->checkbox();?>
            <?=$form->field($model,'email', ['enableClientValidation' => false, 'enableAjaxValidation' => true ]);?>
            <?=$form->field($model,'file')->fileInput();?>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end();?>
    </div>
</div>
