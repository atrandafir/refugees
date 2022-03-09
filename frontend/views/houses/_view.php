<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use common\models\HouseGuest;

/* @var $this yii\web\View */
/* @var $model common\models\House */

?>
<div class="house-view" style="margin-top: 40px;">
    
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
        ],
    ]) ?>
    
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
    <?php if ($guests): ?>
        <p class="text-center text-muted"><?php echo Yii::t('front.houses', 'Guests assigned to this house'); ?></p>
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $guestsDataProvider,
                'layout'=>'{items}',
                'filterModel' => null,
                'columns' => [
                    'refugee.name',
                    'refugee.phone',
                    'refugee.age',
                    [
                        'attribute'=>'refugee.gender',
                        'value' => function(HouseGuest $model) {
                            return $model->refugee->genderLabel;
                        }
                    ],
    //                'refugee.pickup_location',
                    'refugee.destination_location',
                    'refugee.special_needs:ntext',
                    'refugee.lang',
                ],
            ]); ?>
        </div>
    <?php else: ?>
        <p class="text-center text-muted"><?php echo Yii::t('front.houses', 'This house has no guests yet. Once the coordinator will assign the guests, you will able to see them here.'); ?></p>
    <?php endif; ?>
    
</div>
