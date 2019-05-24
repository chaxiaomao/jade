<?php

namespace backend\modules\CRM\modules\GRP\modules\GRPStation\controllers;

use common\models\c2\entity\GRPModel;
use common\models\c2\statics\NodeNavType;
use cza\base\models\statics\ResponseDatum;
use Yii;
use common\models\c2\entity\GRPStationModel;
use common\models\c2\entity\GRPStationSearch;

use cza\base\components\controllers\backend\ModelController as Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for GRPStationModel model.
 */
class DefaultController extends Controller
{
    public $modelClass = 'common\models\c2\entity\GRPStationModel';

    /**
     * Lists all GRPStationModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GRPStationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $this->retrieveModel(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GRPStationModel model.
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
     * create/update a GRPStationModel model.
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

    public function actionEditWithChart($id = null, $grp_id = null)
    {
        $grpModel = GRPModel::findOne($grp_id);
        $model = new GRPStationModel();
        $model->loadDefaultValues();
        $model->grp_id = $grpModel->id;

        if ($model->load(Yii::$app->request->post())) {
            Yii::info(Yii::$app->request->post());
            if ($model->node_nav == NodeNavType::TYPE_CHILDREN) {
                $model->parent_station_id = $model->selected_id;
                $model->type += 1;
                Yii::info($model->parent_station_id);
                Yii::info($model->type);
            }
            if ($model->save()) {
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }

        return (Yii::$app->request->isAjax) ? $this->renderAjax('edit_wc', ['model' => $model, 'grpModel' => $grpModel]) :
            $this->render('edit_wc', ['model' => $model, 'grpModel' => $grpModel]);
    }

    /**
     * Finds the GRPStationModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GRPStationModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GRPStationModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionStationDelete()
    {
        $params = Yii::$app->request->post();
        if ($model = GRPStationModel::findOne($params['id'])) {
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
    
}
