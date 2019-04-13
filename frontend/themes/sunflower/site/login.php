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
        ]
    ]);
    ?>

    <div class="mdui-col">
        <button type="submit" class="btn btn-warning btn-block font-white"><?= Yii::t('app.c2', 'Signup') ?></button>
    </div>

    <div class="tc mt40">
        <a href="/site/signup"><?= Yii::t('app.c2', 'Signup Account') ?></a>
    </div>
    <?php
    \kartik\widgets\ActiveForm::end();
    ?>
</div>
