<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

use common\models\Trip;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TripSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('back.trip', 'Trips');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trip-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('back.trip', 'Create Trip'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
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
            //'current_location',
            'pickup_arrival_date:date',
            'destination_arrival_date:date',
//            'created_at:datetime',
//            'updated_at:datetime',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Trip $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
