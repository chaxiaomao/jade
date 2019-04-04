<?php

namespace frontent\models;

use Yii;
use common\models\c2\entity\RegionCity;
use common\models\c2\entity\RegionDistrict;
use common\models\c2\entity\RegionProvince;
use yii\base\Model;
use cza\base\models\ModelTrait;

/**
 * AbstractRegisterForm is the model behind the contact form.
 */
abstract class AbstractRegisterForm extends Model {
    public $registration_src_type;

    use ModelTrait;
    public function getWechatUnionId($openId) {
        $app = Yii::$app->wechat->getApp();
        $userService = $app->user;
        $user = $userService->get($openId);
        return !empty($user->unionid) ? $user->unionid : "";
    }

    public function errorSummary($form) {
        $errorLists = [];
        foreach ($this->getAllModels() as $id => $model) {
            $errorList = $form->errorSummary($model, [
                'header' => '<p>Please fix the following errors for <b>' . $id . '</b></p>',
            ]);
            $errorList = str_replace('<li></li>', '', $errorList); // remove the empty error
            $errorLists[] = $errorList;
        }
        return implode('', $errorLists);
    }

    protected function getAllModels() {
        return [];
    }

    protected function getAddress() {
        $provinceName = RegionProvince::find()->select('label')->where(['id' => $this->province_id])->one()['label'];
        $cityName = RegionCity::find()->select('label')->where(['id' => $this->city_id])->one()['label'];
        $districtName = RegionDistrict::find()->select('label')->where(['id' => $this->district_id])->one()['label'];
        return $provinceName . $cityName . $districtName . $this->location;
    }

}
