<?php

namespace frontend\modules\Chieftain\controllers;

use common\models\c2\entity\UserKpiModel;
use cza\base\models\statics\EntityModelStatus;
use Yii;
use yii\data\ActiveDataProvider;
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
        return $this->render('index', [
        ]);
    }

    public function actionKpiList()
    {
        $status = Yii::$app->request->get('status', EntityModelStatus::STATUS_INACTIVE);
        $user = Yii::$app->user->currentUser;
        $currentChess = $user->getCurrentChess();
        $model = UserKpiModel::find()->where(['chess_id' => $currentChess->chess_id, 'status' => $status])->all();
        return $this->render('kpi_list', [
            'model' => $model
        ]);
    }

}
