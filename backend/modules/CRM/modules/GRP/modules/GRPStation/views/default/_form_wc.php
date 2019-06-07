<?php

use cza\base\models\statics\OperationEvent;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use cza\base\widgets\ui\adminlte2\InfoBox;
use cza\base\models\statics\EntityModelStatus;
use yii\helpers\Url;

$regularLangName = \Yii::$app->czaHelper->getRegularLangName();
$messageName = $model->getMessageName();

\backend\assets\ChartAsset::register($this);

$this->title = $model->label . ' ' . $grpModel->label;

$jsonData = $grpModel->getGRPStationJson();
?>

<div id="chart-container">
    <?=
    $jsonData == null ? Html::button(Yii::t('app.c2', 'Init'), [
            'class' => 'btn btn-link btn-block', 'id' => 'btn-init']) : ''
    ?>
</div>

<?php
$form = ActiveForm::begin([
    'action' => ['edit-with-chart', 'id' => $model->id, 'grp_id' => $grpModel->id],
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
            $js = "$('#selected_id').val('')";
            $this->registerJs($js);
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
                'name' => [
                    'type' => Form::INPUT_TEXT,
                    'options' => [
                        'placeholder' => $model->getAttributeLabel('name')
                    ]
                ],
                'label' => [
                    'type' => Form::INPUT_TEXT,
                    'options' => [
                        'placeholder' => $model->getAttributeLabel('label')
                    ]
                ],
                'selected_id' => [
                    'type' => Form::INPUT_TEXT,
                    'options' => [
                        'readonly' => true,
                        'id' => 'selected_id',
                        'placeholder' => $model->getAttributeLabel('parent_station_id')
                    ]
                ],
                'node_nav' => [
                    'type' => Form::INPUT_RADIO_LIST,
                    'label' => Yii::t('app.c2', 'Node Nav'),
                    'items' => \common\models\c2\statics\NodeNavType::getHashMap('id', 'label'),
                    'options' => [
                        'itemOptions' => [
                            'labelOptions' => ['class' => 'label label-success']
                        ]
                    ]
                ],
                // 'status' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => EntityModelStatus::getHashMap('id', 'label')],
                'position' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\touchspin\TouchSpin', 'options' => [
                    'pluginOptions' => [
                        'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>',
                        'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
                    ],
                ],],
                'parent_station_id' => [
                    'type' => Form::INPUT_HIDDEN,
                    'options' => [
                        'readonly' => true,
                        'id' => 'parent_station_id',
                        'placeholder' => $model->getAttributeLabel('parent_station_id')
                    ]
                ],
                'grp_id' => [
                    'type' => Form::INPUT_HIDDEN,
                    'options' => [
                        'readonly' => true,
                        'placeholder' => $model->getAttributeLabel('grp_id')
                    ]
                ],
                'type' => [
                    'type' => Form::INPUT_HIDDEN,
                    'options' => [
                        'readonly' => true,
                        'id' => 'type',
                        'placeholder' => $model->getAttributeLabel('type')
                    ]
                ],
            ]
        ]);
        echo Html::beginTag('div', ['class' => 'box-footer']);
        echo Html::a('<i class="glyphicon glyphicon-repeat"></i>', Url::current(), [
            'class' => 'btn btn-default pull-right',
            'title' => Yii::t('app.c2', 'Reset Grid')
        ]);
        echo Html::a('<i class="fa fa-eye"></i> ' . Yii::t('app.c2', 'GRP Chart Member'),
            [
                '/crm/grp/grp-station-item/default/edit-with-chart',
                'grp_id' => $grpModel->id
            ],
            [
                'class' => 'btn btn-primary',
                'target' => '_blank',
                'data-pjax' => '0'
            ]
        );
        echo Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app.c2', 'Save'), ['type' => 'button', 'class' => 'btn btn-success pull-right']);
        echo Html::button('<i class="fa fa-deafness"></i> ' . Yii::t('app.c2', 'Delete'),
            [
                'id' => 'btn-delete-node',
                'type' => 'button',
                'class' => 'btn btn-danger'
            ]
        );
        echo Html::button('<i class="fa fa-edit"></i> ' . Yii::t('app.c2', 'Edit'),
            [
                'id' => 'btn-edit-node',
                'type' => 'button',
                // 'data-pjax' => '0',
                'class' => 'btn btn-info pull-right remove-r'
            ]
        );
        echo Html::a('<i class="fa fa-arrow-left"></i> ' . Yii::t('app.c2', 'Go Back'), ['/crm/grp'], ['data-pjax' => '0', 'class' => 'btn btn-default pull-right', 'title' => Yii::t('app.c2', 'Go Back'),]);
        echo Html::endTag('div');
        ?>
    </div>
</div>
<?php ActiveForm::end(); ?>

<?php

\yii\bootstrap\Modal::begin([
    'id' => 'edit-modal'
]);

\yii\bootstrap\Modal::end();

?>

<script type="text/javascript">
    // JQuery.notConfit();
    $(function ($) {

        var datascource = <?= $jsonData == null ? "{}" : $jsonData ?>

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
            return `<div class="title" data-id="${data.id}" data-type="${data.type}" data-parent-id="${data.parent_id}">${data.name}</div>`;
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
            $('#selected-node').val($this.find('.title').text()).data('node', $this);
            var selectedId = $this.find('.title').attr('data-id');
            var selectedType = $this.find('.title').attr('data-type');
            var selectedParentId = $this.find('.title').attr('data-parent-id');
            $('#type').val(selectedType).data('node', $this);
            $('#parent_station_id').val(selectedParentId).data('node', $this);
            $('#selected_id').val(selectedId).data('node', $this);
        });

        oc.$chartContainer.on('click', '.orgchart', function (event) {
            if (!$(event.target).closest('.node').length) {
                $('#selected-node').val('');
            }
        });

        $('#btn-delete-node').on('click', function () {
            if (confirm('你确定要删除吗？删除节点后该岗位下面人员将会清空！')) {
                var $node = $('#selected_id').data('node');
                var id = $('#selected_id').val();
                if (!$node) {
                    alert('请先选择节点');
                    return;
                }
                if ($node[0] === $('.orgchart').find('.node:first')[0]) {
                    alert('不能删除根节点!');
                    return;
                }
                //$.post("<?//= \yii\helpers\Url::toRoute('station-delete') ?>//", {'id': id}, function (result) {
                //    if (result._meta.result === '<?//= \cza\base\models\statics\OperationResult::SUCCESS ?>//') {
                //        oc.removeNodes($node);
                //        $('#selected_id').val('').data('node', null);
                //    } else {
                //        alert(result._meta.message);
                //    }
                //})
            }
        });

        $('#btn-edit-node').on('click', function () {
            var $node = $('#selected_id').data('node');
            var id = $('#selected_id').val();
            if (!$node) {
                alert('请先选择节点');
                return;
            }
            var href = '<?= \yii\helpers\Url::toRoute(['edit']) ?>' + '?id=' + id;
            jQuery('#edit-modal').modal('show').find('.modal-content').html('....').load(href);
            // location.href = href;
        });

        $('#btn-reset').on('click', function () {
            $('.orgchart').find('.focused').removeClass('focused');
            $('#selected-node').val('');
            $('#new-nodelist').find('input:first').val('').parent().siblings().remove();
            $('#node-type-panel').find('input').prop('checked', false);
        });

        $('#btn-init').on('click', function () {
            if (confirm('你确定要初始化吗？')) {
                $.post("<?= \yii\helpers\Url::toRoute(['station-init']) ?>", {'id': <?= $grpModel->id ?>}, function (result) {
                    console.log(result)
                    if (result._meta.result === '<?= \cza\base\models\statics\OperationResult::SUCCESS ?>') {
                        location.reload();
                    } else {
                        alert(result._meta.message);
                    }
                })
            }
        });

    });
</script>
