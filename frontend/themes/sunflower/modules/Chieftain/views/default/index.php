<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/4
 * Time: 10:21
 */

use yii\helpers\Url;

$this->title = Yii::t('app.c2', 'Profile center');
$currentChess = Yii::$app->user->currentUser->getCurrentChess();
?>
<div class="container">
    <div class="list-group">
        <a href="javascript:;" class="list-group-item disabled">
            <?= Yii::t('app.c2', 'Base Profile') ?>
        </a>
        <a href="javascript:;" class="list-group-item ">
            <div class="row">
                <div class="col-xs-8"><?= Yii::t('app.c2', 'Username') ?></div>
                <div class="col-xs-4"><?= Yii::$app->user->username ?></div>
            </div>
        </a>
        <a href="javascript:;" class="list-group-item">
            <div class="row">
                <div class="col-xs-8"><?= Yii::t('app.c2', 'User degree') ?></div>
                <div class="col-xs-4"><?= \common\models\c2\statics\FeUserType::getLabel(Yii::$app->user->currentUser->type) ?></div>
            </div>
        </a>
        <a href="javascript:;" class="list-group-item">
            <div class="row">
                <div class="col-xs-8"><?= Yii::t('app.c2', 'Register At') ?></div>
                <div class="col-xs-4"><?= date('Y-m-d', strtotime(Yii::$app->user->currentUser->created_at)) ?></div>
            </div>
        </a>
        <a href="/user/settings" class="list-group-item">
            <?= Yii::t('app.c2', 'Settings') ?>
        </a>
        <a href="<?= \yii\helpers\Url::toRoute(['kpi-list', 'status' => \cza\base\models\statics\EntityModelStatus::STATUS_INACTIVE]) ?>" class="list-group-item">
            <div class="row">
                <div class="col-xs-8"><?= Yii::t('app.c2', 'Kpi list') ?></div>
            </div>
        </a>
    </div>

    <?php //echo \frontend\widgets\RCodeGenerator::widget([]); ?>

    <div class="list-group mt40">
        <a href="javascript:;" class="list-group-item disabled">
            <?= Yii::t('app.c2', 'Current chess') ?>
        </a>
        <a href="javascript:;" class="list-group-item ">
            <div class="row">
                <div class="col-xs-8"><?= $currentChess->chess->code ?></div>
                <div class="col-xs-4"><?= Yii::t('app.c2', 'Change') ?></div>
            </div>
        </a>
        <a href="<?= Url::toRoute(['/station', 't' => \common\models\c2\statics\FeUserType::TYPE_LORD]) ?>" class="list-group-item">
            <div class="row">
                <div class="col-xs-8"><?= Yii::t('app.c2', 'Lord') ?></div>
            </div>
        </a>
        <a href="<?= Url::toRoute(['/station', 't' => \common\models\c2\statics\FeUserType::TYPE_ELDER]) ?>" class="list-group-item">
            <div class="row">
                <div class="col-xs-8"><?= Yii::t('app.c2', 'Elder') ?></div>
            </div>
        </a>
        <a href="<?= Url::toRoute(['/station', 't' => \common\models\c2\statics\FeUserType::TYPE_CHIEFTAIN]) ?>" class="list-group-item">
            <div class="row">
                <div class="col-xs-8"><?= Yii::t('app.c2', 'Chieftain') ?></div>
            </div>
        </a>
        <a href="<?= Url::toRoute(['/station', 't' => \common\models\c2\statics\FeUserType::TYPE_MASTER]) ?>" class="list-group-item">
            <div class="row">
                <div class="col-xs-8"><?= Yii::t('app.c2', 'Master') ?></div>
            </div>
        </a>
        <a href="<?= Url::toRoute(['/station', 't' => \common\models\c2\statics\FeUserType::TYPE_FAMILIAR]) ?>" class="list-group-item">
            <div class="row">
                <div class="col-xs-8"><?= Yii::t('app.c2', 'Familiar') ?></div>
            </div>
        </a>
        <a href="<?= Url::toRoute(['/station', 't' => \common\models\c2\statics\FeUserType::TYPE_PEASANT]) ?>" class="list-group-item">
            <div class="row">
                <div class="col-xs-8"><?= Yii::t('app.c2', 'Peasant') ?></div>
            </div>
        </a>
    </div>

</div>

