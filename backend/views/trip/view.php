<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\Trip;

/* @var $this yii\web\View */
/* @var $model common\models\Trip */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('back.trip', 'Trips'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trip-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('back.general', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('back.general', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('back.general', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'coordinator_id',
                'format' => 'raw',
                'value' => function(Trip $model) {
                    return $model->coordinator?Html::encode($model->coordinator->email):null;
                }  
            ],
            [
                'attribute' => 'vehicle_id',
                'format' => 'raw',
                'value' => function(Trip $model) {
                    return $model->vehicle?Html::encode($model->vehicle->title):null;
                }
            ],
            'leaving_from',
            'pickup_location',
            'destination_location',
            'current_location',
            'pickup_arrival_date:date',
            'destination_arrival_date:date',
//            'created_at',
//            'updated_at',
        ],
    ]) ?>

</div>
