<?php

namespace backend\modules\CRM\modules\Chieftain\controllers;

use Yii;
use common\models\c2\entity\ChieftainModel;
use common\models\c2\search\ChieftainSearch;

use cza\base\components\controllers\backend\ModelController as Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for ChieftainModel model.
 */
class DefaultController extends Controller
{
    public $modelClass = 'common\models\c2\entity\ChieftainModel';
    
    /**
     * Lists all ChieftainModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChieftainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $this->retrieveModel(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ChieftainModel model.
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
     * create/update a ChieftainModel model.
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
        
        return (Yii::$app->request->isAjax) ? $this->renderAjax('edit', [ 'model' => $model,]) : $this->render('edit', [ 'model' => $model,]);
    }
    
    /**
     * Finds the ChieftainModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ChieftainModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ChieftainModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
