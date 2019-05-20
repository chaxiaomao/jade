<?php

namespace backend\modules\CRM\modules\GRP\modules\GRPStation\controllers;

use common\models\c2\entity\GRPModel;
use common\models\c2\entity\GRPStationModel;
use cza\base\components\controllers\backend\ModelController as Controller;
use Yii;

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
    public function actionIndex($id)
    {
        $model = GRPModel::findOne($id);
        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionAddStation()
    {
        $params = Yii::$app->request->post();
        foreach ($params['data'] as $param) {
            $model = new GRPStationModel();
            $model->setAttributes($param);
            if (!$model->save()) {
                Yii::info($model->errors);
            }
        }
        return true;
    }

}
