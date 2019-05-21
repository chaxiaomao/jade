<?php

namespace backend\modules\CRM\modules\UserDegree\controllers;

use common\components\controllers\TreeNodeController;
use common\models\c2\entity\FeUserModel;
use Yii;
use common\models\c2\entity\UserDegreeModel;
use common\models\c2\search\UserDegreeSearch;

use cza\base\components\controllers\backend\ModelController as Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for UserDegreeModel model.
 */
class DefaultController extends TreeNodeController
{
    protected $_nodeModelClass = 'common\models\c2\entity\UserDegreeModel';
    protected $modelClass = 'common\models\c2\entity\FeUserModel';

    /**
     * Lists all UserDegreeModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $searchModel = new UserDegreeSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            // 'model' => $this->retrieveModel(),
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserDegreeModel model.
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
     * create/update a FeuserModel model.
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
        
        return (Yii::$app->request->isAjax) ? $this->renderAjax('_user_form', [ 'model' => $model,]) : $this->render('_user_form', [ 'model' => $model,]);
    }
    
    /**
     * Finds the UserDegreeModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return FeUserModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FeUserModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUserEdit($id = null)
    {
        $model = $this->retrieveModel($id);
        // $model->degree_id = $degree_id;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }
        return (Yii::$app->request->isAjax) ? $this->renderAjax('_user_form', [ 'model' => $model,]) : $this->render('_user_form', [ 'model' => $model,]);
    }

    /**
     *
     * @param type $id
     * @param type $allowReturnNew
     * @return \cza\base\components\controllers\backend\modelClass
     * @throws NotFoundHttpException
     */
    public function retrieveModel($id = null, $allowReturnNew = true) {
        if (!is_null($id)) {
            $model = $this->findModel($id);
        } elseif (!$allowReturnNew) {
            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            $model = new $this->modelClass;
            $model->loadDefaultValues();
        }

        return $model;
    }

}
