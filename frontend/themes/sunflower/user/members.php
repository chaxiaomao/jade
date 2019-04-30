<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/9
 * Time: 10:16
 */

use yii\widgets\LinkPager;
$this->title = Yii::t('app.c2', 'My members');
$this->params['navbar'] = Yii::t('app.c2', 'Back');
?>
<div class="container-fluid">
    <?php if (count($model) > 0): ?>
        <?php foreach ($model as $item): ?>
            <li class="list-group-item">
                <div class="media">
                    <img src="/images/avatar.png" class="mr-3 avatar60" alt="">
                    <div class="media-body">
                        <h6 class="mt-0"><?= $item->user->username ?><span
                                    class="badge badge-info mf10"><?= \common\models\c2\statics\FeUserType::getLabel($item->user->type) ?></span>
                        </h6>
                        <p><?= Yii::t('app.c2', 'Register At') . "：" . date('Y-m-d', strtotime($item->user->created_at)) ?></p>
                    </div>
                </div>
            </li>

        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-warning" role="alert"><?= Yii::t('app.c2', 'Data empty') ?></div>
    <?php endif; ?>
</div>




