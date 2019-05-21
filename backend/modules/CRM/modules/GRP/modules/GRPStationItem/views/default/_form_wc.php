<?php

use cza\base\models\statics\OperationEvent;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use cza\base\widgets\ui\adminlte2\InfoBox;
use cza\base\models\statics\EntityModelStatus;

$regularLangName = \Yii::$app->czaHelper->getRegularLangName();
$messageName = $model->getMessageName();

$assets = \backend\assets\AppAsset::register($this);

$this->registerCssFile("{$assets->baseUrl}/org_chart/css/font-awesome.min.css");
$this->registerCssFile("{$assets->baseUrl}/org_chart/css/jquery.orgchart.css");
$this->registerCssFile("{$assets->baseUrl}/org_chart/css/style.css");
$this->registerJsFile("{$assets->baseUrl}/org_chart/js/html2canvas.min.js");
$this->registerJsFile("{$assets->baseUrl}/org_chart/js/jquery.orgchart.js");

$this->title = $model->label . ' ' . Yii::t('app.c2', 'GRP Chart Member');

?>

<div id="chart-container"></div>

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
                'grp_station_id' => [
                    'type' => Form::INPUT_TEXT,
                    'label' => Yii::t('app.c2', 'Selected Node'),
                    'options' => [
                        'placeholder' => $model->getAttributeLabel('grp_station_id'),
                        'id' => 'grp_station_id',
                        'readonly' => true
                    ],
                ],
                'user_id' => [
                    'type' => Form::INPUT_WIDGET,
                    'label' => Yii::t('app.c2', 'User'),
                    'widgetClass' => \kartik\select2\Select2::className(),
                    'options' => [
                        'data' => ['' => Yii::t('app.c2', 'Select ... ')] + \common\models\c2\entity\FeUserModel::getHashMap('id', 'username', [
                            'status' => EntityModelStatus::STATUS_ACTIVE
                        ]),
                        // 'placeholder' => $model->getAttributeLabel('user_id')
                    ]
                ],
                'label' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('label')]],
                // 'state' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\checkbox\CheckboxX', 'options' => [
                //     'pluginOptions' => ['threeState' => false],
                // ],],
                // 'status' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => EntityModelStatus::getHashMap('id', 'label')],
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

<?php

$delUrl = \yii\helpers\Url::toRoute('member-delete');

$js = <<<JS
jQuery(document).off('click', 'a.remove-r').on('click', 'a.remove-r', function(e) {
    if (confirm('你确定要删除吗?')) {
      jQuery(e.currentTarget).parent().hide();
      $.post("${delUrl}", {'id': jQuery(e.currentTarget).attr('data-id')}, function(result) {;})
    }
})

JS;

$this->registerJs($js);
?>

<script type="text/javascript">
    // JQuery.notConfit();
    $(function ($) {

        var datascource = <?= $grpModel->getGRPStationJson(['withMember' => true]) ?>;

        var getId = function () {
            return (new Date().getTime()) * 1000 + Math.floor(Math.random() * 1001);
        };

        var nodeTemplate = function (data) {
            var tag = `<div class="title" data-id="${data.id}" data-type="${data.type}">${data.name}</div>`;
            tag += `<div class="warpper">`;
            if (data.memberList) {
                data.memberList.map(function (item) {
                    tag += `<p>${item.user.username}<a href="javascript:;" data-id="${item.id}" data-pjax='0' class="remove-r glyphicon glyphicon-remove">删除</a></p>`
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
        var data = [];

        oc.$chartContainer.on('click', '.node', function () {
            var $this = $(this);
            $('#selected-node').val($this.find('.title').text()).data('node', $this);
            var selectedId = $this.find('.title').attr('data-id');
            $('#grp_station_id').val(selectedId);
            // selectedType = $this.find('.title').attr('data-type');
            // selectedParentId = $this.find('.title').attr('data-parent-id');
        });

        oc.$chartContainer.on('click', '.orgchart', function (event) {
            if (!$(event.target).closest('.node').length) {
                $('#selected-node').val('');
            }
        });

        $('input[name="chart-state"]').on('click', function () {
            $('.orgchart').toggleClass('edit-state', this.value !== 'view');
            $('#edit-panel').toggleClass('edit-state', this.value === 'view');
            if ($(this).val() === 'edit') {
                $('.orgchart').find('tr').removeClass('hidden')
                    .find('td').removeClass('hidden')
                    .find('.node').removeClass('slide-up slide-down slide-right slide-left');
            } else {
                $('#btn-reset').trigger('click');
            }
        });

        $('input[name="node-type"]').on('click', function () {
            var $this = $(this);
            if ($this.val() === 'parent') {
                $('#edit-panel').addClass('edit-parent-node');
                $('#new-nodelist').children(':gt(0)').remove();
            } else {
                $('#edit-panel').removeClass('edit-parent-node');
            }
        });

        $('#btn-add-input').on('click', function () {
            $('#new-nodelist').append('<li><input type="text" class="new-node"></li>');
        });

        $('#btn-remove-input').on('click', function () {
            var inputs = $('#new-nodelist').children('li');
            if (inputs.length > 1) {
                inputs.last().remove();
            }
        });

        $('#btn-add-nodes').on('click', function () {
            var $chartContainer = $('#chart-container');
            var nodeVals = [];
            $('#new-nodelist').find('.new-node').each(function (index, item) {
                var validVal = item.value.trim();
                if (validVal.length) {
                    nodeVals.push(validVal);
                }
            });
            var $node = $('#selected-node').data('node');
            if (!nodeVals.length) {
                alert('Please input value for new node');
                return;
            }
            var nodeType = $('input[name="node-type"]:checked');
            if (!nodeType.length) {
                alert('Please select a node type');
                return;
            }
            if (nodeType.val() !== 'parent' && !$('.orgchart').length) {
                alert('Please creat the root node firstly when you want to build up the orgchart from the scratch');
                return;
            }
            if (nodeType.val() !== 'parent' && !$node) {
                alert('Please select one node in orgchart');
                return;
            }
            if (nodeType.val() === 'parent') {
                if (!$chartContainer.children('.orgchart').length) {// if the original chart has been deleted
                    oc = $chartContainer.orgchart({
                        'data': {'name': nodeVals[0]},
                        'exportButton': true,
                        'exportFilename': 'SportsChart',
                        'parentNodeSymbol': 'fa-th-large',
                        'createNode': function ($node, data) {
                            $node[0].id = getId();
                        }
                    });
                    oc.$chart.addClass('view-state');
                } else {
                    oc.addParent($chartContainer.find('.node:first'), {'name': nodeVals[0], 'id': getId()});
                }
            } else if (nodeType.val() === 'siblings') {
                if ($node[0].id === oc.$chart.find('.node:first')[0].id) {
                    alert('You are not allowed to directly add sibling nodes to root node');
                    return;
                }
                nodeVals.map(function (item) {
                    data.push({
                        'grp_id': <?= $grpModel->id ?>,
                        'parent_station_id': selectedParentId,
                        'type': selectedType,
                        'name': item,
                        'label': item,
                    })
                })
                oc.addSiblings($node, nodeVals.map(function (item) {
                    return {'name': item, 'relationship': '110', 'id': getId()};
                }));
            } else {
                var hasChild = $node.parent().attr('colspan') > 0 ? true : false;
                nodeVals.map(function (item) {
                    data.push({
                        'grp_id': <?= $grpModel->id ?>,
                        'parent_station_id': selectedId,
                        'type': parseInt(selectedType) + 1,
                        'name': item,
                        'label': item,
                    })
                })
                if (!hasChild) {
                    var rel = nodeVals.length > 1 ? '110' : '100';
                    oc.addChildren($node, nodeVals.map(function (item) {
                        return {'name': item, 'relationship': rel, 'id': getId()};
                    }));
                } else {
                    oc.addSiblings($node.closest('tr').siblings('.nodes').find('.node:first'), nodeVals.map(function (item) {
                        return {'name': item, 'relationship': '110', 'id': getId()};
                    }));
                }
            }
            $.post('<?= \yii\helpers\Url::toRoute('add-station') ?>', {data: data}, function (result) {
            });
        });

        $('#btn-delete-nodes').on('click', function () {
            var $node = $('#selected-node').data('node');
            if (!$node) {
                alert('Please select one node in orgchart');
                return;
            } else if ($node[0] === $('.orgchart').find('.node:first')[0]) {
                if (!window.confirm('Are you sure you want to delete the whole chart?')) {
                    return;
                }
            }
            oc.removeNodes($node);
            $('#selected-node').val('').data('node', null);
        });

        $('#btn-reset').on('click', function () {
            $('.orgchart').find('.focused').removeClass('focused');
            $('#selected-node').val('');
            $('#new-nodelist').find('input:first').val('').parent().siblings().remove();
            $('#node-type-panel').find('input').prop('checked', false);
        });

    });
</script>