<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\House;

use common\models\HouseGuest;

use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $model common\models\House */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('back.house', 'Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="house-view">

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
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function(House $model) {
                    return $model->user?Html::encode($model->user->email):null;
                }  
            ],
            'host_name',
            'host_phone',
            'host_document_number',
            'address',
            'city',
            'postal_code',
            'capacity',
            'rooms',
            'availability_date:date',
            'lang',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
        
    <!-- guests -->
    
    <?php
    $guestsDataProvider = new ActiveDataProvider([
        'query' => HouseGuest::find()->where(['house_id'=>$model->id]),
        'pagination' => false,
        'sort' => [
            'defaultOrder' => ['id'=>SORT_ASC],
        ],
    ]);
    $guests=$guestsDataProvider->getModels();
    ?>
    
    <h2>
        <?php echo Yii::t('back.house', 'Guests'); ?>
        <?php echo count($guests); ?>/<?php echo $model->capacity; ?>
    </h2>
    
    <?php if ($guests): ?>
        <?= GridView::widget([
            'dataProvider' => $guestsDataProvider,
            'filterModel' => null,
            'columns' => [
                'refugee.name',
                'refugee.phone',
//                'refugee.document_number',
                'refugee.age',
                [
                    'attribute'=>'refugee.gender',
                    'value' => function(HouseGuest $model) {
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
                    'urlCreator' => function ($action, HouseGuest $model, $key, $index, $column) {
                        if ($action=='delete') {
                            return Url::toRoute(['delete-guest', 'id' => $model->id, 'house_id'=>$model->house_id]);
                        }
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    <?php else: ?>
        <p class="text-center text-muted"><?php echo Yii::t('back.house', 'This house has no guests yet'); ?></p>
    <?php endif; ?>
        
    <p>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addGuestModal">
          <?php echo Yii::t('back.house', 'Add guest'); ?>
        </button>
    </p>

</div>

<!-- Modal -->
<div class="modal fade" id="addGuestModal" tabindex="-1" role="dialog" aria-labelledby="addGuestModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <?php echo Html::beginForm('','post', []); ?>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addGuestModalLabel"><?php echo Yii::t('back.house', 'Add guest'); ?></h5>
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
        <?= Html::submitButton(Yii::t('back.house', 'Add guest'), ['class' => 'btn btn-primary']) ?>
      </div>
    </div>
    <?php echo Html::endForm(); ?>
  </div>
</div>

<script>
    function house_init_view() {
        
        $('#add_refugee_id').select2({
            theme: 'bootstrap4',
            dropdownParent: $('#addGuestModal .modal-content'),
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
house_init_view();
JS;

$this->registerJs($script); // Registro el script javascript en el view 
?>
