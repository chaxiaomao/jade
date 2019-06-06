<?php
/**
 * Created by PhpStorm.
 * User: jerrygo
 * Date: 19-5-23
 * Time: 下午5:01
 */
$this->title = Yii::t('app.c2', 'My Kpi');
$this->params['navbar'] = Yii::t('app.c2', 'Back');
?>
<div class="container-fluid">

    <?= \yii\helpers\Html::a(Yii::t('app.c2', 'My QRCode'), ['qr-code'], [
            'class' => 'btn btn-success btn-block']); ?>

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
