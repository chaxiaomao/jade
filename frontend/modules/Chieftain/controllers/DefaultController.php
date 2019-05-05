<?php

namespace frontend\modules\Chieftain\controllers;

use backend\models\c2\form\DevelopmentForm;
use common\models\c2\entity\UserChessRsModel;
use common\models\c2\entity\UserKpiModel;
use common\models\c2\entity\UserProfitItemModel;
use common\models\c2\statics\FeUserType;
use common\models\c2\statics\UserKpiStateType;
use common\models\c2\statics\UserProfitType;
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
        $state = Yii::$app->request->get('state', UserKpiStateType::TYPE_NOT_COMMIT);
        $user = Yii::$app->user->currentUser;
        $currentChess = $user->getCurrentChess();
        $model = UserKpiModel::find()->where(['chess_id' => $currentChess->chess_id, 'state' => $state])->all();
        return $this->render('kpi_list', [
            'model' => $model,
            'state' => $state,
        ]);
    }

    public function actionKpiEdit($id)
    {
        $kpiModel = UserKpiModel::findOne($id);
        $ownerFamiliar = $kpiModel->getOwnerFamiliar($kpiModel->chess_id);
        $ownerMasters = $kpiModel->getOwnerMasters($ownerFamiliar->id, $kpiModel->chess_id);
        $query = UserChessRsModel::find()->where(['chess_id' => $kpiModel->chess_id])
            ->andFilterWhere(['status' => EntityModelStatus::STATUS_ACTIVE]);
        // $peasants = $query->where(['type' => FeUserType::TYPE_PEASANT])->count();
        $ownerChieftains = $query->where(['type' => FeUserType::TYPE_CHIEFTAIN])->all();
        $ownerElders = $query->where(['type' => FeUserType::TYPE_ELDER])->all();
        $ownerLords = $query->where(['type' => FeUserType::TYPE_LORD])->all();

        return $this->render('kpi_edit', [
            'kpiModel' => $kpiModel,
            // 'peasants' => $peasants,
            'ownerFamiliar' => $ownerFamiliar,
            'ownerMasters' => $ownerMasters,
            'ownerChieftains' => $ownerChieftains,
            'ownerElders' => $ownerElders,
            'ownerLords' => $ownerLords,
        ]);

    }

    public function actionKpiCommit($id)
    {
        $kpiModel = UserKpiModel::findOne($id);
        if (Yii::$app->request->isPost) {
            $params = Yii::$app->request->post();
            $kpiModel->setAttributes($params['UserKpiModel']);
            $kpiModel->state = UserKpiStateType::TYPE_CHIEFTAIN_COMMIT;
            $kpiModel->items = $params['items'];
            if ($kpiModel->save()) {
                Yii::$app->session->setFlash($kpiModel->getMessageName(), [Yii::t('app.c2', 'Kpi commit successful.')]);
            } else {
                Yii::$app->session->setFlash($kpiModel->getMessageName(), $kpiModel->errors);
            }
        }
        return $this->render('kpi_commitment', ['kpiModel' => $kpiModel]);
    }

}
