<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

yii\bootstrap\BootstrapAsset::register($this);

$theme = $this->theme;
Yii::info($theme->getUrl('css/print.css'));
$this->registerCssFile($theme->getUrl('css/print.css'));
?>

<?php
$js = <<<_JS
document.getElementById("btn-print").onclick = function () {
    printElement(document.getElementById("print-content"));
};
function printElement(elem) {
    var domClone = elem.cloneNode(true);

    var printContent = document.getElementById("printSection");

    if (!printContent) {
        var printContent = document.createElement("div");
        printContent.id = "printSection";
        document.body.appendChild(printContent);
    }

    printContent.innerHTML = "";
    printContent.appendChild(domClone);
    window.print();
}
_JS;
$this->registerJs($js);
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

        <div class="modal-header">
            <button type="button" class="fa fa-close close" data-dismiss="modal" aria-hidden="true"></button>
            <button type="button" class="fa fa-window-maximize close"></button>
            <i class="fa fa-th"></i> <?= $this->title ?>
        </div>

        <div id="print-content" class="modal-body">
            <?= $content; ?>
        </div>

        <div class="modal-footer">
            <div class="pull-left">
            </div>

            <div class="pull-right hidden-print">        
                <button class="btn btn-primary" id="btn-print" ><?= Yii::t('app.c2', "Print") ?></button>
                <button class="btn btn-primary" data-dismiss="modal"><?= Yii::t('app.c2', "Close") ?></button>
            </div>    
        </div>


        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

