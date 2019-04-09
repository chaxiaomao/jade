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


<?= \frontend\widgets\MemberListWidget::widget([
        'dataProvider' => $dataProvider
]) ?>
