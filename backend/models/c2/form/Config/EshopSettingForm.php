<?php

namespace backend\models\c2\form\Config;

use common\models\c2\entity\SalesActivityUserPromo;
use cza\base\models\statics\EntityModelStatus;
use Yii;
use backend\models\c2\form\Config\Form as BaseForm;


class EshopSettingForm extends BaseForm {

    protected $_prefix = 'biz';
    public $newUserCouponActivity;

    public function rules() {
        return [
            [['newUserCouponActivity'], 'required'],
            [['newUserCouponActivity'], 'integer'],
        ];
    }

    public function attributeLabels() {
        return [
            'newUserCouponActivity' => Yii::t('app.c2', 'New User Coupon Activity')
        ];
    }

    public function effectiveActivity(){
        $condition = ['and',
            ['status'=>EntityModelStatus::STATUS_ACTIVE,
            'is_released'=>EntityModelStatus::STATUS_ACTIVE,
            ],
            ['>=','end_datetime', date('Y-m-d 23:59:59')]
        ];
        $ActivityModel = SalesActivityUserPromo::find()->andwhere($condition)->all();
        $ActivityArr = [];
        foreach ($ActivityModel as $Activity){
           if(count($Activity->getAvailCoupons())>0){
               $ActivityArr[$Activity->id] = $Activity->title;
           }
        }
        return $ActivityArr;
    }

}
