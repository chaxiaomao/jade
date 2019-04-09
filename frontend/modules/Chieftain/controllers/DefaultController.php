<?php

namespace frontend\modules\Chieftain\controllers;

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
        if (Yii::$app->request->url != Yii::$app->user->getReturnUrl()) {
            return $this->redirect(Yii::$app->user->getReturnUrl());
        }
        $user = Yii::$app->user->currentUser;
        $query = $user->getMaster();
        return $this->render('index', [
            'count' => $count = $query->count()
        ]);
    }

    public function actionMemberList()
    {
        $user = Yii::$app->user->currentUser;
        $query = $user->getPeasants();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
                'params' => Yii::$app->request->get(),
            ],
        ]);
        return $this->render('members', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
