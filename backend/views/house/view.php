<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\House;

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

</div>
