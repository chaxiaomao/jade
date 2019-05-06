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
                'code' => [
                    'type' => Form::INPUT_TEXT,
                    'options' => [
                        'placeholder' => $model->chess->code,
                        'readonly' => true
                    ]
                ],
                'user_id' => [
                    'type' => Form::INPUT_WIDGET,
                    'label' => Yii::t('app.c2', 'New user'),
                    'widgetClass' => \kartik\select2\Select2::className(),
                    'options' => [
                        'data' => \common\models\c2\entity\FeUserModel::getHashMap('id', 'username', ['status' => EntityModelStatus::STATUS_ACTIVE]),
                    ]
                ],
                // 'recommend_user_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('recommend_user_id')]],
                'recommend_user_id' => [
                    'type' => Form::INPUT_WIDGET,
                    'label' => Yii::t('app.c2', 'Recommend user'),
                    'widgetClass' => \kartik\select2\Select2::className(),
                    'options' => [
                        'data' => \common\models\c2\entity\FeUserModel::getHashMap('id', 'username', ['status' => EntityModelStatus::STATUS_ACTIVE]),
                    ]
                ],
                // 'familiar_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('familiar_id')]],
                'familiar_id' => [
                    'type' => Form::INPUT_WIDGET,
                    'label' => Yii::t('app.c2', 'Owner user'),
                    'widgetClass' => \kartik\select2\Select2::className(),
                    'options' => [
                        'data' => \common\models\c2\entity\FeUserModel::getHashMap('id', 'username', ['status' => EntityModelStatus::STATUS_ACTIVE]),
                    ]
                ],
                // 'chieftain_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('chieftain_id')]],
                'chieftain_id' => [
                    'type' => Form::INPUT_WIDGET,
                    'label' => Yii::t('app.c2', 'Commit user'),
                    'widgetClass' => \kartik\select2\Select2::className(),
                    'options' => [
                        'data' => \common\models\c2\entity\FeUserModel::getHashMap('id', 'username', ['status' => EntityModelStatus::STATUS_ACTIVE]),
                    ]
                ],
                'dues' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('dues'), 'type' => 'number']],
                // 'type' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => []],
                'state' => [
                    'type' => Form::INPUT_DROPDOWN_LIST,
                    'items' => \common\models\c2\statics\UserKpiStateType::getHashMap('id', 'label'),
                    'label' => Yii::t('app.c2', 'Kpi commit state'),
                    'options' => [
                        'pluginOptions' => ['threeState' => false],
                    ],
                ],
                'status' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => EntityModelStatus::getHashMap('id', 'label')],
                'position' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\touchspin\TouchSpin', 'options' => [
                    'pluginOptions' => [
                        'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>',
                        'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
                    ],
                ],],
            ]
        ]);

        $multipleItemsId = $model->getPrefixName('items');

        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 1,
            'attributes' => [
                'items' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => \unclead\multipleinput\MultipleInput::className(),
                    'options' => [
                        'data' => $model->items,
                        'allowEmptyList' => true,
                        'rowOptions' => function ($model, $index, $context) {
                            return ['data-id' => $model['id']];
                        },
                        'columns' => [
                            [
                                'name' => 'id',
                                'type' => 'hiddenInput'
                            ],
                            [
                                'name' => 'type',
                                'type' => 'dropDownList',
                                'items' => \common\models\c2\statics\UserProfitType::getHashMap('id', 'label')
                            ],
                            [
                                'name' => 'user_id',
                                'type' => \kartik\select2\Select2::className(),
                                'options' => [
                                    'data' => \common\models\c2\entity\UserChessRsModel::getUsernameHashMap($model->chess_id)
                                ]
                            ],
                            [
                                'name' => 'income',
                                'options' => [
                                    'type' => 'number'
                                ]
                            ],
                        ]
                    ]
                ]
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
