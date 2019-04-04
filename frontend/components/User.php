<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\components;

use Yii;
use yii\web\User as BaseUser;
use common\models\c2\statics\FeUserType;

/**
 * User is the class for the `user` application component that manages the user authentication status.
 *
 * @author Ben bi <bennybi@qq.com>
 */
class User extends BaseUser {

    private $_attributes = [];
    public $loginUrl = ['site/login'];

    public function getUsername() {
        if (!isset($this->_attributes['username'])) {
            $this->_attributes['username'] = $this->getIdentity()->username;
        }
        return $this->_attributes['username'];
    }

    public function getAvatarUrl() {
        if (!isset($this->_attributes['avatarUrl'])) {
            $this->_attributes['avatarUrl'] = $this->getIdentity()->profile->getImageUrl();
        }
        return $this->_attributes['avatarUrl'];
    }

    public function getWapAvatarUrl(){
        if (!isset($this->_attributes['wapAvatarUrl'])) {
            if (Yii::$app->wechat->isWechat){
                $wechatUser = Yii::$app->wechat->getUser();
                $this->_attributes['wapAvatarUrl'] = $wechatUser->avatar;
            }else{
                $this->_attributes['wapAvatarUrl'] = $this->getIdentity()->profile->avatar;
            }
        }
        return $this->_attributes['wapAvatarUrl'];
    }

    public function getFullname() {
        if (!isset($this->_attributes['fullname'])) {
            $this->_attributes['fullname'] = $this->getIdentity()->profile->getMemberName();
        }
        return $this->_attributes['fullname'];
    }

    public function getCurrentUser() {
        return $this->getIdentity();
    }

    public function isDistributor() {
        return $this->getIdentity()->isDistributor();
    }

    public function isFranchisee() {
        return $this->getIdentity()->isFranchisee();
    }

    public function isMerchant() {
        return $this->getIdentity()->isMerchant();
    }

    // public function getShop(){
    //     if ($this->isMerchant()){
    //         return Merchant::findOne(Yii::$app->getUser()->id)->getMyFirstShop();
    //     }
    //     return null;
    // }

    public function isSalesman() {
        return $this->getIdentity()->isSalesman();
    }

    public function isCustomer() {
        return $this->getIdentity()->isCustomer();
    }

    public function isFavouredCustomer() {
        return $this->getIdentity()->isFavouredCustomer();
    }

    public function isNormalCustomer() {
        return $this->getIdentity()->isNormalCustomer();
    }

    public function isBizmanager(){
        return $this->getIdentity()->isBizmanager();
    }

    public function isWorker(){
        return $this->getIdentity()->isWorker();
    }

    public function loginByWechatOpenId($id, $type = null) {
        /* @var $class IdentityInterface */
        $class = $this->identityClass;
        $identity = $class::findIdentityWechatOpenId($id, $type);
        if ($identity && $this->login($identity)) {
            return $identity;
        } else {
            return null;
        }
    }

    public function getReturnUrl($defaultUrl = null) {
        switch ($this->getIdentity()->type) {
            case FeUserType::TYPE_MERCHANT:
                $url = Yii::$app->getUrlManager()->createUrl(['/merchant']);
                break;
            case FeUserType::TYPE_BIZ_MANAGER:
                $url = Yii::$app->getUrlManager()->createUrl(['/bizmanager']);
                break;
            case FeUserType::TYPE_SALESMAN:
                $url = Yii::$app->getUrlManager()->createUrl(['/salesman']);
                break;
            case FeUserType::TYPE_DISTRIBUTOR:
                $url = Yii::$app->getUrlManager()->createUrl(['/distributor']);
                break;
            case FeUserType::TYPE_FRANCHISEE:
                $url = Yii::$app->getUrlManager()->createUrl(['/franchisee']);
                break;
            case FeUserType::TYPE_WORKER:
                $url = Yii::$app->getUrlManager()->createUrl(['/worker']);
                break;
            case FeUserType::TYPE_SHOPWIZARD:
                $url = Yii::$app->getUrlManager()->createUrl(['/shopwizard']);
                break;
            case FeUserType::TYPE_FAVOURED_CUSTOMER:
            case FeUserType::TYPE_NORMAL_CUSTOMER:
            case FeUserType::TYPE_BIZ_CUSTOMER:
                $url = Yii::$app->getUrlManager()->createUrl(['/customer']);
                break;
            default:
                $url = Yii::$app->getHomeUrl();
        }
        return $url;
//        $url = Yii::$app->getSession()->get($this->returnUrlParam, $defaultUrl);
//        if (is_array($url)) {
//            if (isset($url[0])) {
//                return Yii::$app->getUrlManager()->createUrl($url);
//            } else {
//                $url = null;
//            }
//        }
//
//        return $url === null ? Yii::$app->getHomeUrl() : $url;
    }

}
