<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\House */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="house-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
    ]); ?>
    
    <?= $form->field($model, 'host_name')->textInput(['maxlength' => true])->hint(Yii::t('front.houses', 'Name and surname of the host')) ?>

    <?= $form->field($model, 'host_phone')->textInput(['maxlength' => true])->hint(Yii::t('front.houses', 'Mobile number of the host where to be reached at all times')) ?>

    <?= $form->field($model, 'host_document_number')->textInput(['maxlength' => true])->hint(Yii::t('front.houses', 'Passport or national ID number of the host')) ?>    
    
    <div class="form-row">
        <div class="col-sm-6">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true])->hint(Yii::t('front.houses', 'Full address of the home where the accommodation will be made')) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'postal_code')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-6">
            <?= $form->field($model, 'rooms')->textInput()->hint(Yii::t('front.houses', 'Number of rooms available to accommodate travelers')) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'capacity')->textInput()->hint(Yii::t('front.houses', 'Number of people you can accommodate')) ?>
        </div>
    </div>

    <?= $form->field($model, 'availability_date')->widget(DatePicker::className(),[
        'dateFormat'=>'php:Y-m-d',
        'options'=>[
            'class'=>'form-control',
            'autocomplete'=>'off'
        ],
        'clientOptions' => [
        
        ]
    ])->hint(Yii::t('front.houses', 'Date on which the accommodation will be available')) ?>

    <?= $form->field($model, 'lang')->dropDownList(Yii::$app->params['languages'], ['prompt'=>''])->hint(Yii::t('front.houses', 'Chose the language for communications.')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('front.general', 'Save'), ['class' => 'btn btn-success']) ?>
        <?php echo Html::a(Yii::t('front.general', 'Cancel'), ['index'], [
            'class'=>'btn btn-link',
        ]); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>