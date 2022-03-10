<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\Refugee;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RefugeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('back.refugee', 'Refugees');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refugee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('back.refugee', 'Create Refugee'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            /*
            [
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function(Refugee $model) {
                    return $model->user?Html::encode($model->user->email):null;
                }  
            ],*/
            'name',
//            'phone',
            'document_number',
            'age',
            [
                'attribute'=>'gender',
                'filter'=> Refugee::getGenderList(),
                'value' => function(Refugee $model) {
                    return $model->genderLabel;
                }
            ],
            'pickup_location',
            'destination_location',
            'special_needs:ntext',
            'lang',
            [
                'attribute' => 'assigned_house_id',
                'format' => 'raw',
                'value' => function(Refugee $model) {
                    return $model->assignedHouse?$model->assignedHouse->getTitle():null;
                }  
            ],
            'assigned_trip_id',
            'created_at:datetime',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Refugee $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    </div>


</div>
