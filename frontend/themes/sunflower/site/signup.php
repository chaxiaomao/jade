<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use common\components\SmsCaptcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\builder\Form;

$messageName = $model->getMessageName();
$this->title = Yii::t('app.c2', 'Register');
?>

<div class="bg">
    <p class="welcome"><?= Yii::t('app.c2', 'Welcome to Signup') ?></p>
</div>
<div class="container">
    <?php
    $form = \kartik\widgets\ActiveForm::begin([
        'options' => [
            'id' => $model->getBaseFormName(),
            'data-pjax' => false,
            // 'class' => 'form-horizontal'
        ]]);
    ?>

    <div class="form-group row">
        <label for="signupform-username" class="col-xs-2 control-label"><?= Yii::t('app.c2', 'Username') ?></label>
        <div class="col-xs-10">
            <?= $form->field($model, 'username')->textInput([
                'placeholder' => $model->getAttributeLabel('username')
            ])->label(false) ?>
        </div>
    </div>

    <div class="form-group row">
        <label for="signupform-mobile_number" class="col-xs-2 control-label"><?= Yii::t('app.c2', 'Mobile Number') ?></label>
        <div class="col-xs-10">
            <?= $form->field($model, 'mobile_number')->textInput([
                'placeholder' => $model->getAttributeLabel('mobile_number')
            ])->label(false) ?>
        </div>
    </div>

    <div class="form-group row">
        <label for="signupform-password" class="col-xs-2 control-label"><?= Yii::t('app.c2', 'Password') ?></label>
        <div class="col-xs-10">
            <?= $form->field($model, 'password')->passwordInput([
                'placeholder' => $model->getAttributeLabel('password')
            ])->label(false) ?>
        </div>
    </div>


    <div class="form-group row">
        <label for="signupform-verifycode" class="col-xs-2 control-label"><?= Yii::t('app.c2', 'Captcha') ?></label>
        <div class="col-xs-10">
            <?php

            echo Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 1,
                'attributes' => [
                    'verifyCode' => [
                        'type' => Form::INPUT_WIDGET,
                        'widgetClass' => Captcha::className(),
                        'options' => [
                            'form' => $form,
                            'mobileId' => Html::getInputId($model, 'mobile_number'),
                            // 'captchaAction' => '/site/sms-captcha',
                        ],
                        'label' => false,
                        // 'fieldConfig' => [
                        //     'template' => '{input}',
                        // ],
                    ],
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="form-group row">
        <label for="signupform-recommendcode" class="col-xs-2 control-label"><?= Yii::t('app.c2', 'Recommend Code') ?></label>
        <div class="col-xs-10">
            <?= $form->field($model, 'recommendCode')->textInput([
                'placeholder' => $model->getAttributeLabel('recommendCode')
            ])->label(false) ?>
        </div>
    </div>

    <button type="submit" class="btn btn-warning btn-block font-white"><?= Yii::t('app.c2', 'Signup') ?></button>


    <div class="tc mt40">
        <a href="/site/login"><?= Yii::t('app.c2', 'Login Account') ?></a>
    </div>

    <?php
    \kartik\widgets\ActiveForm::end();
    ?>
</div>
