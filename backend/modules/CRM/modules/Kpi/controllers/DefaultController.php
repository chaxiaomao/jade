<?php

namespace backend\modules\CRM\modules\Kpi\controllers;

use backend\models\c2\form\KpiCommitForm;
use common\models\c2\statics\UserKpiStateType;
use common\models\c2\statics\UserProfitType;
use cza\base\models\statics\ResponseDatum;
use Yii;
use common\models\c2\entity\UserKpiModel;
use common\models\c2\search\UserKpiSearch;

use cza\base\components\controllers\backend\ModelController as Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for UserKpiModel model.
 */
class DefaultController extends Controller
{
    // public $modelClass = 'common\models\c2\entity\UserKpiModel';
    public $modelClass = 'backend\models\c2\form\KpiCommitForm';

    /**
     * Lists all UserKpiModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserKpiSearch();
        // $searchModel->state = UserKpiStateType::TYPE_CHIEFTAIN_COMMIT;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $this->retrieveModel(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserKpiModel model.
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
        $model->loadItems();
        return (Yii::$app->request->isAjax) ? $this->renderAjax('edit', [ 'model' => $model,]) : $this->render('edit', [ 'model' => $model,]);
    }
    
    /**
     * Finds the UserKpiModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return UserKpiModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KpiCommitForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionEnsureDo($id)
    {
        $model = UserKpiModel::findOne($id);
        if ($model->setKpiStateAdminCommit()) {
            $responseData = ResponseDatum::getSuccessDatum(['message' => Yii::t('cza', 'Operation completed successfully!')], $id);
            return $this->asJson($responseData);
        }
        return null;
    }
}
