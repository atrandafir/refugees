<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Refugee;

/* @var $this yii\web\View */
/* @var $model common\models\Refugee */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('back.refugee', 'Refugees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="refugee-view">

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
                'value' => function(Refugee $model) {
                    return $model->user?Html::encode($model->user->email):null;
                }  
            ],
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
            'updated_at:datetime',
        ],
    ]) ?>

</div>
