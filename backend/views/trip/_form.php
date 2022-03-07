<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

use yii\helpers\ArrayHelper;
use common\models\User;
use common\models\Vehicle;
use yii\helpers\Url;

use yii\jui\DatePicker;

$coordinator_id_options=[
    ''=>'',
];

if ($model->coordinator_id) {
    $user=User::findOne($model->coordinator_id);
    if ($user) {
        $coordinator_id_options[$user->id]=$user->email;
    }
}

/* @var $this yii\web\View */
/* @var $model common\models\Trip */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trip-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'coordinator_id')->dropDownList($coordinator_id_options,[])
            ->hint(Yii::t('back.trip', 'Set the coordinator that will plan the trip details')) ?>
    
    <?= $form->field($model, 'vehicle_id')->dropDownList(ArrayHelper::map(Vehicle::find()->all(), 'id', 'title'),['prompt'=>'']) ?>

    <?= $form->field($model, 'leaving_from')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'pickup_location')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'destination_location')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'pickup_arrival_date')->widget(DatePicker::className(),[
        'dateFormat'=>'php:Y-m-d',
        'options'=>[
            'class'=>'form-control',
        ],
        'clientOptions' => [
        
        ]
    ])->hint(Yii::t('back.trip', 'Expected date of arrival at the town where the assigned travelers will be picked up')) ?>
    <?= $form->field($model, 'destination_arrival_date')->widget(DatePicker::className(),[
        'dateFormat'=>'php:Y-m-d',
        'options'=>[
            'class'=>'form-control',
        ],
        'clientOptions' => [
        
        ]
    ])->hint(Yii::t('back.trip', 'Expected date of arrival at the destination town in Spain')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('back.trip', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    function trip_init_form() {
        $('#trip-coordinator_id').select2({
            theme: 'bootstrap4',
            ajax: {
              url: '<?php echo Url::to(['/user/select2']) ?>',
              dataType: 'json',
              processResults: function (response) {
                return {
                    results: response
                };
              }
            }
        });
    }
</script>

<?php
$script = <<<JS
trip_init_form();
JS;

$this->registerJs($script); // Registro el script javascript en el view 
?>