<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/5
 * Time: 18:04
 */

use cza\base\widgets\ui\adminlte2\InfoBox;
use yii\helpers\Html;

$messageName = $kpiModel->getMessageName();

$this->title = Yii::t('app.c2', 'Kpi commit');
$this->params['navbar'] = Yii::t('app.c2', 'Back');

?>

<div class="container-fluid">
    <?php if (Yii::$app->session->hasFlash($messageName)): ?>
        <?php if (!$kpiModel->hasErrors()) {
            echo InfoBox::widget([
                'withWrapper' => false,
                'defaultMessageType' => InfoBox::TYPE_SUCCESS,
                'messages' => Yii::$app->session->getFlash($messageName),
            ]);
        } else {
            echo InfoBox::widget([
                'withWrapper' => false,
                'defaultMessageType' => InfoBox::TYPE_WARNING,
                'messages' => Yii::$app->session->getFlash($messageName),
            ]);
        }
        ?>
    <?php endif; ?>

    <?= Html::a(Yii::t('app.c2', 'Back'), \yii\helpers\Url::toRoute('kpi-list'), ['class' => 'btn btn-success btn-block']) ?>

</div>

