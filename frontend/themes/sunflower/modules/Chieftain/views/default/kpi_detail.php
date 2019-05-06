<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/5
 * Time: 20:29
 */

use cza\base\widgets\ui\adminlte2\InfoBox;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;

$this->title = Yii::t('app.c2', 'Kpi commit');
$this->params['navbar'] = Yii::t('app.c2', 'Back');
$url = $kpiModel->isAdminCommit() ? 'kpi-finish' : 'kpi-cancel';
?>

<div class="container mb10">

    <?php if ($kpiModel->isAdminCommit()): ?>
        <?php

        echo InfoBox::widget([
            'withWrapper' => false,
            'defaultMessageType' => InfoBox::TYPE_INFO,
            'messages' => [Yii::t('app.c2', 'Admin commit finish, pls commit profit.')],
        ]);
        ?>
    <?php endif; ?>

    <?php $form = ActiveForm::begin(['id' => 'form-commit-kpi', 'action' => \yii\helpers\Url::toRoute([$url, 'id' => $kpiModel->id])]); ?>

    <div class="form-group has-success has-feedback">
        <label class="control-label"
               for="inputGroupSuccess1"><?= Yii::t('app.c2', '*Chess commit') ?></label>
        <div class="input-group">
            <span class="input-group-addon"><?= Yii::t('app.c2', 'Code') ?></span>
            <input type="text" class="form-control" id="inputGroupSuccess1"
                   aria-describedby="inputGroupSuccess1Status"
                   placeholder="<?= $kpiModel->chess->code ?>" readonly>
        </div>
        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
        <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
    </div>

    <div class="form-group has-success has-feedback">
        <label class="control-label"
               for="inputGroupSuccess1"><?= Yii::t('app.c2', '*User commit') ?></label>
        <div class="input-group">
            <span class="input-group-addon"><?= Yii::t('app.c2', 'Username') ?></span>
            <input type="text" class="form-control" id="inputGroupSuccess1"
                   aria-describedby="inputGroupSuccess1Status"
                   placeholder="<?= $kpiModel->user->username ?>" readonly>
        </div>
        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
        <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
    </div>

    <div class="form-group has-success has-feedback">
        <label class="control-label"
               for="inputGroupSuccess1"><?= Yii::t('app.c2', '*User commit') ?></label>
        <div class="input-group">
            <span class="input-group-addon"><?= Yii::t('app.c2', 'Mobile number') ?></span>
            <input type="text" class="form-control" id="inputGroupSuccess1"
                   aria-describedby="inputGroupSuccess1Status"
                   placeholder="<?= $kpiModel->user->mobile_number ?>" readonly>
        </div>
        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
        <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
    </div>

    <div class="form-group has-success has-feedback">
        <label class="control-label"
               for="inputGroupSuccess1"><?= Yii::t('app.c2', '*Recommend user commit') ?></label>
        <div class="input-group">
            <span class="input-group-addon"><?= Yii::t('app.c2', 'Username') ?></span>
            <input type="text" class="form-control" id="inputGroupSuccess1"
                   aria-describedby="inputGroupSuccess1Status"
                   placeholder="<?= $kpiModel->recommendUser->username ?>" readonly>
        </div>
        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
        <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
    </div>

    <div class="form-group has-success has-feedback">
        <label class="control-label"
               for="inputGroupSuccess2"><?= Yii::t('app.c2', '*According to CRJR result') ?></label>
        <div class="input-group">
            <span class="input-group-addon"><?= Yii::t('app.c2', 'Owner parent username') ?></span>
            <input type="text" class="form-control" id="inputGroupSuccess2"
                   aria-describedby="inputGroupSuccess1Status"
                   placeholder="<?= $kpiModel->familiar->username ?>" readonly>
        </div>
        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
        <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
    </div>

    <div class="form-group has-success has-feedback">
        <label class="control-label"
               for="inputGroupSuccess1"><?= Yii::t('app.c2', '*Chieftain user commit') ?></label>
        <div class="input-group">
            <span class="input-group-addon"><?= Yii::t('app.c2', 'Username') ?></span>
            <input type="text" class="form-control" id="inputGroupSuccess1"
                   aria-describedby="inputGroupSuccess1Status"
                   placeholder="<?= Yii::$app->user->currentUser->username ?>" readonly>
        </div>
        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
        <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
    </div>

    <div class="form-group has-success has-feedback">
        <label class="control-label" for="inputGroupSuccess2"><?= Yii::t('app.c2', '*Pay dues commit') ?></label>
        <div class="input-group">
            <span class="input-group-addon"><?= Yii::t('app.c2', 'Pay due') ?></span>
            <input type="text" class="form-control" id="inputGroupSuccess1"
                   aria-describedby="inputGroupSuccess1Status"
                   placeholder="<?= $kpiModel->dues ?>" readonly>
            <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
            <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
        </div>
    </div>

    <?php foreach ($profitItemModels as $profitItemModel): ?>

        <?php if ($profitItemModel->type == \common\models\c2\statics\UserProfitType::TYPE_AWARD): ?>
            <div class="form-group has-success has-feedback">
                <label class="control-label"
                       for="inputGroupSuccess2"><?= Yii::t('app.c2', 'Obtain award') ?></label>
                <div class="input-group">
                    <span class="input-group-addon"><?= $profitItemModel->user->username ?></span>
                    <input type="text" class="form-control" id="inputGroupSuccess1"
                           aria-describedby="inputGroupSuccess1Status"
                           placeholder="<?= $profitItemModel->income ?>" readonly>
                    <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                    <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
                </div>
            </div>
        <?php else: ?>
            <div class="form-group has-success has-feedback">
                <label class="control-label"
                       for="inputGroupSuccess2"><?= Yii::t('app.c2', 'Obtain profit') ?></label>
                <div class="input-group">
                    <span class="input-group-addon"><?= $profitItemModel->user->username ?></span>
                    <input type="text" class="form-control" id="inputGroupSuccess1"
                           aria-describedby="inputGroupSuccess1Status"
                           placeholder="<?= $profitItemModel->income ?>" readonly>
                    <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                    <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
                </div>
            </div>
        <?php endif; ?>

    <?php endforeach; ?>

    <?php if ($kpiModel->isAdminCommit()): ?>
        <?= Html::submitButton(Yii::t('app.c2', 'Commit profit finish'), [
            'class' => 'btn btn-success btn-block',
            // 'data-toggle' => 'modal',
            // 'data-target' => '#tipsModal',
        ]) ?>
    <?php elseif ($kpiModel->isChieftainCommit()): ?>
        <?= Html::submitButton(Yii::t('app.c2', 'Cancel Chieftain commit'), [
            'class' => 'btn btn-warning btn-block',
            // 'data-toggle' => 'modal',
            // 'data-target' => '#tipsModal',
        ]) ?>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>
</div>
