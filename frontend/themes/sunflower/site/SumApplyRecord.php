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
    'pager' => ['class' => \kop\y2sp\ScrollPager::className()]
]);

?>