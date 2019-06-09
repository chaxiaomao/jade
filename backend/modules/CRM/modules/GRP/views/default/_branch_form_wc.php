<?php
/**
 * Created by PhpStorm.
 * User: jerrygo
 * Date: 19-6-7
 * Time: 上午7:09
 */

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use cza\base\widgets\ui\adminlte2\InfoBox;
use cza\base\models\statics\EntityModelStatus;

$regularLangName = \Yii::$app->czaHelper->getRegularLangName();
$messageName = $model->getMessageName();
$this->title = $model->label . ' ' . $grpModel->label;

\backend\assets\ChartAsset::register($this);
?>

<div id="chart-container"></div>

<p style="color: red;"><?= Yii::t('app.c2', 'Pls select GRP to separate.') ?></p>

<?php
$form = ActiveForm::begin([
    'action' => ['create-branch-with-chart', 'grp_id' => $grpModel->id],
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

        echo Html::beginTag('div', ['class' => 'box-footer']);
        echo Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app.c2', 'Save'), ['type' => 'button', 'class' => 'btn btn-primary pull-right']);
        echo Html::button('<i class="fa fa-eye"></i> ' . Yii::t('app.c2', 'Assign Member'), ['type' => 'button', 'class' => 'btn btn-info', 'id' => 'btn_assign_member']);
        echo Html::a('<i class="fa fa-arrow-left"></i> ' . Yii::t('app.c2', 'Back'), ['index'], ['data-pjax' => '0', 'class' => 'btn btn-default pull-right', 'title' => Yii::t('app.c2', 'Go Back'),]);
        echo Html::endTag('div');

        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 2,
            'attributes' => [
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
                'status' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => EntityModelStatus::getHashMap('id', 'label')],
                'position' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\touchspin\TouchSpin', 'options' => [
                    'pluginOptions' => [
                        'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>',
                        'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
                    ],
                ],],
                'parentId' => [
                    'type' => Form::INPUT_TEXT,
                    'label' => Yii::t('app.c2', 'Selected Node'),
                    'options' => [
                        'id' => 'selected_id',
                        'readonly' => true,
                    ],
                ],
                'type' => [
                    'type' => Form::INPUT_HIDDEN,
                ],
            ]
        ]);

        ?>
    </div>

</div>
<?php ActiveForm::end(); ?>

<script type="text/javascript">
    // JQuery.notConfit();
    $(function ($) {

        var datascource = <?= $grpModel->getGRPBranchJson($grpModel->id) ?>

        // var nodeTemplate = function (data) {
        //     var tag = `<div class="title" data-id="${data.id}" data-type="${data.type}">${data.name}</div>`;
        //     tag += `<div class="warpper">`;
        //     if (data.userList) {
        //         data.userList.map(function (item) {
        //             tag += `<p>${item.name}</p>`
        //         })
        //     }
        //     tag += '</div>';
        //     return tag;
        // };

        var nodeTemplate = function (data) {
            return `<div class="title" data-id="${data.id}" data-type="${data.type}" data-parent-id="${data.parent_id}">
                        ${data.name}
                    </div>`;
        };

        var oc = $('#chart-container').orgchart({
            'data': datascource,
            'chartClass': 'edit-state',
            'exportButton': true,
            'exportFilename': 'SportsChart',
            'parentNodeSymbol': 'fa-th-large',
            // 'pan': true,
            // 'zoom': true,
            // 'createNode': function ($node, data) {
            //     $node[0].id = data.id;
            // },
            // 'nodeTemplate': function (data) {
            //     return '<div class="title" data-id="' + data.id + '" data-type="' + data.type + '">' + data.name + '</div>'
            // }
            'nodeTemplate': nodeTemplate
        });

        oc.$chartContainer.on('click', '.node', function () {
            var $this = $(this);
            var selectedId = $this.find('.title').attr('data-id');
            $('#selected_id').val(selectedId).data('node', $this);
        });

        oc.$chartContainer.on('click', '.orgchart', function (event) {
            if (!$(event.target).closest('.node').length) {
                $('#selected-node').val('');
            }
        });

        $('#btn_assign_member').on('click', function (e) {
            var $node = $('#selected_id').data('node');
            if (!$node) {
                alert('请先选择节点');
                return;
            }
            if ($node[0] === $('.orgchart').find('.node:first')[0]) {
                alert('不能分配根节点!');
                return;
            }
            var id = $('#selected_id').val();
            var href = '/crm/grp/grp-station-item/default/edit-branch-with-chart'
                + '?grp_id=' + id;
            location.href = href;
        });

    });
</script>