<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Trip */

$this->title = Yii::t('back.trip', 'Create Trip');
$this->params['breadcrumbs'][] = ['label' => Yii::t('back.trip', 'Trips'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trip-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
