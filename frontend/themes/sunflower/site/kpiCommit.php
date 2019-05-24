<?php
/**
 * Created by PhpStorm.
 * User: jerrygo
 * Date: 19-5-24
 * Time: 下午10:40
 */
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use cza\base\widgets\ui\adminlte2\InfoBox;
use cza\base\models\statics\EntityModelStatus;
use yii\widgets\Pjax;

$this->title = Yii::t('app.c2', 'Kpi Verify');
$this->params['navbar'] = Yii::t('app.c2', 'Back');

$regularLangName = \Yii::$app->czaHelper->getRegularLangName();
$messageName = $model->getMessageName();
?>
<?php Pjax::begin(['id' => $model->getDetailPjaxName(), 'formSelector' => $model->getBaseFormName(true), 'enablePushState' => false, 'clientOptions' =>[
    'skipOuterContainers'=>true
]]) ?>

<?php
$form = ActiveForm::begin([
    'action' => ['kpi-commit', 'id' => $model->id],
    'options' => [
        'id' => $model->getBaseFormName(),
        'data-pjax' => true,
        'class' => 'container-fluid'
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

        <div class="">
            <?php
            echo Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 2,
                'attributes' => [
                    'grp_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('grp_id')]],
                    'join_user_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('join_user_id')]],
                    'invite_user_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('invite_user_id')]],
                    'grp_station_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('grp_station_id')]],
                    'c1_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('c1_id')]],
                    'dues' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('dues')]],
                    'type' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => []],
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
                ]
            ]);

            ?>
        </div>

        <?php

        echo Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app.c2', 'Save'), ['type' => 'button', 'class' => 'btn btn-success btn-block']);

        ?>

    </div>
<?php ActiveForm::end(); ?>
<?php  Pjax::end() ?>
