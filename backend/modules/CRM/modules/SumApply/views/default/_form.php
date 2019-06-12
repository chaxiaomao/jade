<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use cza\base\widgets\ui\adminlte2\InfoBox;
use cza\base\models\statics\EntityModelStatus;

$regularLangName = \Yii::$app->czaHelper->getRegularLangName();
$messageName = $model->getMessageName();
?>

<?php
$form = ActiveForm::begin([
    'action' => ['edit', 'id' => $model->id],
    'options' => [
        'id' => $model->getBaseFormName(),
        'data-pjax' => true,
    ]]);
?>

<div class="<?= $model->getPrefixName('form') ?>
">
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

    <div class="well">
        <?php
        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 2,
            'attributes' => [
                'type' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => []],
                'user_id' => ['type' => Form::INPUT_TEXT, 'options' => ['readonly' => true, 'placeholder' => $model->getAttributeLabel('user_id')]],
                'apply_sum' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('apply_sum')]],
                'bank_name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('bank_name')]],
                'hash' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('hash')]],
                'confirmed_at' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\widgets\DateTimePicker', 'options' => [
                    'options' => ['placeholder' => Yii::t('app.c2', 'Date Time...')], 'pluginOptions' => ['format' => 'yyyy-mm-dd hh:ii:ss', 'autoclose' => true],
                ],],
                'name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('name')]],
                'mobile_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('mobile_number')]],
                'bank_card_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('brank_card_number')]],
                'transfer_rate' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('transfer_rate')]],
                'received_sum' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('received_sum')]],
                'state' => [
                    'type' => Form::INPUT_DROPDOWN_LIST,
                    'items' => \common\models\c2\statics\SumApplyState::getHashMap('id', 'label'),
                    'options' => [
                    ],
                ],
                'status' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => EntityModelStatus::getHashMap('id', 'label')],

            ]
        ]);

        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 1,
            'attributes' => [
                'memo' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\vova07\imperavi\Widget', 'options' => [
                    'settings' => [
                        'minHeight' => 150,
                        'buttonSource' => true,
                        'lang' => $regularLangName,
                        'plugins' => [
                            'fontsize',
                            'fontfamily',
                            'fontcolor',
                            'table',
                            'textdirection',
                            'fullscreen',
                        ],
                    ]
                ],],
            ]
        ]);

        echo Html::beginTag('div', ['class' => 'box-footer']);
        echo Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app.c2', 'Save'), ['type' => 'button', 'class' => 'btn btn-primary pull-right']);
        echo Html::a('<i class="fa fa-arrow-left"></i> ' . Yii::t('app.c2', 'Go Back'), ['index'], ['data-pjax' => '0', 'class' => 'btn btn-default pull-right', 'title' => Yii::t('app.c2', 'Go Back'),]);
        echo Html::endTag('div');
        ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
