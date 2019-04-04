<?php

namespace frontend\modules\Chieftain\controllers;

use yii\web\Controller;

/**
 * Default controller for the `chieftain` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
