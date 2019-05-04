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
<style>
    .media {
        border-bottom: 1px solid #eeeeee;
    }
</style>
<div class="container-fluid">
    <?php if (count($model) > 0): ?>
        <?php foreach ($model as $item): ?>
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img src="/images/avatar.png" class="mr-3 avatar60" alt="">
                    </a>
                </div>
                <div class="media-body">
                    <h6 class="mt-0"><?= $item->user->username ?><span
                                class="badge badge-info mf10"><?= \cza\base\models\statics\EntityModelStatus::getLabel($item->status) ?></span>
                    </h6>
                    <p><?= Yii::t('app.c2', 'Register at') . "：" . $item->user->created_at ?></p>
                </div>
            </div>



        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-warning" role="alert"><?= Yii::t('app.c2', 'Data empty') ?></div>
    <?php endif; ?>
</div>




