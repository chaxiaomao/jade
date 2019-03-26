<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
$directoryAsset = \Yii::$app->czaHelper->getEnvData('AdminlteAssets');
?>

<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= \Yii::$app->user->avatarUrl ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= \Yii::$app->user->username ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> <?= Yii::t('app.c2', 'Online') ?></a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="<?= Yii::t('app.c2', 'Search...') ?>"/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <?=
        cza\base\widgets\ui\common\menu\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu', "data-widget" => "tree"],
                    'linkTemplate' => '<a href="{url}" {targetPlaceHolder}>{icon} {label}</a>',
                    'items' => [
                        ['label' => Yii::t('app.c2', 'Menu'), 'options' => ['class' => 'header']],
                        ['label' => Yii::t('app.c2', 'Dashboard'), 'icon' => 'fa fa-circle-o', 'url' => ['/']],
                        [
                            'label' => Yii::t('app.c2', 'Workspace'), 'visible' => \Yii::$app->user->can('P_WORKSPACE'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                            'items' => [
                                ['label' => Yii::t('app.c2', 'My Customers'), 'icon' => 'fa fa-circle-o', 'url' => ['/workspace/my-customers'],],
                                ['label' => Yii::t('app.c2', 'Intention Forms'), 'icon' => 'fa fa-circle-o', 'url' => ['/workspace/intention-forms'],],
                                ['label' => Yii::t('app.c2', 'Quotations'), 'icon' => 'fa fa-circle-o', 'url' => ['/workspace/quotations'],],
                                ['label' => Yii::t('app.c2', 'Report'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                    'items' => [
                                        ['label' => Yii::t('app.c2', 'Research Forms'), 'icon' => 'fa fa-circle-o', 'url' => ['/workspace/report/research-form'],]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'label' => Yii::t('app.c2', 'CRM'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                            'items' => [
                                ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Lord')]), 'icon' => 'fa fa-circle-o', 'url' => ['/crm/lord']],
                            ]
                        ],
                        [
                            'label' => Yii::t('app.c2', 'Logistics'), 'visible' => \Yii::$app->user->can('P_Logistics'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                            'items' => [
                                ['label' => Yii::t('app.c2', 'Region'), 'icon' => 'fa fa-circle-o', 'url' => ['/logistics/region']],
                            ]
                        ],
                        [
                            'label' => Yii::t('app.c2', 'System'), 'visible' => \Yii::$app->user->can('P_System'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                            'items' => [
                                ['label' => Yii::t('app.c2', 'Configuration'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                    'items' => [
                                        ['label' => Yii::t('app.c2', 'Merchant Management'), 'icon' => 'fa fa-circle-o', 'url' => ['/crm/merchant'],],
                                        ['label' => Yii::t('app.c2', 'Params Settings'), 'icon' => 'fa fa-circle-o', 'url' => ['/sys/config/default/params-settings']],
                                        ['label' => Yii::t('app.c2', 'Common Resource'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                            'items' => [
                                                ['label' => Yii::t('app.c2', 'Attachement Management'), 'icon' => 'fa fa-circle-o', 'url' => ['/sys/common-resource/attachment'],],
                                                ['label' => Yii::t('app.c2', 'Global Settings'), 'icon' => 'fa fa-circle-o', 'url' => ['/sys/config']],
                                            ]
                                        ],
                                        ['label' => Yii::t('app.c2', 'Transfer Settings'), 'icon' => 'fa fa-circle-o', 'url' => ['/sys/config/default/transfer-settings']],
                                        ['label' => Yii::t('app.c2', 'Api'), 'icon' => 'fa fa-circle-o', 'url' => ['/api']],
                                    ]
                                ],
                                ['label' => Yii::t('app.c2', 'Security'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                    'items' => [
                                        ['label' => Yii::t('app.c2', 'Users & Rbac'), 'icon' => 'fa fa-circle-o', 'url' => ['/user/admin']],
                                    ]
                                ],
//                            ['label' => Yii::t('app.c2', 'Task Manage'), 'icon' => 'fa fa-circle-o', 'url' => ['/task/cron']],
                            ]
                        ],
                        ['label' => Yii::t('app.c2', 'Sign out'), 'icon' => 'fa fa-sign-out', 'url' => ['/user/logout']],
                    ],
                ]
        )
        ?>

    </section>

</aside>
