<?php

namespace frontend\modules\Persant\controllers;

use yii\web\Controller;

/**
 * Default controller for the `peasant` module
 */
class DefaultController extends Controller
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
