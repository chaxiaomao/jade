<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/24
 * Time: 21:17
 */

use yii\helpers\Html;
use frontend\themes\sunflower\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="initial-scale=1, maximum-scale=3, minimum-scale=1, user-scalable=no">
    <!--UC浏览器禁止横屏-->
    <meta name="screen-orientation" content="portrait">
    <!--QQ浏览器禁止横屏-->
    <meta name="x5-orientation" content="portrait">
    <meta http-equiv="pragma" content="no-cache"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="main">
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <span class="navbar-text">

            <?php
            if (Yii::$app->user->isGuest) {
            } else {
                echo Html::beginForm(['/site/logout', 'post']);

                echo Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                );
                echo Html::endForm();
            }
            ?>
        </span>
    </nav>
    <?= $content ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
