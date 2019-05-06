<?php

use cza\base\widgets\ui\common\grid\GridView;
use yii\bootstrap\Modal;
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
                        Html::button('<i class="glyphicon glyphicon-remove"></i>', [
                            'class' => 'btn btn-danger',
                            'title' => Yii::t('app.c2', 'Delete Selected Items'),
                            'onClick' => "jQuery(this).trigger('" . OperationEvent::DELETE_BY_IDS . "', {url:'" . Url::toRoute('multiple-delete') . "'});",
                        ]) . ' ' .
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
                // 'id',
                // 'chess_id',
                [
                    'attribute' => 'chess.code'
                ],
                // 'user_id',
                [
                    'attribute' => 'user.username',
                    'label' => Yii::t('app.c2', 'New user')
                ],
                // 'recommend_user_id',
                [
                    'attribute' => 'recommendUser.username',
                    'label' => Yii::t('app.c2', 'Recommend user')
                ],
                // 'familiar_id',
                // 'chieftain_id',
                [
                    'attribute' => 'chieftain.username',
                    'label' => Yii::t('app.c2', 'Commit user')
                ],
                // 'dues',
                // 'type',
                // 'state',
                [
                    'attribute' => 'state',
                    'filter' => \common\models\c2\statics\UserKpiStateType::getHashMap('id', 'label'),
                    'value' => function ($model) {
                        return \common\models\c2\statics\UserKpiStateType::getLabel($model->state);
                    }
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
                    'template' => '{ensure-do} {update} {delete} {view}',
                    'visibleButtons' => [
                        'ensure-do' => function ($model) {
                            return $model->isChieftainCommit();
                        }
                    ],
                    'buttons' => [
                        'update' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['edit', 'id' => $model->id], [
                                'title' => Yii::t('app', 'Info'),
                                'data-pjax' => '0',
                            ]);
                        },
                        'ensure-do' => function ($url, $model, $key) {
                            $title = Yii::t('app.c2', 'Not matter kpi commit');
                            return Html::a(Html::tag('span', '', ['class' => "glyphicon glyphicon-copy"]), ['ensure-do', 'id' => $model->id], [
                                'title' => $title,
                                'aria-label' => $title,
                                'data-pjax' => '0',
                                'class' => 'ensure-do'
                            ]);
                        },
                    ]
                ],

            ],
        ]); ?>

    </div>
<?php
Modal::begin([
    'id' => 'inventory-delivery-note-modal',
    'size' => 'modal-lg',
]);
Modal::end();
$js = "";

$js .= "jQuery(document).off('click', 'a.ensure-do').on('click', 'a.ensure-do', function(e) {
                e.preventDefault();
                var lib = window['krajeeDialog'];
                var url = jQuery(e.currentTarget).attr('href');
                lib.confirm('" . Yii::t('app.c2', 'Not matter kpi commit') . "', function (result) {
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