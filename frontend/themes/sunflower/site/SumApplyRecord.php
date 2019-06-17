<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/12 0012
 * Time: 下午 15:02
 */

?>


<?php
echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'media-list'],
    'itemView' => '_sum_apply_item',
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