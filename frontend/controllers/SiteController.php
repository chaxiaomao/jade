<?php

namespace frontend\controllers;

use common\models\c2\entity\ChessModel;
use common\models\c2\entity\UserChessRsModel;
use cza\base\models\statics\ResponseDatum;
use frontend\components\Controller;
use frontend\models\LoginForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['*'],
                'rules' => [
                    [
                        'actions' => ['tips'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'tips', 'error', 'station', 'chess-list', 'chess-change'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                // 'denyCallback' => function ($rule, $action) {
                //     return \Yii::$app->getUser()->loginRequired();
                // },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function checkAccess()
    {
        if (!Yii::$app->user->isGuest) {
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {

            // $user = Yii::$app->user->currentUser;
            // $stations = $user->getUserChessRs()->all();
            // return $this->render('user_station_list', [
            //     'stations' => $stations
            // ]);
            // $this->goBack();
            // return $this->redirect(Yii::$app->user->getReturnUrl());
            return $this->redirect('user/station-list');
        }
        // return $this->render('index');
    }


    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionError() {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            if(!Yii::$app->user->isGuest){
                return $this->render('error', ['message' => $exception]);
            }
            else{
                // $this->layout = 'main-public';
                return $this->render('error', ['message' => $exception]);
            }
        }
    }

    public function actionStation($t)
    {
        $user = Yii::$app->user->currentUser;
        $currentChess = $user->getCurrentChess();
        $model = UserChessRsModel::find()->where(['chess_id' => $currentChess->chess_id, 'type' => $t])->all();
        return $this->render('station', [
            'model' => $model
        ]);
    }

    public function actionChessList()
    {
        $user = Yii::$app->user->currentUser;
        $model = $user->userChessRs;
        return $this->render('chess_list', [
            'model' => $model
        ]);
    }

    public function actionChessChange()
    {

        $params = Yii::$app->request->post();
        Yii::$app->session->set('current_chess_id', $params['chess_id']);
        $responseData = ResponseDatum::getSuccessDatum(['message' => Yii::t('cza', 'Operation completed successfully!')], $params['chess_id']);
        return $this->asJson($responseData);
    }

}
