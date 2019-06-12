<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c2\search\UserSumApplyModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-sum-apply-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'apply_sum') ?>

    <?= $form->field($model, 'bank_name') ?>

    <?php // echo $form->field($model, 'hash') ?>

    <?php // echo $form->field($model, 'confirmed_at') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'mobile_number') ?>

    <?php // echo $form->field($model, 'brank_card_number') ?>

    <?php // echo $form->field($model, 'transfer_rate') ?>

    <?php // echo $form->field($model, 'received_sum') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app.c2', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app.c2', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
