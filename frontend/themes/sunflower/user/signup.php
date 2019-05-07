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

    <div id="tip_body" style="display: none;" class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <p id="tip_content"></p>
    </div>

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
                    'mobileId' => Html::getInputId($model, 'mobile_number'),
                ],
            ],

        ]
    ]);


    ?>

    <div class="container tr">
        <?php echo Html::submitButton(Yii::t('app.c2', 'Signup'), ['class' => 'btn btn-warning btn-block font-white mb10']) ?>
        <?php echo Html::a(Yii::t('app.c2', 'Login account right now'), '/user/login', ['class' => '']) ?>
    </div>


    <?php
    \kartik\widgets\ActiveForm::end();
    ?>
</div>
