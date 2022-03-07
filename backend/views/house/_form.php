<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

use yii\helpers\ArrayHelper;
use common\models\User;

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

use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\House */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="house-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'user_id')->dropDownList($user_id_options,['prompt'=>''])
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

<script>
    function house_init_form() {
        $('#house-user_id').select2({
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
house_init_form();
JS;

$this->registerJs($script); // Registro el script javascript en el view 
?>