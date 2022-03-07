<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Vehicle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicle-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'driver_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'driver_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'driver_document_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brand_model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plate_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'capacity')->textInput() ?>

    <?= $form->field($model, 'im_available')->textInput() ?>

    <?= $form->field($model, 'current_trip_id')->textInput() ?>

    <?= $form->field($model, 'current_location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('back.vehicle', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
