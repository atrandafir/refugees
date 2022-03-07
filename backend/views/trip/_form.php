<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Trip */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trip-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'coordinator_id')->textInput() ?>

    <?= $form->field($model, 'leaving_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'current_location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pickup_arrival_date')->textInput() ?>

    <?= $form->field($model, 'destination_arrival_date')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('back.trip', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
