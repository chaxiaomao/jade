<?php

namespace backend\modules\CRM\modules\Chess\modules\UserChessRs\controllers;

use backend\models\c2\form\DevelopmentForm;
use common\models\c2\statics\FeUserType;
use Yii;
use common\models\c2\entity\UserChessRsModel;
use common\models\c2\search\UserChessRsSearch;

use cza\base\components\controllers\backend\ModelController as Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for UserChessRsModel model.
 */
class DefaultController extends Controller
{
    public $modelClass = 'common\models\c2\entity\UserChessRsModel';
    
    /**
     * Lists all UserChessRsModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserChessRsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $this->retrieveModel(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserChessRsModel model.
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
     * create/update a UserChessRsModel model.
     * fit to pajax call
     * @return mixed
     */
    public function actionEdit($id = null, $chess_id = null)
    {
        $model = $this->retrieveModel($id);
        $model->scenario = UserChessRsModel::SCENARIO_UPDATE_USER;

        // if ($model->type != FeUserType::TYPE_LORD && $model->getChessUser8Type() == null) {
        //     $model->addErrors([Yii::t('app.c2', 'Please set higher user first.')]);
        //     Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
        // }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }
        
        return (Yii::$app->request->isAjax) ? $this->renderAjax('_form', [ 'model' => $model,]) : $this->render('_form', [ 'model' => $model,]);
    }

    public function actionEditLord($id = null, $chess_id = null)
    {
        $model = $this->retrieveModel($id);
        $model->type = FeUserType::TYPE_LORD;
        $model->chess_id = $chess_id;
        $model->scenario = UserChessRsModel::SCENARIO_CREATE_USER;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }

        return (Yii::$app->request->isAjax) ? $this->renderAjax('edit', [ 'model' => $model,]) : $this->render('edit', [ 'model' => $model,]);
    }

    public function actionAddDevelopment($id = null, $chess_id = null, $type = null)
    {
        $model = new DevelopmentForm(['parent_id' => $id, 'chess_id' => $chess_id, 'type' => $type]);
        $model->scenario = UserChessRsModel::SCENARIO_CREATE_USER;
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
     * Finds the UserChessRsModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return UserChessRsModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserChessRsModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
