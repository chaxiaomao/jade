<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use common\components\SmsCaptcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\builder\Form;

$messageName = $model->getMessageName();
$this->title = Yii::t('app.c2', 'User Register');
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

    <?php

    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [
            'username' => [
                'type' => Form::INPUT_TEXT,
                'label' => false,
                'fieldConfig' => [
                    'template' => '<label for="signupform-username" class="col-xs-2 control-label">' . $model->getAttributeLabel('username') . '</label>
                                    <div class="col-xs-10">{input}</div>',
                    'options' => ['class' => 'form-group row']
                ],
                'options' => [
                    'placeholder' => $model->getAttributeLabel('username'),
                    'class' => 'form-control-lg'
                ]
            ],
            'mobile_number' => [
                'type' => Form::INPUT_TEXT,
                'label' => false,
                'fieldConfig' => [
                    'template' => '<label for="signupform-mobile_number" class="col-xs-2 control-label">' . $model->getAttributeLabel('mobile_number') . '</label>
                                    <div class="col-xs-10">{input}</div>',
                    'options' => ['class' => 'form-group row']
                ],
                'options' => [
                    'placeholder' => $model->getAttributeLabel('mobile_number'),
                    'class' => 'form-control-lg'
                ]
            ],
            'password' => [
                'type' => Form::INPUT_PASSWORD,
                'label' => false,
                'fieldConfig' => [
                    'template' => '<label for="signupform-password" class="col-xs-2 control-label">' . $model->getAttributeLabel('password') . '</label>
                                    <div class="col-xs-10">{input}</div>',
                    'options' => ['class' => 'form-group row']
                ],
                'options' => [
                    'placeholder' => $model->getAttributeLabel('password'),
                    'class' => 'form-control-lg'
                ]
            ],
            'verifyCode' => [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => Captcha::className(),
                'label' => false,
                'options' => [
                    'form' => $form,
                    'mobileId' => Html::getInputId($model, 'verifyCode'),
                    // 'captchaAction' => '/site/sms-captcha',
                ],
                'fieldConfig' => [
                    'options' => ['class' => 'form-group row'],
                    'template' => '<label for="signupform-verifycode" class="col-xs-2 control-label">' . $model->getAttributeLabel('verifyCode') . '</label>
                                    <div class="col-xs-10">{input}</div>',
                ],
            ],
            'recommendCode' => [
                'type' => Form::INPUT_TEXT,
                'label' => false,
                'fieldConfig' => [
                    'template' => '<label for="signupform-recommendcode" class="col-xs-2 control-label">' . $model->getAttributeLabel('recommendCode') . '</label>
                                    <div class="col-xs-10">{input}</div>',
                    'options' => ['class' => 'form-group row']
                ],
                'options' => [
                    'placeholder' => $model->getAttributeLabel('recommendCode'),
                    'class' => 'form-control-lg'
                ]
            ],
        ]
    ]);
    ?>

    <button type="submit" class="btn btn-warning btn-block font-white btn-lg"><?= Yii::t('app.c2', 'Signup') ?></button>


    <div class="tc mt40">
        <a href="/site/login"><h3><?= Yii::t('app.c2', 'Login Account') ?></h3></a>
    </div>

    <?php
    \kartik\widgets\ActiveForm::end();
    ?>
</div>
