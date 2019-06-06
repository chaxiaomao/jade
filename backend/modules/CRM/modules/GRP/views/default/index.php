<?php

use cza\base\widgets\ui\common\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use cza\base\models\statics\EntityModelStatus;
use cza\base\models\statics\OperationEvent;

/* @var $this yii\web\View */
/* @var $searchModel common\models\c2\search\GRPSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app.c2', 'G R P Models');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="well grpmodel-index">

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
            // ['class' => 'kartik\grid\SerialColumn'],
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
            // 'type',
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    return \common\models\c2\statics\GRPType::getData($model->type, 'label');
                }
            ],
            // 'attributeset_id',
            // 'province_id',
            // 'city_id',
            // 'district_id',
            'code',
            'seo_code',
            'label',
            // 'geo_longitude',
            // 'geo_latitude',
            // 'geo_marker_color',
            // 'created_by',
            [
                'attribute' => 'created_by',
                'value' => function ($model, $key, $index, $column) {
                    return $model->creator->profile->fullname;
                },
            ],
            // 'updated_by',
            [
                'attribute' => 'updated_by',
                'value' => function ($model, $key, $index, $column) {
                    return $model->updater->profile->fullname;
                },
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
                // 'width' => '200px',
                'template' => '{update} {chart} {edit-member}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['edit', 'id' => $model->id], [
                            'title' => Yii::t('app.c2', 'Update'),
                            'data-pjax' => '0',
                        ]);
                    },
                    'chart' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-tree-deciduous"></span>', [
                            '/crm/grp/grp-station/default/edit-with-chart',
                            // 'id' => $model->id,
                            'grp_id' => $model->id
                        ], [
                            'title' => Yii::t('app.c2', 'GRP Chart'),
                            'data-pjax' => '0',
                        ]);
                    },
                    'edit-member' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-user"></span>', [
                            '/crm/grp/grp-station-item/default/edit-with-chart',
                            'grp_id' => $model->id
                        ], [
                            'title' => Yii::t('app.c2', 'GRP Chart Member'),
                            'data-pjax' => '0',
                        ]);
                    },
                ]
            ],
            [
                'class' => '\common\widgets\grid\ActionColumn',
                'width' => '200px',
                'template' => '{create-branch} {edit-branch-member}',
                'visibleButtons' => [
                    'edit-branch-member' => function ($model) {
                        return ($model->type == \common\models\c2\statics\GRPType::TYPE_BRANCH);
                    },
                ],
                'buttons' => [
                    'create-branch' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-leaf">' . Yii::t('app.c2', 'Create GRP Branch') . '</span>', [
                            'create-branch',
                            'parent_id' => $model->id
                        ], [
                            'title' => Yii::t('app.c2', 'Create GRP Branch'),
                            'data-pjax' => '0',
                        ]);
                    },
                    'edit-branch-member' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-user">'.Yii::t('app.c2', 'Assign Member').'</span>', [
                            '/crm/grp/grp-station-item/default/edit-branch-with-chart',
                            'grp_id' => $model->id
                        ], [
                            'title' => Yii::t('app.c2', 'GRP Chart Member'),
                            'data-pjax' => '0',
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>

</div>