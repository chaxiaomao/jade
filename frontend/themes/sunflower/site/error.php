<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = Yii::t('app.c2', 'Tips');
?>
<div class="container-fluid">

    <div class="alert alert-warning">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <!--    <p>-->
    <!--        The above error occurred while the Web server was processing your request.-->
    <!--    </p>-->
    <!--    <p>-->
    <!--        Please contact us if you think this is a server error. Thank you.-->
    <!--    </p>-->
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
