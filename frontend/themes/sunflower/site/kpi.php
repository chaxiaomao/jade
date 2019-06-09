<?php
/**
 * Created by PhpStorm.
 * User: jerrygo
 * Date: 19-5-23
 * Time: 下午5:01
 */

use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title = Yii::t('app.c2', 'My Kpi');
$this->params['navbar'] = Yii::t('app.c2', 'Back');
?>
    <div class="container-fluid">

        <?= \yii\helpers\Html::a(Yii::t('app.c2', 'My QRCode'), '#', [
            'class' => 'btn btn-success btn-block qr',
            'data-pjax' => '0',
            'data-value' => Url::toRoute(['qr-code']),
        ]); ?>

        <h4>
            <?= Yii::t('app.c2', 'My Developer') ?>

            <?= \yii\helpers\Html::a(Yii::t('app.c2', 'Chart All'), ['user/kpi-chart'], ['class' => 'btn btn-link']) ?>
        </h4>

        <?php
        echo \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'media-list'],
            'itemView' => '_kpi_item',
            'pager' => ['class' => \kop\y2sp\ScrollPager::className()]
        ]);

        ?>

    </div>


    <script type="application/javascript">

        function copy() {
            var code = document.getElementById("rcd_code");
            code.select();
            document.execCommand('copy');
        }

    </script>
<?php
Modal::begin([
    'id' => 'common-modal',
    'header' => '<h4 class="modal-title"></h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
]);
Modal::end();

$js = <<<JS
$(document).off('click', 'a.qr').on('click','a.qr',function(e, data){
    // e.preventDefault();
    jQuery('#common-modal').modal('show')
    .find('.modal-content')
    .html('<img class="qr-content">')
    .css("text-align", "center");
    $(".qr-content").attr('src', jQuery(e.currentTarget).attr('data-value'));
});
JS;
$this->registerJs($js);
?>

