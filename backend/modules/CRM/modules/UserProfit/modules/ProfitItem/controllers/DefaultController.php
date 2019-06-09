<?php

namespace backend\modules\CRM\modules\UserProfit\modules\ProfitItem\controllers;

use common\models\c2\statics\UserProfitState;
use Yii;
use common\models\c2\entity\UserProfitItemModel;
use common\models\c2\search\UserProfitItemSearch;

use cza\base\components\controllers\backend\ModelController as Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for UserProfitItemModel model.
 */
class DefaultController extends Controller
{
    public $modelClass = 'common\models\c2\entity\UserProfitItemModel';
    
    /**
     * Lists all UserProfitItemModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = '/main-empty';
        $searchModel = new UserProfitItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index_simple', [
            'model' => $this->retrieveModel(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserProfitItemModel model.
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
     * create/update a UserProfitItemModel model.
     * fit to pajax call
     * @return mixed
     */
    public function actionEdit($id = null, $user_id = null, $kpi_id = null, $grp_id = null)
    {
        $model = $this->retrieveModel($id);
        // $model->state = UserProfitState::ASSIGNED;

        if (!is_null($user_id)) {
            $model->user_id = $user_id;
        }

        if (!is_null($kpi_id)) {
            $model->kpi_id = $kpi_id;
        }

        if (!is_null($grp_id)) {
            $model->grp_id = $grp_id;
        }
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }
        
        return (Yii::$app->request->isAjax) ? $this->renderAjax('edit', [ 'model' => $model,]) : $this->render('edit', [ 'model' => $model,]);
    }
    
    /**
     * Finds the UserProfitItemModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserProfitItemModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserProfitItemModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
