<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/9
 * Time: 10:16
 */

use yii\widgets\LinkPager;

$this->title = Yii::t('app.c2', 'Kpi list');
$this->params['navbar'] = Yii::t('app.c2', 'Back');
?>

<div class="container">
    <div class="btn-group btn-group-justified" role="group" aria-label="...">

        <div class="btn-group" role="group">
            <a href="<?= \yii\helpers\Url::toRoute(['kpi-list', 'state' => \common\models\c2\statics\UserKpiStateType::TYPE_NOT_COMMIT]) ?>"
               class="btn btn-default <?= $state == \common\models\c2\statics\UserKpiStateType::TYPE_NOT_COMMIT ? 'active' : '' ?>"><?= Yii::t('app.c2', 'Not commit') ?></a>
        </div>
        <div class="btn-group" role="group">
            <a href="<?= \yii\helpers\Url::toRoute(['kpi-list', 'state' => \common\models\c2\statics\UserKpiStateType::TYPE_CHIEFTAIN_COMMIT]) ?>"
               class="btn btn-default <?= $state == \common\models\c2\statics\UserKpiStateType::TYPE_CHIEFTAIN_COMMIT ? 'active' : '' ?>"><?= Yii::t('app.c2', 'Chieftain commit') ?></a>
        </div>
        <div class="btn-group" role="group">
            <a href="<?= \yii\helpers\Url::toRoute(['kpi-list', 'state' => \common\models\c2\statics\UserKpiStateType::TYPE_ADMIN_COMMIT]) ?>"
               class="btn btn-default <?= $state == \common\models\c2\statics\UserKpiStateType::TYPE_ADMIN_COMMIT ? 'active' : '' ?>"><?= Yii::t('app.c2', 'Admin commit') ?></a>
        </div>
        <div class="btn-group" role="group">
            <a href="<?= \yii\helpers\Url::toRoute(['kpi-list', 'state' => \common\models\c2\statics\UserKpiStateType::TYPE_FINISH_COMMIT]) ?>"
               class="btn btn-default <?= $state == \common\models\c2\statics\UserKpiStateType::TYPE_FINISH_COMMIT ? 'active' : '' ?>"><?= Yii::t('app.c2', 'Finish commit') ?></a>
        </div>
    </div>
</div>

<style>
    .media {
        border-bottom: 1px solid #eeeeee;
    }
</style>
<div class="container-fluid mt40">
    <?php if (count($model) > 0): ?>
        <?php foreach ($model as $item): ?>
            <div class="media">

                <div class="row">
                    <div class="col-xs-8">
                        <div class="media-left">
                            <a href="#">
                                <img src="/images/avatar.png" class="mr-3 avatar60" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <h6 class="mt-0"><?= $item->user->username ?><span
                                        class="badge badge-info mf10"><?= \common\models\c2\statics\UserKpiStateType::getLabel($item->status) ?></span>
                            </h6>
                            <p><?= Yii::t('app.c2', 'Register at') . "：" . $item->user->created_at ?></p>
                            <p><?= Yii::t('app.c2', 'Recommend user') . "：" . $item->recommendUser->username ?></p>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <?php if ($item->state == \common\models\c2\statics\UserKpiStateType::TYPE_NOT_COMMIT): ?>
                            <a href="<?= \yii\helpers\Url::toRoute(['kpi-edit', 'id' => $item->id]) ?>" class="btn btn-danger"><?= Yii::t('app.c2', 'Commit') ?></a>
                        <?php else: ?>
                            <a href="#" class="btn btn-success"><?= Yii::t('app.c2', 'Detail') ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>


        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-warning" role="alert"><?= Yii::t('app.c2', 'Data empty') ?></div>
    <?php endif; ?>
</div>