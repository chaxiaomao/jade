<?php

use yii\helpers\Url;

?>
<div class="footer">
    <div class="nav">
        <a href="<?= Url::toRoute(['/activity', 'id' => $this->context->activity->id]) ?>" class="nav_itme">
            <div class="nav_itme_btn">
                <div>
                    <img src="<?= $this->context->navIndex == 0 ? '/imgs/yyl/home_active.png' : '/imgs/yyl/home.png' ?>"/>
                </div>
                <span class="nav_item_txt">
                    <?= Yii::t('app.c2', 'Rank') ?>
                </span>
            </div>
        </a>

        <a href="<?= Url::toRoute(['/luck-draw', 'id' => $this->context->activity->id]) ?>" class="nav_itme">
            <div class="nav_itme_btn">
                <div>
                    <img src="<?= $this->context->navIndex == 1 ? '/imgs/yyl/gift_active.png' : '/imgs/yyl/gift.png' ?>"/>
                </div>
                <span class="nav_item_txt">
                    <?= Yii::t('app.c2', 'Drawing') ?>
                </span>
            </div>
        </a>

        <a href="<?= Url::toRoute(['/entrance', 'id' => $this->context->activity->id]) ?>" class="nav_itme">
            <div class="nav_itme_btn">
                <div>
                    <img src="<?= $this->context->navIndex == 2 ? '/imgs/yyl/entrance_active.png' : '/imgs/yyl/entrance.png' ?>"/>
                </div>
                <span class="nav_item_txt">
                    <?= Yii::t('app.c2', 'Go Entrance') ?>
                </span>
            </div>
        </a>

        <a href="<?= Url::toRoute(['/center', 'id' => $this->context->activity->id]) ?>" class="nav_itme">
            <div class="nav_itme_btn">
                <div>
                    <img src="<?= $this->context->navIndex == 3 ? '/imgs/yyl/center_active.png' : '/imgs/yyl/center.png' ?>"/>
                </div>
                <span class="nav_item_txt">
                    <?= Yii::t('app.c2', 'Center') ?>
                </span>
            </div>
        </a>

    </div>
</div>