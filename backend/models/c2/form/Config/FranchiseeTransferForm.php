<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/30
 * Time: 10:13
 */

namespace backend\models\c2\form\Config;

use backend\components\DistributorSystemValidate;
use backend\components\SalesmanCommissionerValidate;
use common\models\c2\statics\TransferType;
use Yii;
use backend\models\c2\form\Config\Form as BaseForm;

class FranchiseeTransferForm extends BaseForm{
    protected $_prefix = 'franchisee';
    public $originalFranchiseeId;
    public $targetFranchiseeId;

    public function rules() {
        return [
            [['originalFranchiseeId','originalFranchiseeId'], 'required'],
            [['targetFranchiseeId','targetFranchiseeId'], 'integer'],
            ['originalFranchiseeId', 'compare', 'compareAttribute' => 'targetFranchiseeId', 'operator' => '!='],
            ['originalFranchiseeId',DistributorSystemValidate::className(),'compareAttribute'=>'targetFranchiseeId','transferLabel'=>$this->_prefix,'skipOnError' =>false],
            [['originalFranchiseeId'],SalesmanCommissionerValidate::className(),'validateType'=>TransferType::FRANCHISEE_TRANSFER,'skipOnError' =>false],
        ];
    }

    public function attributeLabels() {
        return [
//            'maxSalesmanNumberPerFranchisee' => Yii::t('app.c2', 'Max Salesman Number Per Franchisee'),
            'originalFranchiseeId' => Yii::t('app.c2', 'OriginalFranchisee Id'),
            'targetFranchiseeId' => Yii::t('app.c2', 'TargetFranchisee Id'),
        ];
    }
}