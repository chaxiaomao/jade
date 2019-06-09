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
                'type' => [
                    'type' => Form::INPUT_DROPDOWN_LIST,
                    'items' => \common\models\c2\statics\GRPType::getHashMap('id', 'label')
                ],
                'label' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('label')]],
                // 'attributeset_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('attributeset_id')]],
                // 'province_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('province_id')]],
                // 'city_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('city_id')]],
                // 'district_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('district_id')]],
                'province_id' => [
                    'type' => Form::INPUT_DROPDOWN_LIST,
                    'items' => ['0' => Yii::t('app.c2', 'Select Options ...')] + \common\models\c2\entity\RegionProvince::getHashMap('id', 'label'),
                    'options' => ['id' => 'province-id']
                ],
                'city_id' => [
                    'type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\widgets\DepDrop', 'options' => [
                        'data' => empty($model->province_id) ? [] : \common\models\c2\entity\RegionProvince::findOne(['id' => $model->province_id])->getCityHashMap(),
                        'options' => [
                            'id' => 'city-id'
                        ],
                        'pluginOptions' => [
                            'depends' => ['province-id'],
                            'placeholder' => Yii::t('app.c2', 'Select Options ...'),
                            'url' => \yii\helpers\Url::toRoute(['citys'])
                        ],
                    ],
                ],
                'district_id' => [
                    'type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\widgets\DepDrop', 'options' => [
                        'data' => empty($model->city_id) ? [] : \common\models\c2\entity\RegionCity::findOne(['id' => $model->city_id])->getDistrictHashMap(),
                        'pluginOptions' => [
                            'depends' => ['city-id', 'province-id'],
                            'placeholder' => Yii::t('app.c2', 'Select options ..'),
                            'url' => \yii\helpers\Url::toRoute(['districts'])
                        ],
                    ],
                ],
                'code' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('code')]],
                'seo_code' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('code')]],
                // 'geo_longitude' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('geo_longitude')]],
                // 'geo_latitude' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('geo_latitude')]],
                // 'geo_marker_color' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('geo_marker_color')]],
                // 'state' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => EntityModelStatus::getHashMap('id', 'label')],
                'status' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => EntityModelStatus::getHashMap('id', 'label')],
                'position' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\touchspin\TouchSpin', 'options' => [
                    'pluginOptions' => [
                        'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>',
                        'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
                    ],
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
