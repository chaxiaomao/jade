<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/9
 * Time: 14:46
 */

?>

<li class="list-group-item">
    <div class="media">
        <img src="/images/avatar.png" class="mr-3 avatar60" alt="">
        <div class="media-body">
            <h6 class="mt-0"><?= $model->username ?><span
                        class="badge badge-info mf10"><?= \common\models\c2\statics\FeUserType::getLabel($model->type) ?></span>
            </h6>
            <p><?= Yii::t('app.c2', 'Register At') . "：" . date('Y-m-d', strtotime($model->created_at)) ?></p>
        </div>
    </div>
</li>

