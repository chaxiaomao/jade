<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/30
 * Time: 15:56
 */

namespace frontend\controllers;


use common\models\c2\entity\ChessModel;
use common\models\c2\search\UserProfitItemSearch;
use frontend\components\Controller;
use frontend\models\ContactForm;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;

class UserController extends Controller
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
                        'actions' => ['signup', 'login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [ 'recommend-code-captcha', 'login', 'signup',
                            'chess', 'settings','development', 'logout', 'profit', 'station-list'],
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

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'recommend-code-captcha' => [
                'class' => 'frontend\components\RecommendCaptcha\CaptchaAction',
            ],
        ];
    }

    public function actionChess($id)
    {
        $model = ChessModel::findOne($id);
        Yii::$app->session->set('chess', ['chess_id' => $model->id, 'chess_name' => $model->label]);
        return $this->refresh();
    }

    public function actionSettings()
    {
        return $this->render('settings');
    }

    public function actionDevelopment()
    {
        $user = Yii::$app->user->currentUser;
        $model = $user->userKpi;
        return $this->render('development', [
            'model' => $model,
        ]);
    }

    // public function actionKpi()
    // {
    //     $user = Yii::$app->user->currentUser;
    //     $model = $user->userKpi;
    //     return $this->render('kpi_list', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionProfit()
    {
        $user = Yii::$app->user->currentUser;
        // $model = $user->profitItem;
        $searchModel = new UserProfitItemSearch();
        $searchModel->user_id = $user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('profit_list', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = 'empty';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // return $this->goBack();
            return $this->redirect('/user/station-list');
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionStationList()
    {
        $user = Yii::$app->user->currentUser;
        $currentChess = $user->getCurrentChess();
        $stations = $user->getUserChessRs()->all();
        return $this->render('user_station_list', [
            'stations' => $stations,
            'currentChess' => $currentChess,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->session->remove('current_chess_id');
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $this->layout = 'empty';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signupPer()) {
                if (Yii::$app->getUser()->login($user)) {
                    $this->layout = 'main';
                    return $this->render('error', [
                        'message' => Yii::t('app.c2', 'Waiting for chieftain commit'),
                    ]);
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

}