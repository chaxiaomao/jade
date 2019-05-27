<?php
/**
 * Created by PhpStorm.
 * User: jerrygo
 * Date: 19-5-24
 * Time: 下午10:40
 */
$this->title = Yii::t('app.c2', 'Kpi Verify');
$this->params['navbar'] = Yii::t('app.c2', 'Back');
?>


<div class="container-fluid">
    <h4><?= Yii::t('app.c2', 'My Developer') ?></h4>

    <ul class="media-list">
        <?php foreach ($kpiModels as $kpiModel): ?>
            <?php if ($kpiModel->state == \common\models\c2\statics\UserKpiStateType::TYPE_FINISH_COMMIT): ?>
                <li class="media bottom-board pb10 pt10">
                    <div class="media-left">
                        <a href="javascript:;">
                            <img class="media-object avatar60" src="/images/avatar.png" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="col-xs-10">
                            <h4 class="media-heading"><?= $kpiModel->joinUser->username ?>
                                <span class="label label-success"><?= \common\models\c2\statics\UserKpiStateType::getLabel($kpiModel->state) ?></span>
                            </h4>
                            <?= $kpiModel->joinUser->mobile_number ?>
                        </div>
                    </div>
                </li>

            <?php else: ?>

                <li class="media bottom-board pb10 pt10">
                    <div class="media-left">
                        <a href="<?= \yii\helpers\Url::toRoute(['/user/kpi-commit', 'id' => $kpiModel->id]) ?>">
                            <img class="media-object avatar60" src="/images/avatar.png" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="col-xs-10">
                            <h4 class="media-heading"><?= $kpiModel->joinUser->username ?>
                                <span class="label label-default"><?= \common\models\c2\statics\UserKpiStateType::getLabel($kpiModel->state) ?></span>
                            </h4>
                            <?= $kpiModel->joinUser->mobile_number ?>
                        </div>
                        <div class="col-xs-2">
                            <?= \yii\helpers\Html::a(Yii::t('app.c2', 'Commit'),
                                ['/user/kpi-commit', 'id' => $kpiModel->id], ['class' => 'btn btn-link']) ?>
                        </div>
                    </div>
                </li>

            <?php endif; ?>


        <?php endforeach; ?>
    </ul>
</div>