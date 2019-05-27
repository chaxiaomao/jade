<?php

namespace frontend\controllers;

use common\models\c2\entity\ChessModel;
use common\models\c2\entity\GRPModel;
use common\models\c2\entity\GRPStationModel;
use common\models\c2\entity\UserChessRsModel;
use common\models\c2\entity\UserKpiModel;
use common\models\c2\statics\GRPStationType;
use common\models\c2\statics\UserKpiStateType;
use cza\base\models\statics\ResponseDatum;
use frontend\components\Controller;
use frontend\models\ForgetPasswordForm;
use frontend\models\LoginForm;
use http\Exception\BadMessageException;
use Yii;
use yii\base\InvalidArgumentException;
use yii\base\InvalidConfigException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\HttpException;
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
                            'center', 'kpi', 'profit', 'kpi-verify', 'kpi-commit'],
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
            $user = Yii::$app->user->currentUser;
            $models = $user->gRPs;
            return $this->render('index', [
                'models' => $models,
            ]);
            // return $this->render('index');
        }
    }

    public function actionCenter($s)
    {
        $grpModel = GRPModel::findOne(['seo_code' => $s]);
        $grpSession = Yii::$app->session;
        $grpSession->set('grp_id', $grpModel->id);
        if (is_null($grpModel)) {
            throw new BadRequestHttpException(Yii::t('app.c2', 'Params not allow'));
        }
        $c1StationModel = GRPStationModel::findOne(['grp_id' => $grpModel->id, 'type' => GRPStationType::TYPE_C1]);
        $c1StationItemModel = $c1StationModel->getGRPStationItems()->one();

        return $this->render('center', [
            'grpModel' => $grpModel,
            'c1StationItemModel' => $c1StationItemModel,
        ]);
    }

    public function actionKpi()
    {
        $user = Yii::$app->user->currentUser;
        $grpSession = Yii::$app->session;
        $code = $user->getInviteCode($grpSession->get('grp_id'));
        if (is_null($code)) {
            throw new BadRequestHttpException(Yii::t('app.c2', 'Params not allow'));
        }
        $grpModel = GRPModel::findOne($grpSession->get('grp_id'));
        $kpiModels = UserKpiModel::find()
            ->where(['invite_user_id' => $user->id, 'grp_id' => $grpSession->get('grp_id')])
            ->all();
        return $this->render('kpi', [
            'code' => $code,
            'kpiModels' => $kpiModels,
            'grpModel' => $grpModel,
        ]);

    }

    public function actionProfit()
    {

    }

    public function actionKpiVerify()
    {
        $grpSession = Yii::$app->session;
        $kpiModels = UserKpiModel::find()->where(['grp_id' => $grpSession->get('grp_id')])->all();
        return $this->render('kpiVerify', [
            'kpiModels' => $kpiModels
        ]);
    }

    public function actionKpiCommit($id)
    {
        $model = UserKpiModel::findOne($id);
        if ($model->state == UserKpiStateType::TYPE_FINISH_COMMIT) {
            throw new BadRequestHttpException(Yii::t('app.c2', 'Kpi has been commit finish.'));
        }
        $model->setScenario(UserKpiModel::SCENARIO_COMMIT);
        $grpModel = GRPModel::findOne(['id' => $model->grp_id]);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save() && $model->createNewMember()) {
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }

        return (Yii::$app->request->isAjax) ? $this->renderAjax('kpiCommit', [
            'model' => $model, 'grpModel' => $grpModel]) : $this->render('kpiCommit', ['model' => $model, 'grpModel' => $grpModel]);
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
    public function actionSignup()
    {
        $this->layout = 'empty';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new SignupForm();
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
