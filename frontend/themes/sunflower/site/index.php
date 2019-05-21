<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/3
 * Time: 16:31
 */

use kartik\helpers\Html;

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

    <div class="alert alert-warning" role="alert"><?= Yii::t('app.c2', 'Chess not in') ?></div>

    <div style="margin-top: 60px">
        <?php

        echo Html::beginForm('/user/logout', 'post', ['class' => 'form-inline']);
        echo Html::submitButton(
            'Other account (' . Yii::$app->user->identity->username . ')',
            // ['class' => 'btn btn-outline-success my-2 my-sm-0']
            ['class' => 'btn btn-danger btn-lg btn-block']
        );
        echo Html::endForm();

        ?>
    </div>
</div>
