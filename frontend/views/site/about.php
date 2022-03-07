<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = Yii::t('front.about', 'About');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php echo Yii::t('front.about', 'This platform is made by volunteers in order to provide a tool to better manage and coordinate vehicles, trips and houses for people that need to leave Ukraine and come to Spain.'); ?>
    </p>
    <p>
        <?php echo Yii::t('front.about', 'The code of this website is open source and can be found at: '); ?> <a href="https://github.com/atrandafir/refugees">Github</a>
    </p>

</div>
