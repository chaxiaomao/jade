<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use common\components\SmsCaptcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\builder\Form;

$messageName = $model->getMessageName();
$this->title = Yii::t('app.c2', 'User Login');
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

    <button type="submit" class="btn btn-warning btn-block font-white"><?= Yii::t('app.c2', 'Login') ?></button>

    <div class="tc mt40">
        <a href="/site/signup"><?= Yii::t('app.c2', 'Signup Account') ?></a>
    </div>
    <?php
    \kartik\widgets\ActiveForm::end();
    ?>
</div>
