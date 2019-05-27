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

    });
</script>