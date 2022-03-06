<?php

use common\components\I18N;

return [
    'name'=>'Ukraine to Spain',
    
    'language' => 'en',
    'sourceLanguage' => 'en',
    
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'class'=>I18N::class,
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource'
                ],
            ],
        ],
    ],
];
