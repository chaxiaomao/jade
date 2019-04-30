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
                // 'user_chess_rs_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('user_chess_rs_id')]],
                'user_chess_rs_id' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => \kartik\select2\Select2::className(),
                    'options' => [
                        // 'placeholder' => $model->getAttributeLabel('user_id')
                        'data' => ['' => 'Select options'] + \common\models\c2\entity\UserChessRsModel::getUsernameHashMap($model->chess_id),
                    ]
                ],
                // 'user_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('user_id')]],
                'user_id' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => \kartik\select2\Select2::className(),
                    'options' => [
                        // 'placeholder' => $model->getAttributeLabel('user_id')
                        'data' => ['' => 'Select options'] + \common\models\c2\entity\FeUserModel::getHashMap('id', 'username'),
                    ]
                ],

                'state' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\checkbox\CheckboxX', 'options' => [
                    'pluginOptions' => ['threeState' => false],
                ],],
                'status' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => EntityModelStatus::getHashMap('id', 'label')],
                'position' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\touchspin\TouchSpin', 'options' => [
                    'pluginOptions' => [
                        'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>',
                        'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
                    ],
                ],],
                'chess_id' => ['type' => Form::INPUT_HIDDEN, 'options' => ['placeholder' => $model->getAttributeLabel('chess_id')]],
                'parent_id' => ['type' => Form::INPUT_HIDDEN, 'options' => ['placeholder' => $model->getAttributeLabel('parent_id')]],
                'type' => ['type' => Form::INPUT_HIDDEN, 'items' => []],
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
