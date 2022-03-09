<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use common\models\Refugee;

/* @var $this yii\web\View */
/* @var $model common\models\Refugee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="refugee-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint(Yii::t('front.refugees', 'Enter your full name, including first name and last name')) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->hint(Yii::t('front.refugees', 'Phone number including country prefix, example: +34600123123')) ?>
    
    <div class="form-row">
        <div class="col-sm-6">
            <?= $form->field($model, 'document_number')->textInput(['maxlength' => true])->hint(Yii::t('front.refugees', 'Passport or national ID number')) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'age')->textInput() ?>
        </div>
    </div>

    <?= $form->field($model, 'gender')->radioList(Refugee::getGenderList(), ['prompt'=>'']) ?>

    <div class="form-row">
        <div class="col-sm-6">
            <?= $form->field($model, 'pickup_location')->textInput(['maxlength' => true])->hint(Yii::t('front.refugees', 'Place in your country, or close to, where the driver will pick you up')) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'destination_location')->textInput(['maxlength' => true])->hint(Yii::t('front.refugees', 'Your destination city in Spain')) ?>
        </div>
    </div>

    <?= $form->field($model, 'special_needs')->textarea(['rows' => 3])->hint(Yii::t('front.refugees', 'For example: needs for an illness that requires medication or treatment or a disability, etc.')) ?>

    <?= $form->field($model, 'lang')->dropDownList(Yii::$app->params['languages'], ['prompt'=>''])->hint(Yii::t('front.refugees', 'Chose the language for communications.')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('front.general', 'Save'), ['class' => 'btn btn-success']) ?>
        <?php echo Html::a(Yii::t('front.general', 'Cancel'), ['index'], [
            'class'=>'btn btn-link',
        ]); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>