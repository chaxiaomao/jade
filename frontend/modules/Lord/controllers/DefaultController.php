<?php

namespace frontend\modules\Lord\controllers;

use common\models\c2\statics\FeUserType;
use frontend\components\behaviors\UserTypeBehavior;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `lord` module
 */
class DefaultController extends \frontend\components\Controller
{

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'userTypeFilter' => [
                'class' => UserTypeBehavior::className(),
                'chessUserType' => FeUserType::TYPE_LORD
            ],
        ]); // TODO: Change the autogenerated stub
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index', [
        ]);
    }

}
