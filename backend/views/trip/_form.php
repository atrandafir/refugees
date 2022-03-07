<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

use yii\helpers\ArrayHelper;
use common\models\User;
use common\models\Vehicle;

use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Trip */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trip-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'coordinator_id')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'email'),['prompt'=>''])
            ->hint(Yii::t('back.trip', 'Set the coordinator that will plan the trip details')) ?>
    <?= $form->field($model, 'vehicle_id')->dropDownList(ArrayHelper::map(Vehicle::find()->all(), 'id', 'title'),['prompt'=>'']) ?>

    <?= $form->field($model, 'leaving_from')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'pickup_arrival_date')->widget(DatePicker::className(),[
        'dateFormat'=>'php:Y-m-d',
        'options'=>[
            'class'=>'form-control',
        ],
        'clientOptions' => [
        
        ]
    ]) ?>
    <?= $form->field($model, 'destination_arrival_date')->widget(DatePicker::className(),[
        'dateFormat'=>'php:Y-m-d',
        'options'=>[
            'class'=>'form-control',
        ],
        'clientOptions' => [
        
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('back.trip', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
