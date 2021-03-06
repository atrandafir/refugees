<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Refugee */

$this->title = Yii::t('back.refugee', 'Update Refugee: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('back.refugee', 'Refugees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('back.general', 'Update');
?>
<div class="refugee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
