<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/7
 * Time: 13:46
 */

use yii\helpers\Url;

?>


<div class="container-fluid">
    <div class="alert alert-success" role="alert">
        <p><?= Yii::t('app.c2', 'You have these station to login in') ?></p>
        <p><?= Yii::t('app.c2', 'Chess code') . ":" . $stations[0]->chess->code ?></p>
    </div>
    <?php foreach ($stations as $station): ?>

        <a href="<?= Url::toRoute(\common\models\c2\statics\FeUserType::getData($station->type, 'url')) ?>"
           class="btn btn-success">
            <?= \common\models\c2\statics\FeUserType::getData($station->type, 'label') ?>
        </a>
    <?php endforeach; ?>
</div>
