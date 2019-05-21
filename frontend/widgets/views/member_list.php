<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/9
 * Time: 10:16
 */

use yii\widgets\LinkPager;

$this->params['navbar'] = Yii::t('app.c2', 'Back');
?>

<!--<ul class="list-group list-group-flush">-->
<!--    <li class="list-group-item">Cras justo odio</li>-->
<!--    <li class="list-group-item">Dapibus ac facilisis in</li>-->
<!--    <li class="list-group-item">Morbi leo risus</li>-->
<!--    <li class="list-group-item">Porta ac consectetur ac</li>-->
<!--    <li class="list-group-item">Vestibulum at eros</li>-->
<!--</ul>-->

<?php

echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => 'member_item',
    'layout' => "{items}<div style='display: none'>{pager}</div>",
    'summary' => '',
    'itemOptions' => [
        'tag' => false,
        // 'class' => 'list-group-item'
    ],
    'options' => [
        // 'tag' => false,
        'id' => 'm-container',
        'class' => 'list-group list-group-flush'
    ],
    'pager' => [
        'class' => \common\widgets\Y2sp\ScrollPager::className(),
        'container' => '#m-container',
        'item' => '.list-group-item',
        // 'next' => '.next a',
        // 'historyPrev' => '.prev a',
        'triggerOffset' => 999,
        //'options' => ['class' => 'hidden'],//关闭分页（默认开启）
        // 'maxButtonCount' => 6,//最多显示几个分页按钮
        // 'firstPageLabel' => '首页',
        // 'prevPageLabel' => Yii::t('app.c2', 'Last Page'),
        // 'nextPageLabel' => Yii::t('app.c2', 'Next Page'),
        // 'lastPageLabel' => '尾页'
    ]
])

?>
<?php
// echo LinkPager::widget([
//     'pagination' => $pagination,
// ]);
// ?>
