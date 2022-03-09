<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use common\models\Trip;
use common\models\TripPassenger;
use common\models\Vehicle;

/* @var $this yii\web\View */
/* @var $model common\models\Vehicle */

?>
<div class="vehicle-view" style="margin-top: 40px;">
    
    <div class="row">
        <div class="col-sm-6">
            <h2><?= Html::encode($model->title) ?></h2>
        </div>
        <div class="col-sm-6">
            <p class="float-sm-right">
                <?= Html::a(Yii::t('front.general', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-secondary']) ?>
                <?= Html::a(Yii::t('front.general', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-sm btn-danger',
                    'data' => [
                        'confirm' => Yii::t('front.general', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>

    <?= DetailView::widget([
        'options'=>[
            'class' => 'table table-striped table-bordered detail-view table-sm'
        ],
        'model' => $model,
        'attributes' => [
            'driver_name',
            'driver_phone',
            'driver_document_number',
            'brand_model',
            'plate_number',
            'capacity',
            [
                'attribute'=>'im_available',
                'value' => function(Vehicle $model) {
                    return $model->im_available?Yii::t('general', 'Yes'):Yii::t('general', 'No');
                }
            ],
            'lang',
            'created_at:datetime',
        ],
    ]) ?>
    
    <?php
    $tripsDataProvider = new ActiveDataProvider([
        'query' => Trip::find()->where(['vehicle_id'=>$model->id]),
        'pagination' => false,
        'sort' => false,
    ]);
    $trips=$tripsDataProvider->getModels();
    ?>
    <?php if ($trips): ?>
        <p class="text-center text-muted"><?php echo Yii::t('front.vehicles', 'Trips assigned to this vehicle'); ?></p>
        
        <?php foreach ($trips as $trip): ?>
        
            <h3><?php echo Yii::t('front.vehicles', 'Trip Number'); ?> #<?php echo $trip->id; ?></h3>
            
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                       <tr>
                          <th><?php echo $trip->getAttributeLabel('leaving_from'); ?></th>
                          <th><?php echo $trip->getAttributeLabel('pickup_location'); ?></th>
                          <th><?php echo $trip->getAttributeLabel('destination_location'); ?></th>
                          <th><?php echo $trip->getAttributeLabel('pickup_arrival_date'); ?></th>
                          <th><?php echo $trip->getAttributeLabel('destination_arrival_date'); ?></th>
                       </tr>
                    </thead>
                    <tbody>
                       <tr>
                            <td><?php echo Html::encode($trip->leaving_from); ?></td>
                            <td><?php echo Html::encode($trip->pickup_location); ?></td>
                            <td><?php echo Html::encode($trip->destination_location); ?></td>
                            <td><?php echo Yii::$app->formatter->asDate($trip->pickup_arrival_date); ?></td>
                            <td><?php echo Yii::$app->formatter->asDate($trip->destination_arrival_date); ?></td>
                       </tr>
                    </tbody>
                </table>
            </div>

            <?php
            $passengersDataProvider = new ActiveDataProvider([
                'query' => TripPassenger::find()->where(['trip_id'=>$trip->id]),
                'pagination' => false,
                'sort' => false,
            ]);
            $passengers=$passengersDataProvider->getModels();
            ?>

            

            <?php if ($passengers): ?>
                <p class="text-center text-muted">
                    <?php echo Yii::t('front.vehicles', 'Passengers'); ?>
                    <?php echo count($passengers); ?>/<?php echo $trip->vehicle?$trip->vehicle->capacity:0; ?>
                </p>
                <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $passengersDataProvider,
                    'filterModel' => null,
                    'layout'=>'{items}',
                    'columns' => [
                        'refugee.name',
                        'refugee.phone',
        //                'refugee.document_number',
                        'refugee.age',
                        [
                            'attribute'=>'refugee.gender',
                            'value' => function(TripPassenger $model) {
                                return $model->refugee->genderLabel;
                            }
                        ],
                        'refugee.pickup_location',
                        'refugee.destination_location',
                        'refugee.special_needs:ntext',
                        'refugee.lang',
                    ],
                ]); ?>
                </div>
            <?php else: ?>
                <p class="text-center text-muted"><?php echo Yii::t('front.vehicles', 'This trip has no passengers yet'); ?></p>
            <?php endif; ?>
        
        <?php endforeach; ?>
        
    <?php else: ?>
        <p class="text-center text-muted"><?php echo Yii::t('front.vehicles', 'This vehicle has no trips assigned yet. Once the coordinator will assign a trip, you will able to see it here.'); ?></p>
    <?php endif; ?>
    
</div>
