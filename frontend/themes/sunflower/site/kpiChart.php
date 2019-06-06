<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/6 0006
 * Time: 上午 10:55
 */
$this->title = Yii::t('app.c2', 'User Kpi Chart');
$this->params['navbar'] = Yii::t('app.c2', 'Back');
?>

<?= \frontend\widgets\UserKpiChart::widget([
    'user' => Yii::$app->user->currentUser,
    'grpId' => Yii::$app->session->get('grp_id'),
]) ?>
