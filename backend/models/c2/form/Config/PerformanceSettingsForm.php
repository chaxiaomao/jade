<?php

namespace backend\models\c2\form\Config;

use Yii;
use backend\models\c2\form\Config\Form as BaseForm;

class PerformanceSettingsForm extends \backend\models\c2\form\Config\Form {

    protected $_prefix = 'perf';
    public $cacheEnable;
    public $cacheDuration;
    public $productPriceCacheDuration;

    public function rules() {
        return [
            [['cacheEnable',], 'integer'],
            [['productPriceCacheDuration', 'cacheDuration',], 'integer'],
        ];
    }

    public function attributeLabels() {
        return [
            'cacheEnable' => Yii::t('app.c2', 'Cache Enable'),
            'cacheDuration' => Yii::t('app.c2', 'Default Cache Duration（Secs)'),
            'productPriceCacheDuration' => Yii::t('app.c2', 'Product Price Cache Duration（Secs)'),
        ];
    }

}
