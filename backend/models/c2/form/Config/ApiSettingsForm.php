<?php

namespace backend\models\c2\form\Config;

use Yii;
use backend\models\c2\form\Config\Form as BaseForm;

class ApiSettingsForm extends BaseForm {


    protected $_prefix = 'api';
    public $tencentDevAppKey;
    public $baiduBridgeJs;
    public $baiduBridgeLink;
    

    public function rules() {
        return [
            [['tencentDevAppKey',], 'required'],
            [['tencentDevAppKey', 'baiduBridgeJs', 'baiduBridgeLink'], 'string'],
        ];
    }

    public function attributeLabels() {
        return [
            'tencentDevAppKey' => Yii::t('app.c2', 'Tencent Dev App Key'),
//            'baiduBridgeJs' => Yii::t('app.c2', 'Baidu Bridge Js'),
//            'baiduBridgeLink' => Yii::t('app.c2', 'Baidu Bridge Link'),
        ];
    }

}
