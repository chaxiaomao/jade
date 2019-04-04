<?php

namespace frontend\modules\Lord\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `lord` module
 */
class DefaultController extends \frontend\components\Controller
{

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['setting-phone', 'sms-captcha'],
                        'allow' => true,
                        'roles' => ['?'],
                        'matchCallback' => [$this, 'checkAccess'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'sms-captcha' => [
                'class' => 'common\components\SmsCaptcha\CaptchaAction',
                'minLength' => 4,
                'maxLength' => 4,
                //                'sendSms' => false,
                'sendSms' => true,
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
