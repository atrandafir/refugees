<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Trip */

$this->title = Yii::t('back.trip', 'Update Trip: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('back.trip', 'Trips'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('back.trip', 'Update');
?>
<div class="trip-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
