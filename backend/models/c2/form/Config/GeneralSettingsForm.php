<?php

namespace backend\models\c2\form\Config;

use Yii;
use backend\models\c2\form\Config\Form as BaseForm;

class GeneralSettingsForm extends \backend\models\c2\form\Config\Form {

    protected $_prefix = 'general';
    public $locale;
    public $localeLanguage;
    public $localeCurrency;
    public $userEnvironment;

    public function rules() {
        return [
            [['locale', 'localeLanguage', 'localeCurrency',], 'string', 'max' => 255],
            [['userEnvironment'], 'string']
        ];
    }

    public function attributeLabels() {
        return [
            'locale' => Yii::t('app.c2', 'Locale'),
            'localeLanguage' => Yii::t('app.c2', 'Locale Language'),
            'localeCurrency' => Yii::t('app.c2', 'Locale Currency'),
            'userEnvironment' => Yii::t('app.c2', 'User Environment'),
        ];
    }

}
