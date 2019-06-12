<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use cza\base\widgets\ui\adminlte2\InfoBox;
use cza\base\models\statics\EntityModelStatus;
use yii\widgets\Pjax;
$this->title = Yii::t('app.c2', 'Sum Apply');
$this->params['navbar'] = Yii::t('app.c2', 'Back');
$regularLangName = \Yii::$app->czaHelper->getRegularLangName();
$messageName = $model->getMessageName();
?>
<?php Pjax::begin(['id' => $model->getDetailPjaxName(), 'formSelector' => $model->getBaseFormName(true), 'enablePushState' => false, 'clientOptions' => [
    'skipOuterContainers' => true
]]) ?>
<?php
$form = ActiveForm::begin([
    'action' => ['/user/sum-apply', 'id' => $model->id],
    'options' => [
        'id' => $model->getBaseFormName(),
        'data-pjax' => true,
    ]]);
?>

    <div class="<?= $model->getPrefixName('form') ?>
">

        <div class="container-fluid">
            <?php if (Yii::$app->session->hasFlash($messageName)): ?>
                <?php if (!$model->hasErrors()) {
                    echo InfoBox::widget([
                        'withWrapper' => false,
                        'messages' => Yii::$app->session->getFlash($messageName),
                    ]);
                } else {
                    echo InfoBox::widget([
                        'defaultMessageType' => InfoBox::TYPE_WARNING,
                        'messages' => Yii::$app->session->getFlash($messageName),
                    ]);
                }
                ?>
            <?php endif; ?>

            <p style="color: red"><?= Yii::t('app.c2', 'Sum apply explain:') ?></p>
            <?php
            echo Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 2,
                'attributes' => [
                    // 'type' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => []],
                    'user_id' => [
                        'type' => Form::INPUT_HIDDEN,
                        'options' => [
                            'value' => Yii::$app->user->currentUser->id,
                            'placeholder' => $model->getAttributeLabel('user_id')
                        ]
                    ],
                    'apply_sum' => [
                        'type' => Form::INPUT_TEXT,
                        'options' => [
                            'placeholder' => $model->getAttributeLabel('apply_sum'),
                            'min' => 0,
                        ]
                    ],
                    'bank_name' => [
                        'type' => Form::INPUT_TEXT, 'options' => [
                            'placeholder' => $model->getAttributeLabel('bank_name')
                        ]
                    ],
                    // 'hash' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('hash')]],
                    // 'confirmed_at' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\widgets\DateTimePicker', 'options' => [
                    //     'options' => ['placeholder' => Yii::t('app.c2', 'Date Time...')], 'pluginOptions' => ['format' => 'yyyy-mm-dd hh:ii:ss', 'autoclose' => true],
                    // ],],
                    'name' => [
                        'type' => Form::INPUT_TEXT,
                        'options' => [
                            'placeholder' => $model->getAttributeLabel('name')
                        ]
                    ],
                    'mobile_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('mobile_number')]],
                    'bank_card_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('bank_card_number')]],
                    // 'transfer_rate' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('transfer_rate')]],
                    // 'received_sum' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('received_sum')]],
                    // 'state' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\checkbox\CheckboxX', 'options' => [
                    //     'pluginOptions' => ['threeState' => false],
                    // ],],
                    // 'status' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => EntityModelStatus::getHashMap('id', 'label')],
                ]
            ]);
            echo Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app.c2', 'Submit Apply'), ['type' => 'button', 'class' => 'btn btn-success btn-block']);
            ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>
<?php Pjax::end() ?>