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
    protected $_chess = null;
    public $loginUrl = ['user/login'];

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

    public function getFullname() {
        if (!isset($this->_attributes['fullname'])) {
            $this->_attributes['fullname'] = $this->getIdentity()->profile->getMemberName();
        }
        return $this->_attributes['fullname'];
    }

    public function getCurrentUser() {
        return $this->getIdentity();
    }

    public function loginByUserId($id, $type = null) {
        /* @var $class IdentityInterface */
        $class = $this->identityClass;
        $identity = $class::findIdentity($id, $type);
        if ($identity && $this->login($identity)) {
            return $identity;
        } else {
            return null;
        }
    }

    public function getReturnUrl($defaultUrl = null) {
        switch ($this->getIdentity()->type) {
            case FeUserType::TYPE_LORD:
                $url = Yii::$app->getUrlManager()->createUrl(['/lord']);
                break;
            case FeUserType::TYPE_ELDER:
                $url = Yii::$app->getUrlManager()->createUrl(['/elder']);
                break;
            case FeUserType::TYPE_CHIEFTAIN:
                $url = Yii::$app->getUrlManager()->createUrl(['/chieftain']);
                break;
            case FeUserType::TYPE_MASTER:
                $url = Yii::$app->getUrlManager()->createUrl(['/master']);
                break;
            case FeUserType::TYPE_FAMILIAR:
                $url = Yii::$app->getUrlManager()->createUrl(['/familiar']);
                break;
            case FeUserType::TYPE_PEASANT:
                $url = Yii::$app->getUrlManager()->createUrl(['/peasant']);
                break;
            // case FeUserType::TYPE_DEFAULT:
            //     $url = Yii::$app->getUrlManager()->createUrl(['/site']);
            //     break;
            default:
                // $url = Yii::$app->getHomeUrl();
                $url = Yii::$app->getUrlManager()->createUrl(['/peasant']);
        }
        return $url;
    }

    public function registerUrl() {
        $url = Yii::$app->getUrlManager()->createUrl(['user/signup']);
        return $url;
    }

    public function loginUrl() {
        $url = Yii::$app->getUrlManager()->createUrl(['user/login']);
        return $url;
    }

}
