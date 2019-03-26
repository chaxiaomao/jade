<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c2\search\ChessSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chess-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'lv6_id') ?>

    <?= $form->field($model, 'lv5_id') ?>

    <?= $form->field($model, 'lv4_id') ?>

    <?php // echo $form->field($model, 'attributeset_id') ?>

    <?php // echo $form->field($model, 'province_id') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'district_id') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'label') ?>

    <?php // echo $form->field($model, 'biz_registration_number') ?>

    <?php // echo $form->field($model, 'product_style') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'open_id') ?>

    <?php // echo $form->field($model, 'wechat_open_id') ?>

    <?php // echo $form->field($model, 'geo_longitude') ?>

    <?php // echo $form->field($model, 'geo_latitude') ?>

    <?php // echo $form->field($model, 'geo_marker_color') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app.c2', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app.c2', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
