<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

use yii\helpers\Url;

use common\helpers\LanguageHelper;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Url::to(['//site/index']),
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => Yii::t('front.menu', 'Home'), 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('front.menu', 'Signup'), 'url' => ['/site/signup']];
        $menuItems[] = ['label' => Yii::t('front.menu', 'Login'), 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => Yii::t('front.menu', 'Refugees'), 'url' => ['/refugees/index']];
        $menuItems[] = ['label' => Yii::t('front.menu', 'Hosts'), 'url' => ['/houses/index']];
        $menuItems[] = ['label' => Yii::t('front.menu', 'Drivers'), 'url' => ['/vehicles/index']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
            . Html::submitButton(
                Yii::t('front.menu', 'Logout').' (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    
    $menuItems[] = ['label' => 'Language', 'items' => LanguageHelper::languageLinksForNav()];
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink'=>[
                'label' => Yii::t('front.menu', 'Home'),
                'url' => ['//site/index'],
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        
        <?php
        $browser_lang=Yii::$app->request->getPreferredLanguage(array_keys(Yii::$app->params['languages']));
//        var_dump(LanguageHelper::percentageTranslationForLang($browser_lang));
        ?>
        
        <?php if ($browser_lang && ($browser_lang!=Yii::$app->language) && LanguageHelper::percentageTranslationForLang($browser_lang)>=50): ?>
        <div class="alert alert-primary" role="alert">
            <?php echo Yii::t('front.general', 'This website is available in: {linkStart}{language}{linkEnd}', [
                'linkStart'=>'<a href="'.Url::current(['lang'=>$browser_lang]).'" class="alert-link">',
                'linkEnd'=>'</a>',
                'language'=>Yii::$app->params['languages'][$browser_lang],
            ]); ?>
        </div>
        <?php endif; ?>
        
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">
            &copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?>
            &middot; <?php echo Html::a(Yii::t('front.menu', 'About'), ['/site/about']); ?>
            &middot; <?php echo Html::a(Yii::t('front.menu', 'Contact'), ['/site/contact']); ?>
        </p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
