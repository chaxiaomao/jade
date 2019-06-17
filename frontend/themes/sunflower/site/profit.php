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
        <p style="color: orange;">￥<?= $model != null ? $model->income : 0.00 ?></p>
        <div>
            <a href="/user/sum-apply" class="btn btn-warning"><?= Yii::t('app.c2', 'Sum Apply') ?></a>
            <a href="/user/sum-apply-record"><?= Yii::t('app.c2', 'Sum Apply Record') ?></a>
        </div>

    </div>

    <?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'media-list'],
        'itemView' => '_profit_item',
        // 'pager' => ['class' => \kop\y2sp\ScrollPager::className()]
        'pager' => [
            //'options' => ['class' => 'hidden'],//关闭分页（默认开启）
            'maxButtonCount' => 6,//最多显示几个分页按钮
            // 'firstPageLabel' => '首页',
            'prevPageLabel' => Yii::t('app.c2', 'Last Page'),
            'nextPageLabel' => Yii::t('app.c2', 'Next Page'),
            // 'lastPageLabel' => '尾页'
        ]
    ]);

    ?>

</div>

