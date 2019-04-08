<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\components\RecommendCaptcha;

use common\models\c2\entity\FeUserAuthModel;
use common\models\c2\entity\FeUserModel;
use common\models\c2\statics\FeUserType;
use Yii;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\helpers\Url;
use yii\web\Response;
use yii\helpers\Html;
use cza\base\models\statics\ResponseDatum;

/**
 * CaptchaAction renders a CAPTCHA image.
 *
 * CaptchaAction is used together with [[Captcha]] and [[\yii\captcha\CaptchaValidator]]
 * to provide the [CAPTCHA](http://en.wikipedia.org/wiki/Captcha) feature.
 *
 * By configuring the properties of CaptchaAction, you may customize the appearance of
 * the generated CAPTCHA images, such as the font color, the background color, etc.
 *
 * Note that CaptchaAction requires either GD2 extension or ImageMagick PHP extension.
 *
 * Using CAPTCHA involves the following steps:
 *
 * 1. Override [[\yii\web\Controller::actions()]] and register an action of class CaptchaAction with ID 'captcha'
 * 2. In the form model, declare an attribute to store user-entered verification code, and declare the attribute
 *    to be validated by the 'captcha' validator.
 * 3. In the controller view, insert a [[Captcha]] widget in the form.
 *
 * @property string $verifyCode The verification code. This property is read-only.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CaptchaAction extends Action {

    /**
     * Initializes the action.
     * @throws InvalidConfigException if the font file does not exist.
     */
    public function init() {
        parent::init();
    }

    /**
     * Runs the action.
     */
    public function run() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = ResponseDatum::getSuccessDatum([
            'message' => Yii::t('app.c2', 'Recommend code generated!'),
            'data' => false
        ]);
        $user = Yii::$app->user->currentUser;
        if (is_null($user)) {
            return $result;
        }
        $model = $user->recommendCode;
        if (is_null($model)) {
            $code = $this->generateRandomString();
            $model = new FeUserAuthModel();
            $model->setAttributes([
                'type' => $user->type,
                'user_id' => $user->id,
                'source' => $code,
                'expired_at' => date("Y-m-d", strtotime('+1 day ', time())),
            ]);
            $model->save();
        } else {
            if (strtotime($model->expired_at) < strtotime(time())) {
                $model->updateAttributes([
                    'source' => $this->generateRandomString(),
                ]);
            }
        }

        $result = ResponseDatum::getSuccessDatum([
            'message' => Yii::t('app.c2', 'Recommend code generated!'),
            'data' => $model->source
        ]);
        return $result;
    }

    public function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

}
