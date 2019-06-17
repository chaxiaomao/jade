<?php
namespace frontend\controllers;

use AlibabaCloud\Client\AlibabaCloud;
use common\models\c2\entity\GRPStationItemModel;
use common\models\c2\search\UserSumApplyModel as UserSumApplyModelSearch;
use common\models\c2\search\GRPStationItemSearch;
use common\models\c2\search\UserKpiSearch;
use common\models\c2\search\UserProfitItemSearch;

use frontend\components\actions\UserQRCodeAction;
use frontend\components\Controller;
use frontend\models\ForgetPasswordForm;
use frontend\models\LoginForm;
use frontend\models\SumApplyForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
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
                        'actions' => ['signup', 'login', 'forget-password'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'error', 'logout', 'login', 'signup',
                            'center', 'kpi', 'profit', 'kpi-chart', 'qr-code', 'sum-apply', 'sum-apply-record'],
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
            'qr-code' => [
                'class' => UserQRCodeAction::className(),
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
            $user = Yii::$app->user->currentUser;
            $searchModel = new GRPStationItemSearch();
            $searchModel->user_id = $user->id;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
            // return $this->render('index');
        }
    }

    public function actionCenter($p)
    {
        $id = Yii::$app->getSecurity()->validateData($p, 'id');
        $grpStationItemModel = GRPStationItemModel::findOne($id);
        if (is_null($grpStationItemModel)) {
            throw new NotFoundHttpException(Yii::t('app.c2', 'Params not allow.'));
        }
        $grpModel = $grpStationItemModel->gRPStation->gRP;
        $grpSession = Yii::$app->session;
        $grpSession->set('grp_id', $grpModel->id);
        return $this->render('center', [
            'grpModel' => $grpModel,
            'type' => $grpStationItemModel->gRPStation->type,
        ]);
    }

    public function actionKpi()
    {
        $user = Yii::$app->user->currentUser;
        $grpSession = Yii::$app->session;
        if (is_null($grpSession->get('grp_id'))) {
            throw new NotFoundHttpException(Yii::t('app.c2', 'Params not allow.'));
        }
        $searchModel = new UserKpiSearch();
        $searchModel->grp_id = $grpSession->get('grp_id');
        $searchModel->invite_user_id = $user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('kpi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProfit()
    {
        $user = Yii::$app->user->currentUser;
        $grpSession = Yii::$app->session;
        if (is_null($grpSession->get('grp_id'))) {
            throw new NotFoundHttpException(Yii::t('app.c2', 'Params not allow.'));
        }
        $model = $user->profit;
        $searchModel = new UserProfitItemSearch();
        $searchModel->user_id = $user->id;
        $searchModel->grp_id = $grpSession->get('grp_id');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('profit', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionKpiChart()
    {
        return $this->render('kpiChart');
    }

    public function actionSumApply()
    {
        $model = new SumApplyForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Sum Apply Success')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }

        return (Yii::$app->request->isAjax) ? $this->renderAjax('sumApply', ['model' => $model,]) : $this->render('sumApply', ['model' => $model,]);
    }

    public function actionSumApplyRecord()
    {
        $searchModel = new UserSumApplyModelSearch();
        $searchModel->user_id = Yii::$app->user->currentUser->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('SumApplyRecord', [
            'searchModel' => $searchModel,
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
            return $this->goHome();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup($c = null)
    {
        $this->layout = 'empty';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new SignupForm();
        if (!is_null($c)) {
            $model->recommendCode = $c;
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionForgetPassword()
    {
        $this->layout = 'empty';
        $model = new ForgetPasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return $this->goHome();
        }

        return $this->render('forgetPassword', [
            'model' => $model
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

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            if (!Yii::$app->user->isGuest) {
                return $this->render('error', ['message' => $exception]);
            } else {
                // $this->layout = 'main-public';
                return $this->render('error', ['message' => $exception]);
            }
        }
    }

}
