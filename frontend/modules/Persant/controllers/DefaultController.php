<?php

namespace frontend\modules\Persant\controllers;

use common\models\c2\entity\UserChessRsModel;
use common\models\c2\statics\FeUserType;
use cza\base\models\statics\EntityModelStatus;
use frontend\components\behaviors\UserTypeBehavior;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `peasant` module
 */
class DefaultController extends Controller
{

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
           'userTypeFilter' => [
               'class' => UserTypeBehavior::className(),
               'chessUserType' => FeUserType::TYPE_PEASANT
           ],
        ]); // TODO: Change the autogenerated stub
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
