<?php

namespace common\helpers;

use Yii;
use yii\helpers\Url;

class LanguageHelper {
    static public function languageLinksForNav() {
        $result=[];
        
        foreach (Yii::$app->params['languages'] as $code => $label) {
            $url = Url::current(['lang'=>$code]);
            $result[]=['label' => $label, 'url' => $url];
        }
        
        return $result;
    }
}
