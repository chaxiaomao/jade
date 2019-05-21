<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/7
 * Time: 10:37
 */

use yii\helpers\Url;
?>

<div class="list-group mt40">
    <a href="javascript:;" class="list-group-item disabled">
        <?= Yii::t('app.c2', 'Current chess') ?>
    </a>
    <a href="/chess-list" class="list-group-item ">
        <div class="row">
            <div class="col-xs-8"><?= $currentChess->code ?></div>
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

