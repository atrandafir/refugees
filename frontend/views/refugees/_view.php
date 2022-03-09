<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Refugee;

/* @var $this yii\web\View */
/* @var $model common\models\Refugee */

?>
<div class="refugee-view" style="margin-top: 40px;">
    
    <div class="row">
        <div class="col-sm-6">
            <h2><?= Html::encode($model->name) ?></h2>
        </div>
        <div class="col-sm-6">
            <p class="float-sm-right">
                <?= Html::a(Yii::t('front.general', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
                <?= Html::a(Yii::t('front.general', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('front.general', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'name',
            'phone',
            'document_number',
            'age',
            [
                'attribute'=>'gender',
                'value' => function(Refugee $model) {
                    return $model->genderLabel;
                }
            ],
            'pickup_location',
            'destination_location',
            'special_needs:ntext',
            'lang',
            'created_at:datetime',
        ],
    ]) ?>
    
</div>
