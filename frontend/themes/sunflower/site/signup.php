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
<style>
    .bg {
        background-size: 100% 100px;
        width: 100%;
        min-height: 100px;
        line-height: 25px;
        padding-top: 25px;
        margin-bottom: 25px;
        box-sizing: border-box;
        background-image: url("/images/sign-up-bg.png");
    }

    .welcome {
        text-align: center;
        color: white;
        font-size: 16px;
    }

    .col-xs-2 {
        padding-right: 0;
    }

    .col-xs-2 {
        padding-left: 0;
    }

    .row {
        margin: 0;
    }
</style>

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

    <button type="submit" class="btn btn-warning btn-block font-white"><?= Yii::t('app.c2', 'Signup') ?></button>

    <?php
    \kartik\widgets\ActiveForm::end();
    ?>
</div>
