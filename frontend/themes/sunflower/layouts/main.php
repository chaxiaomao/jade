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
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <?= isset($this->params['navbar']) ? '<button onclick="javascript:history.go(-1)" class="btn btn-light">' . $this->params['navbar'] . '</button>' : '<a class="navbar-brand">' . Yii::t('app.c2', 'Application') . '</a>' ?>

    <?php
    if (Yii::$app->user->isGuest) {

    } else {
        // echo Html::beginForm('/site/logout', 'post', ['class' => 'form-inline']);
        // echo Html::submitButton(
        //     'Logout (' . Yii::$app->user->identity->username . ')',
        //     ['class' => 'btn btn-outline-success my-2 my-sm-0']
        // );
        // echo Html::endForm();
        echo '<div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Right-aligned menu
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                    <button class="dropdown-item" type="button">Action</button>
                    <button class="dropdown-item" type="button">Another action</button>
                    <button class="dropdown-item" type="button">Something else here</button>
                  </div>
                </div>';
    }
    ?>
</nav>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
