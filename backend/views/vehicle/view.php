<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Vehicle;

/* @var $this yii\web\View */
/* @var $model common\models\Vehicle */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('back.vehicle', 'Vehicles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vehicle-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('back.vehicle', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('back.vehicle', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('back.vehicle', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function(Vehicle $model) {
                    return $model->user?Html::encode($model->user->email):null;
                }  
            ],
            'driver_name',
            'driver_phone',
            'driver_document_number',
            'brand_model',
            'plate_number',
            'capacity',
            'im_available',
            'current_trip_id',
            'current_location',
            'lang',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
