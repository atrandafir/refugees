<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Refugee */

$this->title = Yii::t('front.refugees', 'Modify refugee');
$this->params['breadcrumbs'][] = ['label' => Yii::t('front.refugees', 'Refugees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="refugee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
</div>
