<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/5
 * Time: 9:59
 */

use cza\base\widgets\ui\adminlte2\InfoBox;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = Yii::t('app.c2', 'Kpi commit');
$this->params['navbar'] = Yii::t('app.c2', 'Back');
?>

<!-- 模态框（Modal） -->
<div class="modal fade" id="tipsModal" tabindex="-1" role="dialog" aria-labelledby="tipsModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body red"><?= Yii::t('app.c2', 'Pls confirm the user had already pay due') ?></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">X</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>

<div class="container-fluid mb10">


    <?php $form = ActiveForm::begin(['id' => 'form-commit-kpi', 'action' => \yii\helpers\Url::toRoute(['kpi-commit', 'id' => $kpiModel->id])]); ?>


    <div class="form-group has-success has-feedback">
        <label class="control-label"
               for="inputGroupSuccess1"><?= Yii::t('app.c2', '*Chess commit') ?></label>
        <div class="input-group">
            <span class="input-group-addon"><?= Yii::t('app.c2', 'Code') ?></span>
            <input type="text" class="form-control" id="inputGroupSuccess1"
                   aria-describedby="inputGroupSuccess1Status"
                   placeholder="<?= $kpiModel->chess->code ?>" readonly>
        </div>
        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
        <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
    </div>

    <div class="form-group has-success has-feedback">
        <label class="control-label"
               for="inputGroupSuccess1"><?= Yii::t('app.c2', '*User commit') ?></label>
        <div class="input-group">
            <span class="input-group-addon"><?= Yii::t('app.c2', 'Username') ?></span>
            <input type="text" class="form-control" id="inputGroupSuccess1"
                   aria-describedby="inputGroupSuccess1Status"
                   placeholder="<?= $kpiModel->user->username ?>" readonly>
        </div>
        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
        <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
    </div>

    <div class="form-group has-success has-feedback">
        <label class="control-label"
               for="inputGroupSuccess1"><?= Yii::t('app.c2', '*User commit') ?></label>
        <div class="input-group">
            <span class="input-group-addon"><?= Yii::t('app.c2', 'Mobile number') ?></span>
            <input type="text" class="form-control" id="inputGroupSuccess1"
                   aria-describedby="inputGroupSuccess1Status"
                   placeholder="<?= $kpiModel->user->mobile_number ?>" readonly>
        </div>
        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
        <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
    </div>

    <div class="form-group has-success has-feedback">
        <label class="control-label"
               for="inputGroupSuccess1"><?= Yii::t('app.c2', '*Recommend user commit') ?></label>
        <div class="input-group">
            <span class="input-group-addon"><?= Yii::t('app.c2', 'Username') ?></span>
            <input type="text" class="form-control" id="inputGroupSuccess1"
                   aria-describedby="inputGroupSuccess1Status"
                   placeholder="<?= $kpiModel->recommendUser->username ?>" readonly>
        </div>
        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
        <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
    </div>

    <div class="form-group has-success has-feedback">
        <label class="control-label"
               for="inputGroupSuccess2"><?= Yii::t('app.c2', '*According to CRJR result') ?></label>
        <div class="input-group">
            <span class="input-group-addon"><?= Yii::t('app.c2', 'Owner parent username') ?></span>
            <input type="text" class="form-control" id="inputGroupSuccess2"
                   aria-describedby="inputGroupSuccess1Status"
                   placeholder="<?= $ownerFamiliar->username ?>" readonly>
            <?= $form->field($kpiModel, 'familiar_id', ['template' => '{input}'])->hiddenInput(['value' => $ownerFamiliar->id,]); ?>
        </div>
        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
        <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
    </div>

    <div class="form-group has-success has-feedback">
        <label class="control-label"
               for="inputGroupSuccess1"><?= Yii::t('app.c2', '*Chieftain user commit') ?></label>
        <div class="input-group">
            <span class="input-group-addon"><?= Yii::t('app.c2', 'Username') ?></span>
            <input type="text" class="form-control" id="inputGroupSuccess1"
                   aria-describedby="inputGroupSuccess1Status"
                   placeholder="<?= Yii::$app->user->currentUser->username ?>" readonly>

            <?= $form->field($kpiModel, 'chieftain_id', ['template' => '{input}'])->hiddenInput(['value' => Yii::$app->user->currentUser->id,]); ?>

        </div>
        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
        <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
    </div>

    <div class="form-group has-success has-feedback">
        <label class="control-label" for="inputGroupSuccess2"><?= Yii::t('app.c2', '*Pay dues commit') ?></label>
        <div class="input-group">
            <span class="input-group-addon"><?= Yii::t('app.c2', 'Pay due') ?></span>
            <?= $form->field($kpiModel, 'dues', ['template' => '{input}'])->textInput([
                'type' => 'number',
                'class' => 'form-control',
                'placeholder' => '0.00'
            ])->label(false) ?>
            <span class="input-group-btn">
                    <button data-toggle="modal" data-target="#tipsModal" class="btn btn-default" type="button">?</button>
                </span>
        </div>
    </div>

    <?php
    $itemIndex = 0;
    $name1 = 'items[' . $itemIndex . '][user_id]';
    $name2 = 'items[' . $itemIndex . '][income]';
    $name3 = 'items[' . $itemIndex . '][type]';
    ?>

    <div class="form-group has-success has-feedback">
        <label class="control-label" for="inputGroupSuccess2"><?= Yii::t('app.c2', 'Recommend user') ?></label>
        <div class="input-group">
            <span class="input-group-addon"><?= $kpiModel->recommendUser->username ?></span>
            <input name="<?= $name3 ?>" class="form-control"
                   aria-describedby="inputGroupSuccess1Status"
                   placeholder="0.00"
                   value="<?= \common\models\c2\statics\UserProfitType::TYPE_AWARD ?>"
                   type="hidden">
            <input name="<?= $name1 ?>" class="form-control"
                   aria-describedby="inputGroupSuccess1Status"
                   placeholder="0.00"
                   value="<?= $kpiModel->recommendUser->id ?>"
                   type="hidden">
            <input name="<?= $name2 ?>" type="number" class="form-control"
                   aria-describedby="inputGroupSuccess1Status"
                   value="<?= '' ?>"
                   placeholder="0.00">
            <div class="input-group-addon"><?= Yii::t('app.c2', 'Obtain award') ?></div>
        </div>
    </div>

    <?php
    $itemIndex++;
    $name1 = 'items[' . $itemIndex . '][user_id]';
    $name2 = 'items[' . $itemIndex . '][income]';
    ?>

    <div class="form-group has-success has-feedback">
        <label class="control-label"
               for="inputGroupSuccess2"><?= Yii::t('app.c2', '*Relation {s1} user', ['s1' => Yii::t('app.c2', 'Familiar')]) ?></label>
        <div class="input-group">
            <span class="input-group-addon"><?= $ownerFamiliar->username ?></span>
            <input name="<?= $name1 ?>" class="form-control"
                   aria-describedby="inputGroupSuccess1Status"
                   placeholder="0.00"
                   value="<?= $ownerFamiliar->id ?>"
                   type="hidden">
            <input name="<?= $name2 ?>" type="number" class="form-control" id="inputGroupSuccess2"
                   aria-describedby="inputGroupSuccess1Status"
                   placeholder="0.00">
            <div class="input-group-addon"><?= Yii::t('app.c2', 'Obtain profit') ?></div>
        </div>
    </div>

    <?php foreach ($ownerMasters as $ownerMaster): ?>

        <?php
        $itemIndex++;
        $name1 = 'items[' . $itemIndex . '][user_id]';
        $name2 = 'items[' . $itemIndex . '][income]';
        ?>
        <div class="form-group has-success has-feedback">
            <label class="control-label"
                   for="inputGroupSuccess2"><?= Yii::t('app.c2', '*Relation {s1} user', ['s1' => Yii::t('app.c2', 'Master')]) ?></label>
            <div class="input-group">
                <span class="input-group-addon"><?= $ownerMaster->user->username ?></span>
                <input name="<?= $name1 ?>" class="form-control"
                       aria-describedby="inputGroupSuccess1Status"
                       placeholder="0.00"
                       value="<?= $ownerMaster->user_id ?>"
                       type="hidden">
                <input name="<?= $name2 ?>" type="number" class="form-control" id="inputGroupSuccess2"
                       aria-describedby="inputGroupSuccess1Status"
                       placeholder="0.00">
                <div class="input-group-addon"><?= Yii::t('app.c2', 'Obtain profit') ?></div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php foreach ($ownerChieftains as $ownerChieftain): ?>
        <?php
        $itemIndex++;
        $name1 = 'items[' . $itemIndex . '][user_id]';
        $name2 = 'items[' . $itemIndex . '][income]';
        ?>
        <div class="form-group has-success has-feedback">
            <label class="control-label"
                   for="inputGroupSuccess2"><?= Yii::t('app.c2', '*Relation {s1} user', ['s1' => Yii::t('app.c2', 'Chieftain')]) ?></label>
            <div class="input-group">
                <span class="input-group-addon"><?= $ownerChieftain->user->username ?></span>
                <input name="<?= $name1 ?>" class="form-control"
                       aria-describedby="inputGroupSuccess1Status"
                       placeholder="0.00"
                       value="<?= $ownerChieftain->user_id ?>"
                       type="hidden">
                <input name="<?= $name2 ?>" type="number" class="form-control" id="inputGroupSuccess2"
                       aria-describedby="inputGroupSuccess1Status"
                       placeholder="0.00">
                <div class="input-group-addon"><?= Yii::t('app.c2', 'Obtain profit') ?></div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php foreach ($ownerElders as $ownerElder): ?>
        <?php
        $itemIndex++;
        $name1 = 'items[' . $itemIndex . '][user_id]';
        $name2 = 'items[' . $itemIndex . '][income]';
        ?>
        <div class="form-group has-success has-feedback">
            <label class="control-label"
                   for="inputGroupSuccess2"><?= Yii::t('app.c2', '*Relation {s1} user', ['s1' => Yii::t('app.c2', 'Elder')]) ?></label>
            <div class="input-group">
                <span class="input-group-addon"><?= $ownerElder->user->username ?></span>
                <input name="<?= $name1 ?>" class="form-control"
                       aria-describedby="inputGroupSuccess1Status"
                       placeholder="0.00"
                       value="<?= $ownerElder->user_id ?>"
                       type="hidden">
                <input name="<?= $name2 ?>" type="number" class="form-control" id="inputGroupSuccess2"
                       aria-describedby="inputGroupSuccess1Status"
                       placeholder="0.00">
                <div class="input-group-addon"><?= Yii::t('app.c2', 'Obtain profit') ?></div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php foreach ($ownerLords as $ownerLord): ?>
        <?php
        $itemIndex++;
        $name1 = 'items[' . $itemIndex . '][user_id]';
        $name2 = 'items[' . $itemIndex . '][income]';
        ?>
        <div class="form-group has-success has-feedback">
            <label class="control-label"
                   for="inputGroupSuccess2"><?= Yii::t('app.c2', '*Relation {s1} user', ['s1' => Yii::t('app.c2', 'Lord')]) ?></label>
            <div class="input-group">
                <span class="input-group-addon"><?= $ownerLord->user->username ?></span>
                <input name="<?= $name1 ?>" class="form-control"
                       aria-describedby="inputGroupSuccess1Status"
                       placeholder="0.00"
                       value="<?= $ownerLord->user_id ?>"
                       type="hidden">
                <input name="<?= $name2 ?>" type="number" class="form-control" id="inputGroupSuccess2"
                       aria-describedby="inputGroupSuccess1Status"
                       placeholder="0.00">
                <div class="input-group-addon"><?= Yii::t('app.c2', 'Obtain profit') ?></div>
            </div>
        </div>
    <?php endforeach; ?>

    <?= Html::submitButton(Yii::t('app.c2', 'Commit up'), ['class' => 'btn btn-success btn-block']) ?>

    <?php ActiveForm::end(); ?>
</div>
