<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/6 0006
 * Time: 下午 14:54
 */

use yii\helpers\Html;

?>

<li role="presentation" class="btn btn-default navbar-btn">
    <p><?= $model->gRP->label . "(" . $model->gRPStation->label .")" ?></p>
    <?= Html::a($model->gRP->code, ['center', 'p' => Yii::$app->getSecurity()->hashData($model->id, 'id')], ['class' => 'navbar-link']) ?>
</li>
