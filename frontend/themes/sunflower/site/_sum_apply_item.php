<?php
/**
 * Created by PhpStorm.
 * User: jerrygo
 * Date: 19-6-3
 * Time: 下午6:17
 */
$this->title = Yii::t('app.c2', 'Sum Apply Record');
$this->params['navbar'] = Yii::t('app.c2', 'Back');
?>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-body">
            <p><?= Yii::t('app.c2', 'Name') . "：" . $model->name ?></p>
            <p><?= Yii::t('app.c2', 'Bank Name') . "：" . $model->bank_name ?></p>
            <p><?= Yii::t('app.c2', 'Bank Card Number') . "：" . $model->bank_card_number ?></p>
            <p><?= Yii::t('app.c2', 'Apply At') . "：" . $model->created_at ?></p>
            <p><?= Yii::t('app.c2', 'Apply Sum') . "：" . $model->apply_sum ?></p>
            <p><?= Yii::t('app.c2', 'Transfer Rate') . "：" . $model->transfer_rate ?></p>
            <p><?= Yii::t('app.c2', 'Receive Sum') . "：" . $model->received_sum ?></p>
            <p><?= Yii::t('app.c2', 'State') . "：" . \common\models\c2\statics\UserProfitState::getLabel($model->state) ?></p>
            <p><?= Yii::t('app.c2', 'Memo') . "：" . $model->memo ?></p>
        </div>
    </div>
</div>
