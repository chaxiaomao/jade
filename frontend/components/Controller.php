<?php

namespace frontend\components;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller as BaseController;

/**
 * Default controller for the `merchant` module
 */
abstract class Controller extends BaseController {

    protected $_shop = null;
    protected $_currentUser = null;
    protected $_wechatUser = null;

    public function getWechatUser() {
        if (is_null($this->_wechatUser)) {
            $this->_wechatUser = Yii::$app->wechat->getUser();
        }
        return $this->_wechatUser;
    }
    
    /**
     * could be boss/merchant/salesman/customer
     * @return FeUser
     */
    public function getCurrentUser(){
         if (is_null($this->_currentUser)) {
            $this->_currentUser = Yii::$app->user->getCurrentUser();
        }
        return $this->_currentUser;
    }

    public function getShop() {
        if (is_null($this->_shop)) {
            if($this->getCurrentUser()->isMerchant()){
                $this->_shop = $this->getCurrentUser()->getMyFirstShop();
//                Yii::info($this->_shop->id);
            }
        }
        return $this->_shop;
    }

}
