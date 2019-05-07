<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use common\components\SmsCaptcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\builder\Form;

$messageName = $model->getMessageName();
$this->title = Yii::t('app.c2', 'User login');
?>

<div class="bg">
    <p class="welcome"><?= Yii::t('app.c2', 'Welcome to signup') ?></p>
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
            'mobile_number' => [
                'type' => Form::INPUT_TEXT,
                'label' => false,
                'fieldConfig' => [
                    // 'template' => '<label for="signupform-mobile_number" class="col-xs-2 control-label">' . $model->getAttributeLabel('mobile_number') . '</label>
                    //                 <div class="col-xs-10">{input}</div>',
                    // 'options' => ['class' => 'form-group row']
                ],
                'options' => [
                    'placeholder' => $model->getAttributeLabel('mobile_number'),
                    // 'class' => 'form-control-lg'
                ]
            ],
            'password' => [
                'type' => Form::INPUT_PASSWORD,
                'label' => false,
                'fieldConfig' => [
                    // 'template' => '<label for="signupform-password" class="col-xs-2 control-label">' . $model->getAttributeLabel('password') . '</label>
                    //                 <div class="col-xs-10">{input}</div>',
                    // 'options' => ['class' => 'form-group row']
                ],
                'options' => [
                    'placeholder' => $model->getAttributeLabel('password'),
                    // 'class' => 'form-control-lg'
                ]
            ],
        ]
    ]);
    ?>

    <?php echo Html::submitButton(Yii::t('app.c2', 'Login'), ['class' => 'btn btn-warning btn-block font-white']) ?>
    <div class="tc mt40">
        <?php echo Html::a(Yii::t('app.c2', 'Signup Account'), '/user/signup') ?>
    </div>
    <?php
    \kartik\widgets\ActiveForm::end();
    ?>
</div>
