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

\backend\assets\ChartAsset::register($this);

$regularLangName = \Yii::$app->czaHelper->getRegularLangName();
$messageName = $model->getMessageName();
?>
<div id="chart-container"></div>

<?php
$form = ActiveForm::begin([
    'action' => ['edit-with-chart', 'id' => $model->id,],
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

        ?>

        <?php

        // echo Form::widget([
        //     'model' => $model,
        //     'form' => $form,
        //     'columns' => 1,
        //     'options' => [
        //         'class' => 'red'
        //     ],
        //     'attributes' => [
        //         'ensureCheckbox' => [
        //             'type' => Form::INPUT_CHECKBOX,
        //             'options' => [
        //                 'readonly' => true,
        //                 'placeholder' => $model->getAttributeLabel('ensureCheckbox'),
        //             ]
        //         ],
        //     ]
        // ])
        //
        ?>
    </div>

    <?php

    echo Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app.c2', 'Commit'), [
        'type' => 'button',
        'class' => 'btn btn-success btn-block mb10',
        // 'data-toggle' => 'modal',
        // 'data-target' => '#confirm'
    ]);

    ?>

</div>
<?php ActiveForm::end(); ?>

<?php
\yii\bootstrap\Modal::begin([
    'id' => 'confirm',
    'header' => '<h5>' . Yii::t('app.c2', 'Tips') . '</h5>',
]);

echo '<p class="red">' . Yii::t('app.c2', 'Pls ensure new member transfer the due.') . '</p>';

echo Html::submitButton(Yii::t('app.c2', 'Save'), [
    'type' => 'button',
    'class' => 'btn btn-success',
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
                    tag += `<p>${item.user.username}</p>`
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