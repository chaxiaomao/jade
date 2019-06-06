<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/3
 * Time: 16:31
 */

use kartik\helpers\Html;

$this->title = Yii::t('app.c2', 'GRP List');
?>

<!--<form>-->
<!--    <div class="form-group">-->
<!--        <label for="exampleInputEmail1">Email address</label>-->
<!--        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">-->
<!--        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label for="exampleInputPassword1">Password</label>-->
<!--        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">-->
<!--    </div>-->
<!--    <div class="form-check">-->
<!--        <input type="checkbox" class="form-check-input" id="exampleCheck1">-->
<!--        <label class="form-check-label" for="exampleCheck1">Check me out</label>-->
<!--    </div>-->
<!--    <button type="button" class="btn btn-success btn-lg btn-block">Block level button</button>-->
<!--</form>-->
<div class="container-fluid">

    <?php if ($dataProvider->count == 0): ?>
        <div class="alert alert-warning" role="alert"><?= Yii::t('app.c2', 'Pls wait for check.') ?></div>
    <?php endif; ?>

    <ul class="nav nav-pills tc">
        <?php
        echo \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            // 'itemOptions' => ['style' => 'float:left;text-align:center;'],
            'summary' => '',
            'emptyText' => '',
            'itemView' => '_station_item',
            'pager' => ['class' => \kop\y2sp\ScrollPager::className()]
        ]);

        ?>

    </ul>

    <?= Html::beginForm(['/user/logout'], 'post') ?>
    <?= Html::submitButton(Yii::t('app.c2', 'Logout') . Yii::$app->user->currentUser->username, ['class' => 'btn btn-danger btn-block']) ?>
    <?= Html::endForm() ?>
</div>
