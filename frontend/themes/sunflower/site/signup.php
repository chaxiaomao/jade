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

$css = '.mdui-btn, .mdui-fab {padding:0;}';
$this->registerCss($css);
?>

<div class="bg">
    <p class="welcome"><?= Yii::t('app.c2', 'Welcome to Signup') ?></p>
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
            'fieldConfig' => [
                'template' => '<i class="mdui-icon material-icons">&#xe853;</i>{input}',
                'options' => ['class' => 'mdui-textfield']
            ],
            'options' => [
                'placeholder' => $model->getAttributeLabel('username'),
                'class' => 'mdui-textfield-input'
            ]
        ],
        'mobile_number' => [
            'type' => Form::INPUT_TEXT,
            'label' => false,
            'fieldConfig' => [
                'template' => '<i class="mdui-icon material-icons">&#xe324;</i>{input}',
                'options' => ['class' => 'mdui-textfield']
            ],
            'options' => [
                'placeholder' => $model->getAttributeLabel('mobile_number'),
                'class' => 'mdui-textfield-input'
            ]
        ],
        'password' => [
            'type' => Form::INPUT_PASSWORD,
            'label' => false,
            'fieldConfig' => [
                'template' => '<i class="mdui-icon material-icons">&#xe899;</i>{input}',
                'options' => ['class' => 'mdui-textfield'],
            ],
            'options' => [
                'placeholder' => $model->getAttributeLabel('password'),
                'class' => 'mdui-textfield-input',
            ]
        ],

        'verifyCode' => [
            'type' => Form::INPUT_WIDGET,
            'widgetClass' => Captcha::className(),
            'fieldConfig' => [
                'options' => ['class' => 'mdui-textfield'],
            ],
            'options' => [
                'form' => $form,
                'mobileId' => Html::getInputId($model, 'mobile_number'),
            ],
            'label' => false,
        ],
        'recommendCode' => [
            'type' => Form::INPUT_PASSWORD,
            'label' => false,
            'fieldConfig' => [
                'template' => '<i class="mdui-icon material-icons">&#xe250;</i>{input}',
                'options' => ['class' => 'mdui-textfield'],
            ],
            'options' => [
                'placeholder' => $model->getAttributeLabel('recommendCode'),
                'class' => 'mdui-textfield-input',
            ]
        ],
    ]
]);
?>

<div class="mdui-col">
    <button type="submit" class="btn btn-warning btn-block font-white"><?= Yii::t('app.c2', 'Signup') ?></button>
</div>



<div class="tc mt40">
    <a href="/site/login"><?= Yii::t('app.c2', 'Login Account') ?></a>
</div>

<?php
\kartik\widgets\ActiveForm::end();
?>
