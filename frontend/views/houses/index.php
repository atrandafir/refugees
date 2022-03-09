<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('front.houses', 'Hosts');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="house-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="alert alert-primary" role="alert">
        <p class="mb-0">
            <?php echo Yii::t('front.houses', 'Use this screen to provide us with information about your house so we can understand the people you can host.'); ?>
        </p>
    </div>

    <?php if (!count($models)): ?>
        <p>
            <?php echo Html::a(Yii::t('front.houses', 'Add my house'), ['new'], [
                'class'=>'btn btn-success',
            ]); ?>
        </p>
    <?php else: ?>
        <p>
            <?php echo Html::a(Yii::t('front.houses', 'Add another house'), ['new'], [
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
