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
            'username' => [
                'type' => Form::INPUT_TEXT,
                'label' => false,
                'options' => [
                    'placeholder' => $model->getAttributeLabel('username'),
                ]
            ],
            'mobile_number' => [
                'type' => Form::INPUT_TEXT,
                'label' => false,
                'options' => [
                    'placeholder' => $model->getAttributeLabel('mobile_number'),
                ]
            ],
            'password' => [
                'type' => Form::INPUT_PASSWORD,
                'label' => false,
                'options' => [
                    'placeholder' => $model->getAttributeLabel('password'),
                ]
            ],
            'recommendCode' => [
                'type' => Form::INPUT_TEXT,
                'label' => false,
                'options' => [
                    'placeholder' => $model->getAttributeLabel('recommendCode'),
                ]
            ],
            'verifyCode' => [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => Captcha::className(),
                'label' => false,
                'options' => [
                    'form' => $form,
                    'mobileId' => Html::getInputId($model, 'verifyCode'),
                ],
            ],

        ]
    ]);



    ?>

    <div class="container tr">
        <?php echo Html::submitButton(Yii::t('app.c2', 'Signup'), ['class' => 'btn btn-warning btn-block font-white mb10']) ?>
        <?php echo Html::a(Yii::t('app.c2', 'Login account right now'), '/site/login', ['class' => '']) ?>
    </div>


    <?php
    \kartik\widgets\ActiveForm::end();
    ?>
</div>
