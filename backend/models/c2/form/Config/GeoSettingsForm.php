<?php

namespace backend\models\c2\form\Config;

use Yii;
use backend\models\c2\form\Config\Form as BaseForm;

class GeoSettingsForm extends BaseForm {

    protected $_prefix = 'geo';
    public $companyLatitude;
    public $companyLongitude;

    public function rules() {
        return [
            [['companyLatitude', 'companyLongitude',], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() {
        return [
            'companyLatitude' => Yii::t('app.c2', 'Latitude'),
            'companyLongitude' => Yii::t('app.c2', 'Longitude'),
        ];
    }

    public function getCoordinate() {
        if (empty($this->companyLatitude) && empty($this->companyLongitude)) {
            return "113.219250,22.626980";
        }
        return "{$this->companyLatitude},{$this->companyLongitude}";
    }

}
