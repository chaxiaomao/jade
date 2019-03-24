<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

yii\bootstrap\BootstrapAsset::register($this);

$theme = $this->theme;
$this->registerCssFile($theme->getUrl('css/print.css'));
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="screen-orientation" content="portrait">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="bg-f5">
        <?php $this->beginBody() ?>
        <?= $content ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
