<?php

namespace backend\models\c2\form;

use Yii;
use yii\base\Model;
use cza\base\models\ModelTrait;
use common\models\c2\entity\WechatInfo;
use common\models\c2\entity\WechatInfoQueue;
use common\models\c2\entity\FeUser;
use common\models\c2\statics\FeUserType;
use common\models\c2\statics\WechatUserGroupType;

/**
 * MaterialInfoWechatSendForm is used to collect wechat template info
 */
class MaterialInfoWechatSendForm extends Model {

    use ModelTrait;

    const TYPE_DISTRIBUTOR_FRANCHISEE = 1;  // 代理商所属的加盟商
    const TYPE_FRANCHISEE_SALESMAN = 2;  // 加盟商所属的专员
    const TYPE_FRANCHISEE_CUSTOMER = 3;  // 加盟商所属的客户
    const TYPE_SHOP_SALESMAN = 4;  // 专卖店所属的专员
    const TYPE_SHOP_CUSTOMER = 5; //专卖店所属的客户
    const TYPE_USER = 6;  //任意客户

    protected $_infoModel;
    protected $_queueModel;
    public $to_distributor_franchisee_ids;
    public $to_franchisee_salesman_ids;
    public $to_franchisee_customer_ids;
    public $to_shop_salesman_ids;
    public $to_shop_customer_ids;
    public $to_user_ids;

    public function init() {
        parent::init();
        if (is_null($this->_infoModel)) {
            throw new \yii\base\ErrorException("Info Model is required!");
        }
    }


    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['to_distributor_franchisee_ids', 'to_franchisee_salesman_ids', 'to_franchisee_customer_ids', 'to_shop_salesman_ids', 'to_shop_customer_ids', 'to_user_ids',], 'safe'],
        ];
    }
    
    public static function getModelClassByType($type){
        return WechatUserGroupType::getModelProfileClassByType($type);
    }

    public static function getModelByType($type) {
        
    }

    public static function getOptionsList($keyField, $valField, $condition = '', $params = ['limit' => 50]) {
        
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'to_distributor_franchisee_ids' => Yii::t('app.c2', "Select {s1}'s {s2} as recipients", ['s1' => Yii::t('app.c2', 'Distributor'), 's2' => Yii::t('app.c2', 'Franchisee')]),
            'to_franchisee_salesman_ids' => Yii::t('app.c2', "Select {s1}'s {s2} as recipients", ['s1' => Yii::t('app.c2', 'Franchisee'), 's2' => Yii::t('app.c2', 'Salesman')]),
            'to_franchisee_customer_ids' => Yii::t('app.c2', "Select {s1}'s {s2} as recipients", ['s1' => Yii::t('app.c2', 'Franchisee'), 's2' => Yii::t('app.c2', 'Customer')]),
            'to_shop_salesman_ids' => Yii::t('app.c2', "Select {s1}'s {s2} as recipients", ['s1' => Yii::t('app.c2', 'Shop'), 's2' => Yii::t('app.c2', 'Salesman')]),
            'to_shop_customer_ids' => Yii::t('app.c2', "Select {s1}'s {s2} as recipients", ['s1' => Yii::t('app.c2', 'Shop'), 's2' => Yii::t('app.c2', 'Customer')]),
            'to_user_ids' => Yii::t('app.c2', 'Arbitrary {s1}', ['s1' => Yii::t('app.c2', 'Recipients')]),
        ];
    }

    public function send() {
        if (!($this->validate())) {
            return FALSE;
        }
        //Yii::info($this->getAttributes());

//        try {
//            $app = Yii::$app->wechat->getApp();
//            $notice = $app->notice;
//
//            $tplModel = $this->findModel($this->tpl_id);
//            $toUsers = FeUser::findAll(['id' => $this->to_user_ids]);
//            foreach ($toUsers as $user) {
//                $datum = [
//                    'touser' => $user->wechat_open_id,
//                    'template_id' => $tplModel->code,
//                    'url' => $this->url,
//                    'data' => $this->parseContent($this->content),
//                ];
////                Yii::info($datum);
//                $result = $notice->send($datum);
////                Yii::info($result);
//            }
//        } catch (\Exception $ex) {
//            Yii::info($ex->getMessage());
//            return false;
//        }

        return true;
    }

    public function getQueueModel() {
        if ($this->_queueModel === null) {
            $this->_queueModel = new WechatInfoQueue();
            $this->_queueModel->loadDefaultValues();
        }
        return $this->_queueModel;
    }

    public function setQueueModel($model) {
        $this->_queueModel = $model;
    }

    public function getInfoModel() {
        return $this->_infoModel;
    }

    public function setInfoModel($model) {
        $this->_infoModel = $model;
    }

    public function errorSummary($form) {
        $errorLists = [];
        foreach ($this->getAllModels() as $model) {
            $errorList = $form->errorSummary($model, [
                'header' => '<p>Please fix the following errors for <b>' . $model->className() . '</b></p>',
            ]);
            $errorList = str_replace('<li></li>', '', $errorList); // remove the empty error
            $errorLists[] = $errorList;
        }
        return implode('', $errorLists);
    }

    private function getAllModels() {
        return [
            $this->getInfoModel(), $this->getQueueModel(),
        ];
    }

}
