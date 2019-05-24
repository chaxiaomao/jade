<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/30
 * Time: 10:18
 */

namespace backend\models\c2\form\Config;

use backend\components\DistributorSystemValidate;
use backend\components\FranchiseeSystemValidate;
use backend\components\SalesmanCommissionerValidate;
use common\models\c2\statics\FeUserType;
use common\models\c2\statics\TransferType;
use Yii;
use backend\models\c2\form\Config\Form as BaseForm;


class ShopTransferForm extends BaseForm{
    protected $_prefix = 'shop';
    public $originalShopId;
    public $targetShopId;

    public function rules() {
        return [
            [['originalShopId','targetShopId'], 'required'],
            [['originalShopId','targetShopId'], 'integer'],
            ['originalShopId', 'compare', 'compareAttribute' => 'targetShopId', 'operator' => '!='],
            ['originalShopId',DistributorSystemValidate::className(),'compareAttribute'=>'targetShopId','transferLabel'=>$this->_prefix,'skipOnError' =>false],
            ['originalShopId',FranchiseeSystemValidate::className(),'compareAttribute'=>'targetShopId','transferLabel'=>$this->_prefix,'skipOnError' =>false],
            [['originalShopId'],SalesmanCommissionerValidate::className(),'validateType'=>TransferType::SHOP_TRANSFER,'skipOnError' =>false],
        ];
    }

    public function attributeLabels() {
        return [
            'originalShopId' => Yii::t('app.c2', 'OriginalShop Id'),
            'targetShopId' => Yii::t('app.c2', 'TargetShop Id'),
        ];
    }
}