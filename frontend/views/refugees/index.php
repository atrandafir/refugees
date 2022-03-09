<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('front.refugees', 'Refugees');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="refugee-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="alert alert-primary" role="alert">
        <p class="mb-0">
            <?php echo Yii::t('front.refugees', 'Use this screen to provide us with information about yourself and any family members traveling with you.'); ?>
        </p>
    </div>

    <?php if (!count($models)): ?>
        <p>
            <?php echo Html::a(Yii::t('front.refugees', 'Add myself to the list'), ['new'], [
                'class'=>'btn btn-success',
            ]); ?>
        </p>
    <?php else: ?>
        <p>
            <?php echo Html::a(Yii::t('front.refugees', 'Add another person'), ['new'], [
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
