<?php

namespace backend\modules\CRM\modules\GRP\modules\GRPStation\controllers;

use cza\base\components\controllers\backend\ModelController as Controller;

/**
 * Default controller for the `grp-station` module
 */
class DefaultController extends Controller
{
    public $modelClass = 'common\models\c2\entity\GRPStationModel';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
