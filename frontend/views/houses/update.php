<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\House */

$this->title = Yii::t('front.houses', 'Modify house');
$this->params['breadcrumbs'][] = ['label' => Yii::t('front.houses', 'Hosts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="house-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
</div>
