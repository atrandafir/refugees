<?php

namespace common\components;

use Yii;
use yii\web\UrlManager;

class MultiLingualUrlManager extends UrlManager {
    public function createUrl($params): string {
        
        $params['lang'] = isset($params['lang']) ? $params['lang'] : Yii::$app->language;
        
        return parent::createUrl($params);
    }
}
