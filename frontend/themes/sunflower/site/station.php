<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/4
 * Time: 22:44
 */
$this->title = Yii::t('app.c2', 'Lord');
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
                            class="badge badge-info mf10"><?= $item->user->mobile_number ?></span>
                    </h6>
                    <p><?= Yii::t('app.c2', 'Created at') . "：" . $item->user->created_at ?></p>
                </div>
            </div>



        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-warning" role="alert"><?= Yii::t('app.c2', 'Data empty') ?></div>
    <?php endif; ?>
</div>
