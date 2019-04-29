<?php

use cza\base\widgets\ui\common\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use cza\base\models\statics\EntityModelStatus;
use cza\base\models\statics\OperationEvent;

/* @var $this yii\web\View */
/* @var $searchModel common\models\c2\search\UserChessRsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app.c2', 'User Chess Rs Models');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="well user-chess-rs-model-index">

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
                    Html::a('<i class="glyphicon glyphicon-plus">' . Yii::t('app.c2', '{s1} add', ['s1' => Yii::t('app.c2', 'Lord')]) . '</i>', ['edit-lord', 'chess_id' => $searchModel->chess_id], [
                        'class' => 'btn btn-success',
                        'title' => Yii::t('app.c2', 'Add'),
                        'data-pjax' => '0',
                    ]) . ' ' .
                    // Html::a('<i class="glyphicon glyphicon-plus">' . Yii::t('app.c2', '{s1} add', ['s1' => Yii::t('app.c2', 'Elder')]) . '</i>',
                    //     ['edit', 'chess_id' => $searchModel->chess_id, 'type' => \common\models\c2\statics\FeUserType::TYPE_ELDER], [
                    //         'class' => 'btn btn-success',
                    //         'title' => Yii::t('app.c2', 'Add'),
                    //         'data-pjax' => '0',
                    //     ]) . ' ' .
                    // Html::a('<i class="glyphicon glyphicon-plus">' . Yii::t('app.c2', '{s1} add', ['s1' => Yii::t('app.c2', 'Chieftain')]) . '</i>',
                    //     ['edit', 'chess_id' => $searchModel->chess_id, 'type' => \common\models\c2\statics\FeUserType::TYPE_CHIEFTAIN], [
                    //         'class' => 'btn btn-success',
                    //         'title' => Yii::t('app.c2', 'Add'),
                    //         'data-pjax' => '0',
                    //     ]) . ' ' .
                    // Html::a('<i class="glyphicon glyphicon-plus">' . Yii::t('app.c2', '{s1} add', ['s1' => Yii::t('app.c2', 'Master')]) . '</i>',
                    //     ['edit', 'chess_id' => $searchModel->chess_id, 'type' => \common\models\c2\statics\FeUserType::TYPE_MASTER], [
                    //         'class' => 'btn btn-success',
                    //         'title' => Yii::t('app.c2', 'Add'),
                    //         'data-pjax' => '0',
                    //     ]) . ' ' .
                    // Html::a('<i class="glyphicon glyphicon-plus">' . Yii::t('app.c2', '{s1} add', ['s1' => Yii::t('app.c2', 'Familiar')]) . '</i>',
                    //     ['edit', 'chess_id' => $searchModel->chess_id, 'type' => \common\models\c2\statics\FeUserType::TYPE_FAMILIAR], [
                    //         'class' => 'btn btn-success',
                    //         'title' => Yii::t('app.c2', 'Add'),
                    //         'data-pjax' => '0',
                    //     ]) . ' ' .
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
            'id',
            // 'user_id',
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return $model->user->username;
                }
            ],
            // 'chess_id',
            [
                'attribute' => 'chess.code',
                // 'value' => function($model) {
                //     return $model->chess->code;
                // }
            ],
            // 'type',
            [
                'attribute' => 'type',
                'filter' => \common\models\c2\statics\FeUserType::getHashMap('id', 'label'),
                'value' => function ($model) {
                    return \common\models\c2\statics\FeUserType::getData($model->type, 'label');
                }
            ],
            'state',
            // 'status',
            'position',
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
                'template' => '{update} {add_elder} {add_chieftain} {add_master} {add_familiar}',
                'visibleButtons' => [
                    'add_elder' => function ($model) {
                        return $model->type == \common\models\c2\statics\FeUserType::TYPE_LORD;
                    },
                    'add_chieftain' => function ($model) {
                        return $model->type == \common\models\c2\statics\FeUserType::TYPE_ELDER;
                    },
                    'add_master' => function ($model) {
                        return $model->type == \common\models\c2\statics\FeUserType::TYPE_CHIEFTAIN;
                    },
                    'add_familiar' => function ($model) {
                        return $model->type == \common\models\c2\statics\FeUserType::TYPE_MASTER;
                    }
                ],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            [
                                'edit',
                                'id' => $model->id,
                            ], [
                                'title' => Yii::t('app', 'Info'),
                                'data-pjax' => '0',
                            ]);
                    },
                    'add_elder' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-grain">' . Yii::t('app.c2', '{s1} add', ['s1' => Yii::t('app.c2', 'Elder')]) . '</span>',
                            [
                                'add-development',
                                'id' => $model->id,
                                'chess_id' => $model->chess_id,
                                'type' => \common\models\c2\statics\FeUserType::TYPE_ELDER
                            ], [
                                'title' => Yii::t('app', 'Add'),
                                'data-pjax' => '0',
                            ]);
                    },
                    'add_master' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-grain">' . Yii::t('app.c2', '{s1} add', ['s1' => Yii::t('app.c2', 'Master')]) . '</span>',
                            [
                                'add-development',
                                'id' => $model->id,
                                'chess_id' => $model->chess_id,
                                'type' => \common\models\c2\statics\FeUserType::TYPE_MASTER
                            ], [
                                'title' => Yii::t('app', 'Add'),
                                'data-pjax' => '0',
                            ]);
                    },
                    'add_chieftain' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-grain">' . Yii::t('app.c2', '{s1} add', ['s1' => Yii::t('app.c2', 'Chieftain')]) . '</span>',
                            [
                                'add-development',
                                'id' => $model->id,
                                'chess_id' => $model->chess_id,
                                'type' => \common\models\c2\statics\FeUserType::TYPE_CHIEFTAIN
                            ], [
                                'title' => Yii::t('app', 'Add'),
                                'data-pjax' => '0',
                            ]);
                    },
                    'add_familiar' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-grain">' . Yii::t('app.c2', '{s1} add', ['s1' => Yii::t('app.c2', 'Familiar')]) . '</span>',
                            [
                                'add-development',
                                'id' => $model->id,
                                'chess_id' => $model->chess_id,
                                'type' => \common\models\c2\statics\FeUserType::TYPE_FAMILIAR
                            ], [
                                'title' => Yii::t('app', 'Add'),
                                'data-pjax' => '0',
                            ]);
                    },
                ]
            ],

        ],
    ]); ?>

</div>
