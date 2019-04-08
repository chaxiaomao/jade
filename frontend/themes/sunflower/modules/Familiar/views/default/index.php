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
                <a class="col"><?= Yii::t('app.c2', 'Username') ?></a>
                <a class="col tr"><?= Yii::$app->user->username ?></a>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <a class="col"><?= Yii::t('app.c2', 'User Degree') ?></a>
                <a class="col tr"><?= \common\models\c2\statics\FeUserType::getLabel(Yii::$app->user->currentUser->type) ?></a>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <a class="col"><?= Yii::t('app.c2', 'Register At') ?></a>
                <a class="col tr"><?= date('Y-m-d', strtotime(Yii::$app->user->currentUser->created_at)) ?></a>
            </div>
        </li>
    </ul>
    <!--    <button type="button" class="btn btn-info mt10" id="gen">Info</button>-->
</div>

<?php
 echo \frontend\widgets\RCodeGenerator::widget([]);
?>


