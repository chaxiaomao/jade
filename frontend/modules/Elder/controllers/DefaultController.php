<?php

namespace frontend\modules\Elder\controllers;

use common\models\c2\statics\FeUserType;
use frontend\components\behaviors\UserTypeBehavior;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `elder` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'userTypeFilter' => [
                'class' => UserTypeBehavior::className(),
                'chessUserType' => FeUserType::TYPE_ELDER
            ],
        ]); // TODO: Change the autogenerated stub
    }

    public function actionIndex()
    {
        return $this->render('index', [
        ]);
    }

}
