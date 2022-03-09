<?php

use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?php echo Yii::t('front.index', 'Welcome!'); ?></h1>

        <p class="lead"><?php echo Yii::t('front.index', 'Ukraine to Spain travel and accomodation coordination platform'); ?></p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2><?php echo Yii::t('front.index', 'Refugees'); ?></h2>

                <p>
                    <?php echo Yii::t('front.index', 'Are you a person that needs to leave Ukraine and come to Spain?'); ?>
                    <?php echo Yii::t('front.index', 'If so, use the following link to add your details on the list.'); ?>
                    <?php echo Yii::t('front.index', 'You can add both yourself and other family members.'); ?>
                    <?php echo Yii::t('front.index', 'Once you\'re on the list, you\'ll be contacted by a coordinator for further information about your future house and upcoming trip.'); ?>
                </p>

                <p><a class="btn btn-primary" href="<?php echo Url::to(['refugees/new']); ?>"><?php echo Yii::t('front.index', 'Add me now'); ?> &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2><?php echo Yii::t('front.index', 'Hosts'); ?></h2>

                <p>
                    <?php echo Yii::t('front.index', 'Do you have a house in Spain where you can host people coming from Ukraine?'); ?>
                    <?php echo Yii::t('front.index', 'Tell us about the location and capacity of your house and when will it be available.'); ?>
                    <?php echo Yii::t('front.index', 'We will get in touch with you to coordinate the people that will come and stay at your place.'); ?>
                </p>

                <p><a class="btn btn-primary" href="<?php echo Url::to(['houses/new']); ?>"><?php echo Yii::t('front.index', 'Add my house'); ?> &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2><?php echo Yii::t('front.index', 'Drivers'); ?></h2>

                <p>
                    <?php echo Yii::t('front.index', 'Do you own a car and are willing to make a trip to Ukraine and back to Spain?'); ?>
                    <?php echo Yii::t('front.index', 'Tell us about your vehicle capacity.'); ?>
                    <?php echo Yii::t('front.index', 'We will get in touch with you to plan together the trips details, pickup locations, passengers, etc.'); ?>
                </p>

                <p><a class="btn btn-primary" href="<?php echo Url::to(['vehicles/new']); ?>"><?php echo Yii::t('front.index', 'Add my vehicle'); ?> &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
