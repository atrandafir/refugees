<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

use yii\helpers\ArrayHelper;
use common\models\User;

use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\House */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="house-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'email'),['prompt'=>''])
            ->hint(Yii::t('back.house', 'Link this house to an existing user account')) ?>

    <?= $form->field($model, 'host_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'host_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'host_document_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'postal_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'capacity')->textInput() ?>

    <?= $form->field($model, 'rooms')->textInput() ?>

    <?= $form->field($model, 'availability_date')->widget(DatePicker::className(),[
        'dateFormat'=>'php:Y-m-d',
        'options'=>[
            'class'=>'form-control',
        ],
        'clientOptions' => [
        
        ]
    ]) ?>


    <?= $form->field($model, 'lang')->dropDownList(Yii::$app->params['languages'], ['prompt'=>''])->hint(Yii::t('back.house', 'Chose the host language for communications.')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('back.house', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
