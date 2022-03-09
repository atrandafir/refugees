<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('front.vehicles', 'Drivers');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="vehicle-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="alert alert-primary" role="alert">
        <p class="mb-0">
            <?php echo Yii::t('front.vehicles', 'Use this screen to provide us with information about your car so we can understand the passengers you can take with you.'); ?>
        </p>
    </div>

    <?php if (!count($models)): ?>
        <p>
            <?php echo Html::a(Yii::t('front.vehicles', 'Add my vehicle'), ['new'], [
                'class'=>'btn btn-success',
            ]); ?>
        </p>
    <?php else: ?>
        <p>
            <?php echo Html::a(Yii::t('front.vehicles', 'Add another vehicle'), ['new'], [
                'class'=>'btn btn-success',
            ]); ?>
        </p>
        <?php foreach ($models as $model): ?>
            <?= $this->render('_view', [
                'model' => $model,
            ]) ?>
        <?php endforeach; ?>
    <?php endif; ?>
    
</div>
