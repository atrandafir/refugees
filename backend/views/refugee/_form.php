<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use common\models\Refugee;

/* @var $this yii\web\View */
/* @var $model common\models\Refugee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="refugee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'document_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'gender')->dropDownList(Refugee::getGenderList(), ['prompt'=>'']) ?>

    <?= $form->field($model, 'pickup_location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'destination_location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'special_needs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lang')->dropDownList(Yii::$app->params['languages'], ['prompt'=>''])->hint(Yii::t('back.vehicle', 'Chose the person\'s language for communications.')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('back.refugee', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
