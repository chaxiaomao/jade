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

$assets = \backend\assets\AppAsset::register($this);

$this->registerCssFile("{$assets->baseUrl}/org_chart/css/font-awesome.min.css");
$this->registerCssFile("{$assets->baseUrl}/org_chart/css/jquery.orgchart.css");
$this->registerCssFile("{$assets->baseUrl}/org_chart/css/style.css");
$this->registerJsFile("{$assets->baseUrl}/org_chart/js/html2canvas.min.js");
$this->registerJsFile("{$assets->baseUrl}/org_chart/js/jquery.orgchart.js");

$regularLangName = \Yii::$app->czaHelper->getRegularLangName();
$messageName = $model->getMessageName();
?>

<div id="chart-container"></div>


<?php
$form = ActiveForm::begin([
    'action' => ['assign-with-chart', 'id' => $model->id,],
    'options' => [
        'id' => $model->getBaseFormName(),
        'data-pjax' => true,
        'class' => 'container-fluid'
    ]]);
?>

<div class="<?= $model->getPrefixName('form') ?>">


    <div class="">
        <?php
        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 2,
            'attributes' => [
                'grp_id' => [
                    'type' => Form::INPUT_TEXT,
                    'options' =>
                        [
                            'disabled' => true,
                            'placeholder' => $model->getAttributeLabel('grp_id'),
                            'value' => $model->gRP->label
                        ]
                ],
                'join_user_id' => [
                    'type' => Form::INPUT_TEXT,
                    'options' => [
                        'disabled' => true,
                        'placeholder' => $model->getAttributeLabel('join_user_id'),
                        'value' => $model->joinUser->username,
                    ]
                ],
                'invite_user_id' => [
                    'type' => Form::INPUT_TEXT,
                    'options' => [
                        'disabled' => true,
                        'placeholder' => $model->getAttributeLabel('invite_user_id'),
                        'value' => $model->inviteUser->username,
                    ]
                ],
                'grp_station_id' => [
                    'type' => Form::INPUT_TEXT, 'options' => [
                        'id' => 'grp_station_id',
                        'readonly' => true,
                        'placeholder' => $model->getAttributeLabel('grp_station_id')
                    ]
                ],
                'dues' => [
                    'type' => Form::INPUT_TEXT, 'options' => [
                        'placeholder' => $model->getAttributeLabel('dues'),
                        'type' => 'number',
                        'format' => '0.00',
                        'readonly' => true,
                    ]
                ],
                'checkerName' => [
                    'type' => Form::INPUT_TEXT,
                    'options' => [
                        'readonly' => true,
                        'placeholder' => $model->getAttributeLabel('checkerName'),
                        'value' => Yii::$app->user->currentUser->username,
                    ]
                ],
                'c1_id' => [
                    'type' => Form::INPUT_HIDDEN,
                    'options' => [
                        'readonly' => true,
                        'placeholder' => $model->getAttributeLabel('c1_id'),
                        'value' => Yii::$app->user->currentUser->id,
                    ]
                ],

                // 'type' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => []],
                'state' => [
                    'type' => Form::INPUT_HIDDEN,
                    'options' => [
                        'value' => \common\models\c2\statics\UserKpiStateType::TYPE_C1_COMMIT
                    ],
                ],
                // 'status' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => EntityModelStatus::getHashMap('id', 'label')],
                // 'position' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\touchspin\TouchSpin', 'options' => [
                //     'pluginOptions' => [
                //         'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>',
                //         'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
                //     ],
                // ],],
            ]
        ]);

        echo Html::beginTag('div', ['class' => 'box-footer']);
        // echo Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app.c2', 'Finish Assignment'), ['type' => 'button', 'class' => 'btn btn-success pull-right']);
        echo Html::a('<i class="fa fa-arrow-left"></i> ' . Yii::t('app.c2', 'Go Back'), ['index'], ['data-pjax' => '0', 'class' => 'btn btn-default pull-right', 'title' => Yii::t('app.c2', 'Go Back'),]);
        echo Html::a('<i class="fa fa-eye"></i> ' . Yii::t('app.c2', 'View Assignment'), 'javascript:;', ['data-pjax' => '0', 'id' => 'assign_btn', 'class' => 'btn btn-info', 'title' => Yii::t('app.c2', 'View Assignment'),]);
        echo Html::endTag('div');

        ?>

    </div>
    <?php ActiveForm::end(); ?>
</div>


<?php

\yii\bootstrap\Modal::begin([
    'id' => 'edit-modal',
    'size' => 'modal-lg',
]);

\yii\bootstrap\Modal::end();

?>

<script type="text/javascript">
    // JQuery.notConfit();
    $(function ($) {

        var datascource = <?= $model->gRP->getGRPStationJson(['withMember' => true]) ?>;

        var nodeTemplate = function (data) {
            var tag = `<div class="title" data-id="${data.id}" data-type="${data.type}">${data.name}</div>`;
            tag += `<div class="warpper">`;
            if (data.memberList) {
                data.memberList.map(function (item) {
                    tag += `<p>${item.user.username}<a href="javascript:;" data-id="${item.user.id}" data-pjax='0' class="remove-r glyphicon glyphicon-ok">分配</a></p>`
                })
            }
            tag += '</div>';
            return tag;
        };

        // var nodeTemplate = function (data) {
        //     return `<div class="title" data-id="${data.id}" data-type="${data.type}" data-parent-id="${data.parent_id}">${data.name}</div>`;
        // };

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

        // var selectedId;
        // var selectedType;
        // var selectedParentId;

        oc.$chartContainer.on('click', '.orgchart', function (event) {
            if (!$(event.target).closest('.node').length) {
                $('#selected-node').val('');
            }
        });

        $('.remove-r').on('click', function (e) {
            var user_id = jQuery(e.currentTarget).attr('data-id');
            var href = '/crm/user-profit/profit-item/default/edit'
                + '?user_id=' + user_id
                + '&kpi_id=' + <?= $model->id ?>
                +'&grp_id=' + <?= $model->grp_id ?>;
            jQuery('#edit-modal').modal('show').find('.modal-content').html('....').load(href);
            // location.href = href;
        });

        $('#assign_btn').on('click', function (e) {
            var href = '/crm/user-profit/profit-item'
                + '?UserProfitItemSearch[kpi_id]=' + <?= $model->id ?>;
            jQuery('#edit-modal').modal('show').find('.modal-content').html('....').load(href);
            // location.href = href;
        });

    });
</script>