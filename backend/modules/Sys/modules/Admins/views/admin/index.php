<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-user-extended
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-user-extended
 * @version 0.6.0
 */

use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\Pjax;

$this->title = \Yii::t('user', 'Manage users');
$this->params['breadcrumbs'][] = $this->title;

// Register action buttons js
$this->registerJs('
    $(document).ready(function()
    {
        $("a.btn-update").click(function() {
            var selectedId = $("#w2").yiiGridView("getSelectedRows");

            if(selectedId.length == 0) {
                alert("' . Yii::t('app.c2', "Select at least one item") . '");
            } else if(selectedId.length>1){
                alert("' . Yii::t('app.c2', "Select only 1 item") . '");
            } else {
                var url = "' . Url::to(['/user/admin/update']) . '?id="+selectedId[0];
                window.location.href= url;
            }
        });
        $("a.btn-delete").click(function() {
            var selectedId = $("#w2").yiiGridView("getSelectedRows");

            if(selectedId.length == 0) {
                alert("' . Yii::t('app.c2', "Select at least one item") . '");
            } else {
                var choose = confirm("' . Yii::t('app.c2', "Do you want delete selected items?") . '");

                if (choose == true) {
                    $.ajax({
                        type: \'POST\',
                        url : "' . Url::to(['/user/admin/delete-multiple']) . '?id="+selectedId,
                        data : {ids: selectedId},
                        success : function() {
                            $.pjax.reload({container:"#w2"});
                        }
                    });
                }
            }
        });
        $("a.btn-active").click(function() {
            var selectedId = $("#w2").yiiGridView("getSelectedRows");

            if(selectedId.length == 0) {
                alert("' . Yii::t('app.c2', "Select at least one item") . '");
            } else {
                $.ajax({
                    type: \'POST\',
                    url : "' . Url::to(['/user/admin/activemultiple']) . '?id="+selectedId,
                    data : {ids: selectedId},
                    success : function() {
                        $.pjax.reload({container:"#w2"});
                    }
                });
            }
        });
        $("a.btn-deactive").click(function() {
            var selectedId = $("#w2").yiiGridView("getSelectedRows");

            if(selectedId.length == 0) {
                alert("' . Yii::t('app.c2', "Select at least one item") . '");
            } else {
                $.ajax({
                    type: \'POST\',
                    url : "' . Url::to(['/user/admin/deactivemultiple']) . '?id="+selectedId,
                    data : {ids: selectedId},
                    success : function() {
                        $.pjax.reload({container:"#w2"});
                    }
                });
            }
        });
        $("a.btn-profile").click(function() {
            var selectedId = $("#w2").yiiGridView("getSelectedRows");

            if(selectedId.length == 0) {
                alert("' . Yii::t('app.c2', "Select at least one item") . '");
            } else if(selectedId.length>1){
                alert("' . Yii::t('app.c2', "Select only 1 item") . '");
            } else {
                var url = "' . Url::to(['/user/profile/show']) . '&id="+selectedId[0];
                window.location.href= url;
            }
        });
    });
');
?>

<h1><?= \Yii::t('user', 'Manage users') ?></h1>

<?php // echo $this->render('/_alert', [ 'module' => \Yii::$app->getModule('user'),]) ?>

<?= $this->render('/admin/_menu') ?>

<?php Pjax::begin() ?>

<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'summary' => Yii::t('app.c2', 'Showing <b>{begin, number}-{end, number}</b> of <b>{totalCount, number}</b> {totalCount, plural, one{{item}} other{{items}}}.'),

    'layout' => "{items}\n{pager}",
    'containerOptions' => ['class' => 'users-pjax-container'],
    'pjaxSettings' => [
        'neverTimeout' => true,
    ],
    'columns' => [
        [
            'class' => '\kartik\grid\CheckboxColumn'
        ],
        [
            'attribute' => 'username',
            'format' => 'html',
            'hAlign' => 'center',
            'value' => function ($model) {
                $url = urldecode(Url::toRoute(['admin/update', 'id' => $model->id]));
                return Html::a($model->username, $url);
            }
        ],
        [
            'attribute' => 'firstname',
            'label' => Yii::t('app.c2', 'Firstname'),
            'hAlign' => 'center',
            'value' => 'profile.firstname',
        ],
        [
            'attribute' => 'lastname',
            'label' => Yii::t('app.c2', 'Lastname'),
            'hAlign' => 'center',
            'value' => 'profile.lastname',
        ],
        [
            'attribute' => 'birthday',
            'label' => Yii::t('app.c2', 'Birthday'),
            'hAlign' => 'center',
            'value' => 'profile.birthday',
            'width' => '9%',
        ],
        [
            'attribute' => 'mobile_number',
            'hAlign' => 'center',
            'value' => 'mobile_number',
        ],
        [
            'attribute' => 'email',
            'format' => 'email',
            'hAlign' => 'center',
        ],
        [
            'attribute' => 'created_at',
            'filter' => DatePicker::widget([
                'model' => $searchModel,
                'attribute' => 'created_at',
                //                        'dateFormat' => 'php:Y-m-d',
                'options' => [
                    'class' => 'form-control',
                ],
            ]),
            'hAlign' => 'center',
            //                    'value' => function ($model) {
            //                return date('Y-m-d H:i:s', $model->created_at);
            //            },
        ],
        [
            'attribute' => 'last_login_at',
            'hAlign' => 'center',
            'filter' => DatePicker::widget([
                'model' => $searchModel,
                'attribute' => 'last_login_at',
                'dateFormat' => 'php:Y-m-d',
                'options' => [
                    'class' => 'form-control',
                ],
            ]),
            //         'value' => function ($model) {
            //     if (!$model->last_login_at || $model->last_login_at == 0) {
            //         return \Yii::t('app.c2', 'Never');
            //     } else if (extension_loaded('intl')) {
            //         return \Yii::t('app.c2', '{0, date, YYYY-MM-dd HH:mm}', [$model->last_login_at]);
            //     } else {
            //         return date('Y-m-d H:i:s', $model->last_login_at);
            //     }
            // },
        ],
        ['attribute' => 'last_login_ip'],
        [
            'attribute' => \Yii::t("user", "Roles"),
            'filter' => Select2::widget([
                'model' => $searchModel,
                'attribute' => 'rule',
                'data' => $searchModel->getNameList(),
                'options' => [
                    'placeholder' => \Yii::t('app.c2', 'Select role'),
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]),
            'format' => 'html',
            'hAlign' => 'center',
            'width' => '9%',
            'value' => function ($model) {
                $html = "";
                foreach ($model->getRolesHTML() as $role) {
                    $html .= $role['item_name'] . "<br>";
                }
                return $html;
            },
        ],
        [
            'header' => \Yii::t('app.c2', 'Enabled'),
            'format' => 'raw',
            'hAlign' => 'center',
            'width' => '5%',
            'value' => function ($model) {
                if ($model->isBlocked) {
                    return Html::a('<span class="glyphicon glyphicon-remove text-danger"></span>', ['block', 'id' => $model->id], [
                        'data-method' => 'post',
                        'data-confirm' => \Yii::t('user', 'Are you sure you want to unblock this user?'),
                    ]);
                } else {
                    return Html::a('<span class="glyphicon glyphicon-ok text-success">', ['block', 'id' => $model->id], [
                        'data-method' => 'post',
                        'data-confirm' => \Yii::t('user', 'Are you sure you want to block this user?'),
                    ]);
                }
            },
        ],
        [
            'header' => \Yii::t('app.c2', 'Actived'),
            'format' => 'raw',
            'hAlign' => 'center',
            'visible' => \Yii::$app->getModule('user')->enableConfirmation,
            'width' => '5%',
            'value' => function ($model) {
                if ($model->isConfirmed) {
                    return '<span class="glyphicon glyphicon-ok text-success"></span>';
                } else {
                    return Html::a('<span class="glyphicon glyphicon-remove text-danger"></span>', ['confirm', 'id' => $model->id], [
                        'data-method' => 'post',
                        'data-confirm' => \Yii::t('user', 'Are you sure you want to confirm this user?'),
                    ]);
                }
            },
        ],
        [
            'attribute' => 'id',
            'hAlign' => 'center',
            'width' => '5%',
        ],
    ],
    'responsive' => true,
    'hover' => true,
    'panel' => [
        'before' => '<span style="margin-right: 5px;">' .
            Html::a('<i class="glyphicon glyphicon-plus"></i> ' . Yii::t('app.c2', 'Create'), ['create'], ['class' => 'btn btn-new btn-success']
            ) . '</span><span style="margin-right: 5px;">' .
            Html::a('<i class="glyphicon glyphicon-pencil"></i> ' . Yii::t('app.c2', 'Update'), '#', ['class' => 'btn btn-update btn-warning']
            ) . '</span><span style="margin-right: 5px;">' .
            Html::a('<i class="glyphicon glyphicon-minus-sign"></i> ' . Yii::t('app.c2', 'Delete'), '#', ['class' => 'btn btn-delete btn-danger']
            ) . '</span><span style="float: right; margin-right: 5px;">' .
            Html::a('<i class="glyphicon glyphicon-remove"></i> ' . Yii::t('app.c2', 'Disable'), '#', ['class' => 'btn btn-deactive btn-danger']
            ) . '</span><span style="float: right; margin-right: 5px;">' .
            Html::a('<i class="glyphicon glyphicon-ok"></i> ' . Yii::t('app.c2', 'Enable'), ['#'], ['class' => 'btn btn-active btn-success']
            ) . '</span>',
        'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> ' . Yii::t('app.c2', 'Reset'), ['index'], ['class' => 'btn btn-info']
        ),
        'heading' => '<h3 class="panel-title"><i class="fa fa-user-plus"></i></h3>',
        'type' => 'success',
        'showFooter' => false
    ],
]);
?>

<?php Pjax::end() ?>
