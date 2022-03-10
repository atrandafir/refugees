<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\Vehicle;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VehicleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('back.vehicle', 'Vehicles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehicle-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('back.vehicle', 'Create Vehicle'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            
            [
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function(Vehicle $model) {
                    return $model->user?Html::encode($model->user->email):null;
                }  
            ],
            
            'driver_name',
//            'driver_phone',
//            'driver_document_number',
            'brand_model',
            'plate_number',
            'capacity',
            'im_available',
            'current_trip_id',
//            'current_location',
//            'lang',
            'created_at:datetime',
//            'updated_at:datetime',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Vehicle $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    </div>


</div>
