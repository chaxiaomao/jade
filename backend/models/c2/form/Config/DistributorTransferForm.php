<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/30
 * Time: 9:53
 */

namespace backend\models\c2\form\Config;
use backend\components\SalesmanCommissionerValidate;
use common\models\c2\statics\TransferType;
use Yii;
use backend\models\c2\form\Config\Form as BaseForm;

class DistributorTransferForm extends BaseForm
{
    protected $_prefix = 'distributor';
    public $originalDistributorId;
    public $targetDistributorId;

    public function rules() {
        return [
            [['originalDistributorId','targetDistributorId'], 'required'],
            [['originalDistributorId','targetDistributorId'], 'integer'],
            [['originalDistributorId'],SalesmanCommissionerValidate::className(),'validateType'=>TransferType::DISTRIBUTOR_TRANSFER,'skipOnError' =>false],
        ];
    }

    public function attributeLabels() {
        return [
//            'maxSalesmanNumberPerFranchisee' => Yii::t('app.c2', 'Max Salesman Number Per Franchisee'),
            'originalDistributorId' => Yii::t('app.c2', 'OriginalDistributor Id'),
            'targetDistributorId' => Yii::t('app.c2', 'TargetDistributor Id'),
        ];
    }
}