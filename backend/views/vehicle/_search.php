<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VehicleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicle-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'driver_name') ?>

    <?= $form->field($model, 'driver_phone') ?>

    <?= $form->field($model, 'driver_document_number') ?>

    <?php // echo $form->field($model, 'brand_model') ?>

    <?php // echo $form->field($model, 'plate_number') ?>

    <?php // echo $form->field($model, 'capacity') ?>

    <?php // echo $form->field($model, 'im_available') ?>

    <?php // echo $form->field($model, 'current_trip_id') ?>

    <?php // echo $form->field($model, 'current_location') ?>

    <?php // echo $form->field($model, 'lang') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('back.vehicle', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('back.vehicle', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
