<?php

namespace frontend\modules\Familiar\controllers;

use common\models\c2\entity\FamiliarModel;
use common\models\c2\search\PeasantSearch;
use frontend\widgets\MemberListWidget;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Controller;

/**
 * Default controller for the `familiar` module
 */
class DefaultController extends \frontend\components\Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        $user = Yii::$app->user->currentUser;
        // $query = $user->getCurrentChessUser();
        return $this->render('index', [
            // 'count' => $query->count()
            'count' => 9
        ]);
    }

    public function actionMemberList()
    {
        $user = Yii::$app->user->currentUser;
        $current_chess_id = Yii::$app->session->get('current_chess_id');
        $model = $user->getDevelopments($current_chess_id);

        return $this->render('members', [
            'model' => $model,
        ]);
    }
}
