<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/6
 * Time: 23:33
 */

$this->title = Yii::t('app.c2', 'My profit');
$this->params['navbar'] = Yii::t('app.c2', 'Back');
?>


<div class="container-fluid">
    <!-- Single button -->
    <div class="btn-group mb10">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
            <?= Yii::t('app.c2', 'Kpi state') ?> <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li>
                <a href="<?= \yii\helpers\Url::toRoute(['/user/profit', 'UserProfitItemSearch[state]' => \common\models\c2\statics\UserKpiStateType::TYPE_FINISH_COMMIT]) ?>">
                    <?= Yii::t('app.c2', 'Finish commit') ?>
                </a>
            </li>
            <li>
                <a href="<?= \yii\helpers\Url::toRoute(['/user/profit']) ?>">
                    <?= Yii::t('app.c2', 'All') ?>
                </a>
            </li>
        </ul>
    </div>

    <?php
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            // 'type',
            [
                'attribute' => 'type',
                'label' => Yii::t('app.c2', 'Kpi type'),
                'value' => function ($model) {
                    return \common\models\c2\statics\UserProfitType::getLabel($model->type);
                }
            ],
            [
                'attribute' => 'chess.code',
                // 'label' => Yii::t('app.c2', 'Type'),
            ],
            [
                'attribute' => 'userKpi.recommendUser.username',
                'label' => Yii::t('app.c2', 'Recommend user')
            ],
            [
                'attribute' => 'userKpi.user.username',
                'label' => Yii::t('app.c2', 'New user')
            ],
            [
                'attribute' => 'income',
                'label' => Yii::t('app.c2', 'Obtain profit'),
                'format' => ['decimal', 2],
                'pageSummary' => true
            ],
            [
                'attribute' => 'state',
                'label' => Yii::t('app.c2', 'Kpi state'),
                'value' => function ($model) {
                    return \common\models\c2\statics\UserKpiStateType::getLabel($model->state);
                }
            ],
        ]
    ])

    ?>

</div>


<!--<div class="table-responsive container-fluid">-->
<!--    <table class="table">-->
<!--        <tbody>-->
<!--            <tr>-->
<!--                <td></td>-->
<!--                <td>123</td>-->
<!--                <td>123</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>123</td>-->
<!--                <td>123</td>-->
<!--                <td>123</td>-->
<!--            </tr>-->
<!--        </tbody>-->
<!--    </table>-->
<!--</div>-->