<?php

use yii\helpers\Html;

/** @var yii\web\View $this */

$title=Yii::t('back.translation', 'Messages for {language} - {category}', [
    'language'=>$languageName,
    'category'=>$category,
]);

$this->title = $title." - ".Yii::$app->name;


?>

<h1><?php echo Html::encode($title); ?></h1>

<?php echo Html::beginForm(); ?>



<table width="100%" border="0" class="table table-striped">
    <thead>
    <tr>
        <th><?php echo Yii::t('back.translation', 'Source message'); ?></th>
        <th><?php echo Yii::t('back.translation', 'Translation'); ?></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($rows as $row): ?>
        <tr>
            <td width="50%">
                <?php echo Html::encode($row['message']); ?>
            </td>
            <td>
                <?php echo Html::textarea('translation['.$row['id'].']', $row['translation'], [
                    'style'=>'width:100%',
                    'class'=>'form-control',
                ]); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="form-group">
    <?= Html::submitButton(Yii::t('back.translation', 'Save'), ['class' => 'btn btn-primary']) ?>
</div>

<?php echo Html::endForm(); ?>