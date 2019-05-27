<?php

namespace backend\models\c2\form\Config;

use Yii;
use backend\models\c2\form\Config\Form as BaseForm;

class BusinessSettingsForm extends BaseForm {

    protected $_prefix = 'biz';
    public $generalDistributor;
    public $generalShop;
    public $salesmanCommission;
    public $bizmanagerCommission;
    public $commissionScore;
//    public $maxSalesmanNumberPerFranchisee;
    public $maxSalesmanNumberPerShop;
    public $orderCommissionPriod;
    public $orderAfterSalePeriod;
    public $bizLevelOneCommission;
    public $bizLevelTwoCommission;
    public $bizLevelOneShareCommission;
    public $feUserShareScoreRate;
//    public $feUserBuyScoreRate;

    public $AutoCloseNoPayOrder;
    public $AutoNoSendOrder;
    public $AutoSign;
    public $AutoComment;
    public $AutoWaitHandle;
    public $AutoWaitPrepare;
    public $productInstallFeePercent;
    public $groupValidDuration;
    public $groupBargainNumber;
    public $groupTeamBuyingNumber;

//    public $AutoAccountOfDay;

    public function rules() {
        return [
            [['groupValidDuration', 'generalDistributor', 'generalShop', 'salesmanCommission', 'bizmanagerCommission', 'commissionScore', 'maxSalesmanNumberPerShop', 'orderCommissionPriod', 'orderAfterSalePeriod', 'bizLevelOneCommission', 'bizLevelTwoCommission', 'feUserShareScoreRate', 'AutoCloseNoPayOrder', 'AutoNoSendOrder', 'AutoSign', 'AutoComment', 'AutoWaitHandle', 'AutoWaitPrepare'], 'required'],
            [['groupValidDuration', 'generalDistributor', 'generalShop', 'salesmanCommission', 'bizmanagerCommission', 'commissionScore', 'maxSalesmanNumberPerShop', 'orderCommissionPriod', 'orderAfterSalePeriod', 'bizLevelOneCommission', 'bizLevelTwoCommission', 'feUserShareScoreRate', 'AutoCloseNoPayOrder', 'AutoNoSendOrder', 'AutoSign', 'AutoComment', 'AutoWaitHandle', 'AutoWaitPrepare', 'bizLevelOneShareCommission', 'productInstallFeePercent', 'groupBargainNumber', 'groupTeamBuyingNumber'], 'integer'],
            [['productInstallFeePercent', 'bizLevelOneCommission', 'bizLevelTwoCommission', 'salesmanCommission', 'bizmanagerCommission'], 'checkPercentage', 'skipOnEmpty' => false, 'skipOnError' => false],
//            [['AutoAccountOfDay'], 'checkAccountTime', 'skipOnEmpty' => false, 'skipOnError' => false],
        ];
    }

    public function attributeLabels() {
        return [
//            'maxSalesmanNumberPerFranchisee' => Yii::t('app.c2', 'Max Salesman Number Per Franchisee'),
            'generalDistributor' => Yii::t('app.c2', 'General Distributor'),
            'generalShop' => Yii::t('app.c2', 'General Shop'),
            'maxSalesmanNumberPerShop' => Yii::t('app.c2', 'Max Salesman Number Per Shop'),
            'salesmanCommission' => Yii::t('app.c2', 'Salesman Commission'),
            'bizmanagerCommission' => Yii::t('app.c2', 'BizManager Commission'),
            'commissionScore' => Yii::t('app.c2', 'Commission Score'),
            'orderCommissionPriod' => Yii::t('app.c2', 'Order Commission Priod'),
            'orderAfterSalePeriod' => Yii::t('app.c2', 'Order After Sale Period'),
            'bizLevelOneCommission' => Yii::t('app.c2', 'Level One Commission'),
            'bizLevelTwoCommission' => Yii::t('app.c2', 'Level Two Commission'),
            'feUserShareScoreRate' => Yii::t('app.c2', 'FeUser Share Score Rate'),
            'feUserBuyScoreRate' => Yii::t('app.c2', 'FeUser Buy Score Rate'),
            'AutoCloseNoPayOrder' => Yii::t('app.c2', 'Auto Close NoPayOrder'),
            'AutoNoSendOrder' => Yii::t('app.c2', 'Auto No SendOrder'),
            'AutoSign' => Yii::t('app.c2', 'Auto Sign'),
            'AutoComment' => Yii::t('app.c2', 'Auto Comment'),
            'AutoWaitHandle' => Yii::t('app.c2', 'Auto Wait Handle'),
            'AutoWaitPrepare' => Yii::t('app.c2', 'Auto Wait Prepare'),
            'bizLevelOneShareCommission' => Yii::t('app.c2', 'One Share Commission'),
            'productInstallFeePercent' => Yii::t('app.c2', 'Product Install FeePercent'),
            'groupBargainNumber' => Yii::t('app.c2', 'Group Bargain Number'),
            'groupTeamBuyingNumber' => Yii::t('app.c2', 'Group Team Buying Number'),
            'groupValidDuration' => Yii::t('app.c2', 'Group Valid Duration (Days)'),
//            'AutoAccountOfDay' => Yii::t('app.c2', 'Auto Account Of Day')
        ];
    }

//    public function checkAccountTime($attribute, $params) {
//        if ($this->AutoAccountOfDay <= $this->orderAfterSalePeriod) {
//            $this->addError($attribute, Yii::t('app.c2', 'The Day Of Apply After Sale Can Not More Than Get Account Day'));
//        }
//    }

    public function checkPercentage($attribute, $params) {
        if ($this->{$attribute} >= 100 || $this->{$attribute} < 0) {
            $this->addError($attribute, Yii::t('app.c2', 'The value of {s1} must be between 0 and 100', ['s1' => $this->getAttributeLabel($attribute)]));
        }
    }

}
