<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/7
 * Time: 12:23
 */

?>

<div class="list-group">
    <a href="javascript:;" class="list-group-item disabled">
        <?= Yii::t('app.c2', 'Base Profile') ?>
    </a>
    <a href="javascript:;" class="list-group-item ">
        <div class="row">
            <div class="col-xs-8"><?= Yii::t('app.c2', 'Username') ?></div>
            <div class="col-xs-4"><?= $user->username ?></div>
        </div>
    </a>
    <a href="javascript:;" class="list-group-item ">
        <div class="row">
            <div class="col-xs-8"><?= Yii::t('app.c2', 'Mobile number') ?></div>
            <div class="col-xs-4"><?= $user->mobile_number ?></div>
        </div>
    </a>
    <a href="javascript:;" class="list-group-item">
        <div class="row">
            <div class="col-xs-8"><?= Yii::t('app.c2', 'User degree') ?></div>
            <div class="col-xs-4">
                <?php foreach ($stations as $station): ?>
                    <span class="label label-success"><?= \common\models\c2\statics\FeUserType::getLabel($station->type) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </a>
    <a href="javascript:;" class="list-group-item">
        <div class="row">
            <div class="col-xs-8"><?= Yii::t('app.c2', 'Register At') ?></div>
            <div class="col-xs-4"><?= date('Y-m-d', strtotime($user->created_at)) ?></div>
        </div>
    </a>
    <a href="/user/settings" class="list-group-item">
        <?= Yii::t('app.c2', 'Settings') ?>
    </a>
    <?php if ($isChieftain): ?>
        <a href="<?= \yii\helpers\Url::toRoute('kpi-not-commit') ?>" class="list-group-item">
            <div class="row">
                <div class="col-xs-8"><?= Yii::t('app.c2', 'Kpi list') ?></div>
            </div>
        </a>
    <?php endif; ?>
    <a href="/user/profit" class="list-group-item">
        <div class="row">
            <div class="col-xs-8"><?= Yii::t('app.c2', 'My profit') ?></div>
        </div>
    </a>
</div>
