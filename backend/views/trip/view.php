<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\Trip;
use common\models\TripPassenger;

use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\grid\ActionColumn;

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
            'vehicle.capacity',
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
    
    <!-- passengers -->
    
    <?php
    $passengersDataProvider = new ActiveDataProvider([
        'query' => TripPassenger::find()->where(['trip_id'=>$model->id]),
        'pagination' => false,
        'sort' => [
            'defaultOrder' => ['id'=>SORT_ASC],
        ],
    ]);
    $passengers=$passengersDataProvider->getModels();
    ?>
    
    <h2>
        <?php echo Yii::t('back.trip', 'Passengers'); ?>
        <?php echo count($passengers); ?>/<?php echo $model->vehicle?$model->vehicle->capacity:0; ?>
    </h2>
    
    <?php if ($passengers): ?>
        <?= GridView::widget([
            'dataProvider' => $passengersDataProvider,
            'filterModel' => null,
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
                [
                    'class' => ActionColumn::className(),
                    'template'=>'{delete}',
                    'urlCreator' => function ($action, TripPassenger $model, $key, $index, $column) {
                        if ($action=='delete') {
                            return Url::toRoute(['delete-passenger', 'id' => $model->id, 'trip_id'=>$model->trip_id]);
                        }
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    <?php else: ?>
        <p class="text-center text-muted"><?php echo Yii::t('back.trip', 'This trip has no passengers yet'); ?></p>
    <?php endif; ?>
        
    <p>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPassengerModal">
          <?php echo Yii::t('back.trip', 'Add passenger'); ?>
        </button>
    </p>

</div>

<!-- Modal -->
<div class="modal fade" id="addPassengerModal" tabindex="-1" role="dialog" aria-labelledby="addPassengerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <?php echo Html::beginForm('','post', []); ?>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPassengerModalLabel"><?php echo Yii::t('back.trip', 'Add passenger'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
            <?php echo Html::dropDownList('add_refugee_id', '', [
                ''=>'',
            ],[
                'class'=>'form-control',
                'id'=>'add_refugee_id',
            ]); ?>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo Yii::t('back.general', 'Cancel'); ?></button>
        <?= Html::submitButton(Yii::t('back.trip', 'Add passenger'), ['class' => 'btn btn-primary']) ?>
      </div>
    </div>
    <?php echo Html::endForm(); ?>
  </div>
</div>

<script>
    function trip_init_view() {
        
        $('#add_refugee_id').select2({
            theme: 'bootstrap4',
            dropdownParent: $('#addPassengerModal .modal-content'),
            ajax: {
              url: '<?php echo Url::to(['/refugee/select2']) ?>',
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
trip_init_view();
JS;

$this->registerJs($script); // Registro el script javascript en el view 
?>
