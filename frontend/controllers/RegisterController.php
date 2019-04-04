<?php

namespace frontend\controllers;

use common\models\c2\entity\Salesman;
use frontend\components\Controller;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use cza\base\models\statics\ResponseDatum;
use yii\helpers\Url;

/**
 * Register controller
 */
class RegisterController extends Controller {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'citys' => [
                'class' => 'common\components\actions\RegionOptionsAction',
            ],
            'districts' => [
                'class' => 'common\components\actions\DistricRegionOptionsAction',
            ],
            'sms-captcha' => [
                'class' => 'common\components\SmsCaptcha\CaptchaAction',
                'minLength' => 4,
                'maxLength' => 4,
                'sendSms' => (YII_ENV !== YII_ENV_DEV),
            ],
        ];
    }
}
