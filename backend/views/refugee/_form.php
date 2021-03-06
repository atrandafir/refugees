<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use common\models\Refugee;
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

/* @var $this yii\web\View */
/* @var $model common\models\Refugee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="refugee-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'user_id')->dropDownList($user_id_options,['prompt'=>''])
            ->hint(Yii::t('back.refugee', 'Link this refugee to an existing user account')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'document_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'gender')->radioList(Refugee::getGenderList(), ['prompt'=>'']) ?>

    <?= $form->field($model, 'pickup_location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'destination_location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'special_needs')->textarea(['rows' => 6])->hint(Yii::t('back.refugee', 'For example: needs for an illness that requires medication or treatment or a disability, etc.')) ?>

    <?= $form->field($model, 'lang')->dropDownList(Yii::$app->params['languages'], ['prompt'=>''])->hint(Yii::t('back.refugee', 'Chose the person\'s language for communications.')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('back.general', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    function refugee_init_form() {
        $('#refugee-user_id').select2({
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
refugee_init_form();
JS;

$this->registerJs($script); // Registro el script javascript en el view 
?>