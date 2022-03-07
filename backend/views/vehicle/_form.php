<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;
use common\models\Trip;
use yii\helpers\Url;

$user_id_options=[
    ''=>'',
];

if ($model->user_id) {
    $user=User::findOne($model->user_id);
    if ($user) {
        $user_id_options[$user->id]=$user->email;
    }
}

/* @var $this yii\web\View */
/* @var $model common\models\Vehicle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicle-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList($user_id_options,['prompt'=>''])
            ->hint(Yii::t('back.vehicle', 'Link this vehicle to an existing user account')) ?>

    <?= $form->field($model, 'driver_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'driver_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'driver_document_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brand_model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plate_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'capacity')->textInput()->hint(Yii::t('back.vehicle', 'Number of people your vehicle can carry (excluding seats occupied by the driver)')) ?>

    <?= $form->field($model, 'im_available')->checkbox()->hint(Yii::t('back.vehicle', 'Uncheck this box if vehicle is currently not available for trips')) ?>

    <?= $form->field($model, 'current_trip_id')->dropDownList(ArrayHelper::map(Trip::find()->all(), 'id', 'id'),['prompt'=>''])->hint(Yii::t('back.vehicle', 'Is this vehicle currently on a trip?')) ?>

    <?= $form->field($model, 'current_location')->textInput(['maxlength' => true])->hint(Yii::t('back.vehicle', 'Current location can be updated to keep track of where the vehicle is right now')) ?>

    <?= $form->field($model, 'lang')->dropDownList(Yii::$app->params['languages'], ['prompt'=>''])->hint(Yii::t('back.vehicle', 'Chose the driver\'s preferred language for communications.')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('back.vehicle', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    function vehicle_init_form() {
        $('#vehicle-user_id').select2({
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
vehicle_init_form();
JS;

$this->registerJs($script); // Registro el script javascript en el view 
?>