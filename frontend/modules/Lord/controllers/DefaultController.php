<?php

namespace frontend\modules\Lord\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `lord` module
 */
class DefaultController extends \frontend\components\Controller
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (\Yii::$app->request->url != \Yii::$app->user->getReturnUrl()) {
            return $this->redirect(\Yii::$app->user->getReturnUrl());
        }
        return $this->render('index');
    }
}
