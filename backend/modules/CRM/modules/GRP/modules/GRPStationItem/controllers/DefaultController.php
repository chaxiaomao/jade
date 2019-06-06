<?php

namespace backend\modules\CRM\modules\GRP\modules\GRPStationItem\controllers;

use common\models\c2\entity\FeUserModel;
use common\models\c2\entity\GRPModel;
use common\models\c2\entity\GRPStationModel;
use cza\base\models\statics\ResponseDatum;
use Yii;
use common\models\c2\entity\GRPStationItemModel;
use common\models\c2\search\GRPStationItemSearch;

use cza\base\components\controllers\backend\ModelController as Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for GRPStationItemModel model.
 */
class DefaultController extends Controller
{
    public $modelClass = 'common\models\c2\entity\GRPStationItemModel';

    /**
     * Lists all GRPStationItemModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GRPStationItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $this->retrieveModel(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GRPStationItemModel model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * create/update a GRPStationItemModel model.
     * fit to pajax call
     * @return mixed
     */
    public function actionEdit($id = null)
    {
        $model = $this->retrieveModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }

        return (Yii::$app->request->isAjax) ? $this->renderAjax('edit', ['model' => $model,]) : $this->render('edit', ['model' => $model,]);
    }

    public function actionEditWithChart($grp_id = null)
    {
        $model = new GRPStationItemModel();
        $model->loadDefaultValues();
        $grpModel = GRPModel::findOne($grp_id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }

        return (Yii::$app->request->isAjax) ? $this->renderAjax('edit_wc', [
            'model' => $model,
            'grpModel' => $grpModel,
            'showParentGrp' => false,
        ]) : $this->render('edit_wc', [
            'model' => $model,
            'grpModel' => $grpModel,
            'showParentGrp' => false,
        ]);
    }

    public function actionEditBranchWithChart($grp_id)
    {
        $model = new GRPStationItemModel();
        $model->loadDefaultValues();
        $grpModel = GRPModel::findOne($grp_id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }

        return (Yii::$app->request->isAjax) ? $this->renderAjax('edit_wc', [
            'model' => $model,
            'grpModel' => $grpModel,
            'showParentGrp' => true,
        ]) : $this->render('edit_wc', [
            'model' => $model,
            'grpModel' => $grpModel,
            'showParentGrp' => true,
        ]);
    }

    /**
     * Finds the GRPStationItemModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GRPStationItemModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GRPStationItemModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMemberDelete()
    {
        $params = Yii::$app->request->post();
        if ($model = GRPStationItemModel::findOne($params['id'])) {
            if ($model->delete()) {
                $responseData = ResponseDatum::getSuccessDatum(['message' => Yii::t('cza', 'Operation completed successfully!')], $params);
            } else {
                $responseData = ResponseDatum::getErrorDatum(['message' => Yii::t('cza', 'Error: operation can not finish!!')], $ids);
            }
        } else {
            $responseData = ResponseDatum::getErrorDatum(['message' => Yii::t('cza', 'Error: operation can not finish!!')], $ids);
        }
        return $this->asJson($responseData);
    }

    public function actionMemberKpi($user_id = null, $grp_id = null)
    {
        $this->layout = '/main-empty';
        $user = FeUserModel::findOne($user_id);
        return $this->render('member_kpi', ['user' => $user, 'grp_id' => $grp_id]);
    }

}
