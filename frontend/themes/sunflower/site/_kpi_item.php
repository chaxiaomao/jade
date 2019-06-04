<?php
/**
 * Created by PhpStorm.
 * User: jerrygo
 * Date: 19-6-3
 * Time: 下午6:17
 */

?>


<div class="media bottom-board pb10 pt10">
    <div class="media-left">
        <a href="#">
            <img class="media-object avatar60" src="/images/avatar.png" alt="...">
        </a>
    </div>
    <div class="media-body">
        <h4 class="media-heading"><?= $model->joinUser->username ?>
            <?php if ($model->state == \common\models\c2\statics\UserKpiStateType::TYPE_NOT_COMMIT): ?>
                <span class="label label-default"><?= \common\models\c2\statics\UserKpiStateType::getLabel($model->state) ?></span>

            <?php elseif ($model->state == \common\models\c2\statics\UserKpiStateType::TYPE_FINISH_COMMIT): ?>
                <span class="label label-success"><?= \common\models\c2\statics\UserKpiStateType::getLabel($model->state) ?></span>
            <?php endif; ?>
        </h4>
        <?= $model->joinUser->mobile_number ?>
    </div>
</div>
