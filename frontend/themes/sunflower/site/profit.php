<?php
/**
 * Created by PhpStorm.
 * User: jerrygo
 * Date: 19-5-23
 * Time: 下午5:01
 */
$this->title = Yii::t('app.c2', 'My Profit');
$this->params['navbar'] = Yii::t('app.c2', 'Back');
?>
<div class="container-fluid">

    <div class="jumbotron">
        <h1><?= Yii::t('app.c2', 'Total Income') ?></h1>
        <p style="color: orange;">￥<?= $model != null ? $model->income : 0 ?></p>
    </div>

    <?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'media-list'],
        'itemView' => '_profit_item',
        'pager' => ['class' => \kop\y2sp\ScrollPager::className()]
    ]);

    ?>

</div>

