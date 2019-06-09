<?php

namespace backend\modules\CRM\modules\KPI\controllers;

use common\models\c2\entity\GRPModel;
use common\models\c2\statics\UserKpiStateType;
use cza\base\models\statics\ResponseDatum;
use Yii;
use common\models\c2\entity\UserKpiModel;
use common\models\c2\search\UserKpiSearch;

use cza\base\components\controllers\backend\ModelController as Controller;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for UserKpiModel model.
 */
class DefaultController extends Controller
{
    public $modelClass = 'common\models\c2\entity\UserKpiModel';

    /**
     * Lists all UserKpiModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserKpiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $this->retrieveModel(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserKpiModel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * create/update a UserKpiModel model.
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

    public function actionEditWithChart($id = null)
    {
        $model = \backend\models\c2\entity\UserKpiModel::findOne($id);
        if ($model->state == UserKpiStateType::TYPE_ADMIN_COMMIT) {
            Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Kpi has been commit finish.')]);
        } else {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->save() && $model->createNewMember()) {
                    Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
                } else {
                    Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
                }
            }
        }

        return (Yii::$app->request->isAjax) ? $this->renderAjax('edit', [
            'model' => $model]) : $this->render('edit', ['model' => $model]);
    }

    public function actionAssignWithChart($id = null)
    {
        $model = $this->retrieveModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $model->updateAttributes(['state' => UserKpiStateType::TYPE_FINISH_COMMIT]);
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }

        return (Yii::$app->request->isAjax) ? $this->renderAjax('_assign_with_chart_form', [
            'model' => $model]) : $this->render('_assign_with_chart_form', ['model' => $model]);
    }

    public function actionFinishAssignment($id)
    {
        try {
            $model = $this->retrieveModel($id);
            if ($model) {
                if ($model->commitProfit()) {
                    $responseData = ResponseDatum::getSuccessDatum(['message' => Yii::t('cza', 'Operation completed successfully!')], $id);
                }
            } else {
                $responseData = ResponseDatum::getErrorDatum(['message' => Yii::t('cza', 'Error: operation can not finish!')], $id);
            }
        } catch (\Exception $ex) {
            $responseData = ResponseDatum::getErrorDatum(['message' => $ex->getMessage()], $id);
        }

        return $this->asJson($responseData);
    }

    /**
     * Finds the UserKpiModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserKpiModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserKpiModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
