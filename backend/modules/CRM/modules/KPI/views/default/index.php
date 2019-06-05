<?php

use cza\base\widgets\ui\common\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use cza\base\models\statics\EntityModelStatus;
use cza\base\models\statics\OperationEvent;

/* @var $this yii\web\View */
/* @var $searchModel common\models\c2\search\UserKpiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app.c2', 'User Kpi Models');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="well user-kpi-model-index">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'id' => $model->getPrefixName('grid'),
            'pjax' => true,
            'hover' => true,
            'showPageSummary' => true,
            'panel' => ['type' => GridView::TYPE_PRIMARY, 'heading' => Yii::t('app.c2', 'Items')],
            'toolbar' => [
                [
                    'content' =>
                        Html::a('<i class="glyphicon glyphicon-plus"></i>', ['edit'], [
                            'class' => 'btn btn-success',
                            'title' => Yii::t('app.c2', 'Add'),
                            'data-pjax' => '0',
                        ]) . ' ' .
                        // Html::button('<i class="glyphicon glyphicon-remove"></i>', [
                        //     'class' => 'btn btn-danger',
                        //     'title' => Yii::t('app.c2', 'Delete Selected Items'),
                        //     'onClick' => "jQuery(this).trigger('" . OperationEvent::DELETE_BY_IDS . "', {url:'" . Url::toRoute('multiple-delete') . "'});",
                        // ]) . ' ' .
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', Url::current(), [
                            'class' => 'btn btn-default',
                            'title' => Yii::t('app.c2', 'Reset Grid')
                        ]),
                ],
                '{export}',
                '{toggleData}',
            ],
            'exportConfig' => [],
            'columns' => [
                ['class' => 'kartik\grid\CheckboxColumn'],
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'class' => 'kartik\grid\ExpandRowColumn',
                    'expandIcon' => '<span class="fa fa-plus-square-o"></span>',
                    'collapseIcon' => '<span class="fa fa-minus-square-o"></span>',
                    'detailUrl' => Url::toRoute(['detail']),
                    'value' => function ($model, $key, $index, $column) {
                        return GridView::ROW_COLLAPSED;
                    },
                ],
                'id',
                // 'grp_id',
                [
                    'attribute' => 'grp_id',
                    'value' => function ($model) {
                        return $model->gRP->label;
                    }
                ],
                // 'join_user_id',
                [
                    'attribute' => 'join_user_id',
                    'value' => function ($model) {
                        return $model->joinUser->username;
                    }
                ],
                // 'invite_user_id',
                [
                    'attribute' => 'invite_user_id',
                    'value' => function ($model) {
                        return $model->inviteUser->username;
                    }
                ],
                // 'grp_station_id',
                [
                    'attribute' => 'grp_station_id',
                    'value' => function ($model) {
                        if (!is_null($model->gRPStation)) {
                            return $model->gRPStation->label;
                        }
                    }
                ],
                // 'c1_id',
                // 'dues',
                // 'type',
                // 'state',
                [
                    'attribute' => 'state',
                    'value' => function ($model) {
                        return \common\models\c2\statics\UserKpiStateType::getLabel($model->state);
                    },
                    'filter' => \common\models\c2\statics\UserKpiStateType::getHashMap('id', 'label')
                ],
                // 'status',
                // 'position',
                // 'created_at',
                // 'updated_at',
                [
                    'attribute' => 'status',
                    'class' => '\kartik\grid\EditableColumn',
                    'editableOptions' => [
                        'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                        'formOptions' => ['action' => Url::toRoute('editColumn')],
                        'data' => EntityModelStatus::getHashMap('id', 'label'),
                        'displayValueConfig' => EntityModelStatus::getHashMap('id', 'label'),
                    ],
                    'filter' => EntityModelStatus::getHashMap('id', 'label'),
                    'value' => function ($model) {
                        return $model->getStatusLabel();
                    }
                ],
                [
                    'class' => '\common\widgets\grid\ActionColumn',
                    'width' => '200px',
                    'template' => '{commit} {assign} {finish}',
                    'visibleButtons' => [
                        'commit' => function ($model) {
                            return $model->isStateInit();
                        },
                        'assign' => function ($model) {
                            return $model->isStateAdminCommit();
                        },
                        'finish' => function ($model) {
                            return $model->isStateAdminCommit();
                        },
                    ],
                    'buttons' => [
                        // 'update' => function ($url, $model, $key) {
                        //     return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['edit', 'id' => $model->id], [
                        //         'title' => Yii::t('app', 'Info'),
                        //         'data-pjax' => '0',
                        //     ]);
                        // },
                        'commit' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil">' . Yii::t('app.c2', 'Commit') . '</span>', ['edit-with-chart', 'id' => $model->id], [
                                'title' => Yii::t('app', 'Info'),
                                'data-pjax' => '0',
                                'class' => 'btn btn-success',
                            ]);
                        },
                        'assign' => function ($url, $model, $key) {
                            return Html::a(Yii::t('app.c2', 'Assign Profit'), ['assign-with-chart', 'id' => $model->id], [
                                'title' => Yii::t('app', 'Info'),
                                'data-pjax' => '0',
                                'class' => 'btn btn-danger',
                            ]);
                        },
                        'finish' => function ($url, $model, $key) {
                            return Html::a(Yii::t('app.c2', 'Finish Assignment'), ['finish-assignment', 'id' => $model->id], [
                                'title' => Yii::t('app.c2', 'Finish Assignment'),
                                'data-pjax' => '0',
                                'class' => 'finish',
                            ]);
                        },
                    ]
                ],

            ],
        ]); ?>

    </div>


<?php
$js = "";

$js .= "jQuery(document).off('click', 'a.finish').on('click', 'a.finish', function(e) {
                e.preventDefault();
                var lib = window['krajeeDialog'];
                var url = jQuery(e.currentTarget).attr('href');
                lib.confirm('" . Yii::t('app.c2', 'Are you sure finish kpi assignment?') . "', function (result) {
                    if (!result) {
                        return;
                    }
                    
                    jQuery.ajax({
                            url: url,
                            success: function(data) {
                                var lifetime = 6500;
                                if(data._meta.result == '" . cza\base\models\statics\OperationResult::SUCCESS . "'){
                                    jQuery('#{$model->getPrefixName('grid')}').trigger('" . OperationEvent::REFRESH . "');
                                }
                                else{
                                  lifetime = 16500;
                                }
                                jQuery.msgGrowl ({
                                        type: data._meta.type, 
                                        title: '" . Yii::t('cza', 'Tips') . "',
                                        text: data._meta.message,
                                        position: 'top-center',
                                        lifetime: lifetime,
                                });
                            },
                            error :function(data){alert(data._meta.message);}
                    });
                });
            });";


$js .= "$.fn.modal.Constructor.prototype.enforceFocus = function(){};";   // fix select2 widget input-bug in popup

$this->registerJs($js);
?>