<?php
/**
 * Created by PhpStorm.
 * User: jerrygo
 * Date: 19-6-3
 * Time: 下午6:17
 */

?>


<div class="panel panel-default">
    <div class="panel-body">
        <p><?= Yii::t('app.c2', 'Join User') . "：" . $model->kpi->joinUser->username ?></p>
        <p><?= Yii::t('app.c2', 'Invite User') . "：" . $model->kpi->inviteUser->username ?></p>
        <p><?= Yii::t('app.c2', 'GRP') . "：" . $model->gRP->label ?></p>
        <p><?= Yii::t('app.c2', 'Income') . "：" . $model->income ?></p>
        <p><?= Yii::t('app.c2', 'State') . "：" . \common\models\c2\statics\UserProfitState::getLabel($model->state) ?></p>
        <p><?= Yii::t('app.c2', 'Assignment At') . "：" . $model->created_at ?></p>
    </div>
</div>