<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Vehicle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicle-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
    ]); ?>
    
    <?= $form->field($model, 'driver_name')->textInput(['maxlength' => true])->hint(Yii::t('front.vehicles', 'Name of the driver or person coordinating the trip')) ?>

    <?= $form->field($model, 'driver_phone')->textInput(['maxlength' => true])->hint(Yii::t('front.vehicles', 'Mobile number of the driver where it can be reached at all times.')) ?>

    <?= $form->field($model, 'driver_document_number')->textInput(['maxlength' => true])->hint(Yii::t('front.vehicles', 'Passport or national ID number of the driver')) ?>

    <?= $form->field($model, 'brand_model')->textInput(['maxlength' => true])->hint(Yii::t('front.vehicles', 'Make and model of the vehicle with which you will make the trip')) ?>

    <?= $form->field($model, 'plate_number')->textInput(['maxlength' => true])->hint(Yii::t('front.vehicles', 'Example: 9455FGS')) ?>

    <?= $form->field($model, 'capacity')->textInput()->hint(Yii::t('front.vehicles', 'Number of people your vehicle can carry (excluding seats occupied by the driver)')) ?>

    <?= $form->field($model, 'im_available')->checkbox()->hint(Yii::t('front.vehicles', 'Uncheck this box if vehicle is currently not available for trips')) ?>

    <?= $form->field($model, 'lang')->dropDownList(Yii::$app->params['languages'], ['prompt'=>''])->hint(Yii::t('front.vehicles', 'Chose the language for communications.')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('front.general', 'Save'), ['class' => 'btn btn-success']) ?>
        <?php echo Html::a(Yii::t('front.general', 'Cancel'), ['index'], [
            'class'=>'btn btn-link',
        ]); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>