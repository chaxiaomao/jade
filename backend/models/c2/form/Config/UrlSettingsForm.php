<?php

namespace backend\models\c2\form\Config;

use Yii;
use backend\models\c2\form\Config\Form as BaseForm;

class UrlSettingsForm extends BaseForm {


    protected $_prefix = 'url';
    public $baseUrl;
    public $imageBaseUrl;
    public $cdnEnable;
    public $cdnImageBaseUrl;
    public $eshopUrl;
    public $baiduBridgeJs;
    public $baiduBridgeLink;
    public $baiduStatisticsJs;
    public $cdnVideoBaseUrl;
    
    public function rules() {
        return [
//            [['baseUrl','imageBaseUrl'], 'required'],
            [['cdnEnable',], 'integer'],
            [['cdnImageBaseUrl', 'eshopUrl', 'baiduBridgeJs', 'baiduBridgeLink', 'baiduStatisticsJs', 'cdnVideoBaseUrl'], 'string'],
        ];
    }

    public function attributeLabels() {
        return [
//            'baseUrl' => Yii::t('app.c2', 'baseUrl'),
//            'imageBaseUrl' => Yii::t('app.c2','imageBaseUrl'),
            'cdnEnable' => Yii::t('app.c2','CDN Enable'),
            'cdnImageBaseUrl' => Yii::t('app.c2','Image CDN Url'),
            'cdnVideoBaseUrl' => Yii::t('app.c2', 'Video Base Url'),
            'eshopUrl' => Yii::t('app.c2', 'Eshop Url'),
            'baiduBridgeJs' => Yii::t('app.c2', 'Baidu Bridge Js'),
            'baiduBridgeLink' => Yii::t('app.c2', 'Baidu Bridge Link'),
            'baiduStatisticsJs' => Yii::t('app.c2', 'Baidu Statistics Js'),
        ];
    }

}
