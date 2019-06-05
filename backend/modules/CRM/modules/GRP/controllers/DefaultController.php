<?php

namespace backend\modules\CRM\modules\GRP\controllers;

use common\models\c2\statics\GRPType;
use Yii;
use common\models\c2\entity\GRPModel;
use common\models\c2\search\GRPSearch;

use cza\base\components\controllers\backend\ModelController as Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for GRPModel model.
 */
class DefaultController extends Controller
{
    public $modelClass = 'common\models\c2\entity\GRPModel';

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'citys' => [
                'class' => 'common\components\actions\RegionOptionsAction',
            ],
            'districts' => [
                'class' => 'common\components\actions\DistricRegionOptionsAction',
            ],
        ]);
    }

    /**
     * Lists all GRPModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GRPSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $this->retrieveModel(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GRPModel model.
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
     * create/update a GRPModel model.
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

    public function actionCreateBranch($id = null, $parent_id = null)
    {
        $model = $this->retrieveModel($id);
        $model->type = GRPType::TYPE_BRANCH;
        if (!is_null($parent_id)) {
            $model->parentId = $parent_id;
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }

        return (Yii::$app->request->isAjax) ? $this->renderAjax('edit', ['model' => $model,]) : $this->render('edit', ['model' => $model,]);
    }

    /**
     * Finds the GRPModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GRPModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GRPModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
