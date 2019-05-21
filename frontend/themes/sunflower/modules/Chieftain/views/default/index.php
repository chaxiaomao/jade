<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/4
 * Time: 10:21
 */

use yii\helpers\Url;

$this->title = Yii::t('app.c2', 'Profile center');
$user = Yii::$app->user->identity;
?>
<div class="container">

    <?php echo \frontend\widgets\ProfilePanel::widget(['user' => $user, 'isChieftain' => true])?>

    <?php //echo \frontend\widgets\RecommendCodeGenerator::widget([]); ?>

    <?php echo \frontend\widgets\ChessStation::widget(['user' => $user])?>

</div>

