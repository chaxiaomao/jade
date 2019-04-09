<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/4
 * Time: 10:21
 */
?>
<div class="card" style="width: 96%;margin: 10px auto 0;">
    <div class="card-header">
        <?= Yii::t('app.c2', 'Base Profile') ?>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div class="row">
                <span class="col"><?= Yii::t('app.c2', 'Username') ?></span>
                <span class="col tr"><?= Yii::$app->user->username ?></span>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <span class="col"><?= Yii::t('app.c2', 'User Degree') ?></span>
                <span class="col tr"><?= \common\models\c2\statics\FeUserType::getLabel(Yii::$app->user->currentUser->type) ?></span>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <span class="col"><?= Yii::t('app.c2', 'Register At') ?></span>
                <span class="col tr"><?= date('Y-m-d', strtotime(Yii::$app->user->currentUser->created_at)) ?></span>
            </div>
        </li>
        <li class="list-group-item">
            <a href="<?= \yii\helpers\Url::toRoute('member-list') ?>" class="row">
                <span class="col"><?= Yii::t('app.c2', 'My members') ?></span>
                <span class="col tr"><?= $count . Yii::t('app.c2', 'Men') ?></span>
            </a>
        </li>
    </ul>
    <!--    <button type="button" class="btn btn-info mt10" id="gen">Info</button>-->
</div>

<?php
 echo \frontend\widgets\RCodeGenerator::widget([]);
?>


