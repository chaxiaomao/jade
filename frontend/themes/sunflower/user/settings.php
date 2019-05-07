<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/15
 * Time: 16:02
 */

use yii\helpers\Html;
$this->title = Yii::t('app.c2', 'Setting');
$this->params['navbar'] = Yii::t('app.c2', 'Back');
?>

<div class="container">

    <div style="margin-top: 60px">
        <?php

        echo Html::beginForm('/user/logout', 'post', ['class' => 'form-inline']);
        echo Html::submitButton(
            Yii::t('app.c2', 'Other account{s1}', ['s1' => Yii::$app->user->identity->mobile_number]),
            // ['class' => 'btn btn-outline-success my-2 my-sm-0']
            ['class' => 'btn btn-danger btn-lg btn-block']
        );
        echo Html::endForm();

        ?>
    </div>

</div>


