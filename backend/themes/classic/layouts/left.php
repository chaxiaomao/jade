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
                            'label' => Yii::t('app.c2', 'EShop'), 'visible' => \Yii::$app->user->can('P_EShop'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                            'items' => [
                                ['label' => Yii::t('app.c2', 'Products Management'), 'visible' => \Yii::$app->user->can('P_ESHOP_PRODUCT_MANAGE'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                    'items' => [
                                        ['label' => Yii::t('app.c2', 'Product'), 'visible' => \Yii::$app->user->can('P_ESHOP_PRODUCT_MANAGE'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/product']],
                                        ['label' => Yii::t('app.c2', '{s1} Category', ['s1' => Yii::t('app.c2', 'Product')]), 'visible' => \Yii::$app->user->can('P_ESHOP_PRODUCT_MANAGE'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/product-category'],],
                                        ['label' => Yii::t('app.c2', 'Product Attributes'), 'visible' => \Yii::$app->user->can('P_ESHOP_PRODUCT_MANAGE'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                            'items' => [
                                                ['label' => Yii::t('app.c2', 'Attribute'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/attribute']],
                                                ['label' => Yii::t('app.c2', 'Attributeset'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/attributeset']],
                                            ]
                                        ],
                                        ['label' => Yii::t('app.c2', 'Product Promotion'), 'visible' => (\Yii::$app->user->can('P_ESHOP_MARKETING') || \Yii::$app->user->can('P_ESHOP_PRODUCT_MANAGE')), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/product/promotion']],
                                        ['label' => Yii::t('app.c2', 'Product VR'), 'visible' => \Yii::$app->user->can('P_ESHOP_MARKETING'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/product/productvr']],
                                        ['label' => Yii::t('app.c2', '{s1}', ['s1' => Yii::t('app.c2', 'Brands Manager')]), 'visible' => \Yii::$app->user->can('P_ESHOP_MARKETING'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/brand'],],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Product Comment')]), 'visible' => \Yii::$app->user->can('P_ESHOP_MARKETING'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/comment'],],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Product Collect')]), 'visible' => \Yii::$app->user->can('P_ESHOP_MARKETING'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/product/wish-list'],],
                                    ]
                                ],
                                ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Sales Order')]), 'visible' => \Yii::$app->user->can('P_ESHOP_MARKETING'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                    'items' => [
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Sales Order')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/salesorder/default']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Refund Order')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/refundorder/default']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Invoice')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/invoice'],],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Cart')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/cart'],],
                                    ]
                                ],
//                                ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Service')]), 'visible' => \Yii::$app->user->can('P_ESHOP_MARKETING'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
//                                    'items' => [
//                                        ['label' => Yii::t('app.c2', 'Service Type'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/service']],
//                                        ['label' => Yii::t('app.c2', 'Service Order'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/serviceorder']],
//                                    ]
//                                ],
                                ['label' => Yii::t('app.c2', 'Custom Service'), 'visible' => \Yii::$app->user->can('P_ESHOP_MARKETING'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                    'items' => [
                                        ['label' => Yii::t('app.c2', 'Intention Forms'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/custom-service/intention-forms']],
                                        ['label' => Yii::t('app.c2', 'Customer Consume Group'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                            'items' => [
                                                ['label' => Yii::t('app.c2', 'CcGroupBargain'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/custom-service/bargain']],
                                                ['label' => Yii::t('app.c2', 'CcGroupTeamBuying'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/custom-service/team-buying']],
                                            ]
                                        ],
                                        ['label' => Yii::t('app.c2', 'Customer Allowance Forms'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/custom-service/allowance-form']]
                                    ]
                                ],
                                ['label' => Yii::t('app.c2', 'Marketing'), 'visible' => \Yii::$app->user->can('P_ESHOP_MARKETING'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                    'items' => [
                                        ['label' => Yii::t('app.c2', 'Sales Activity'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/marketing/sales-activity']],
                                        ['label' => Yii::t('app.c2', 'Coupons'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/marketing/coupon']],
                                        ['label' => Yii::t('app.c2', 'Sales Policy'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/marketing/sales-policy']],
                                        ['label' => Yii::t('app.c2', 'Coupon Retrieve Rule'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/marketing/coupon-retrieve-rule']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'User Coupons')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/marketing/eshop-user-coupons']],
                                        ['label' => Yii::t('app.c2', 'Questionnaire'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                            'items' => [
                                                ['label' => Yii::t('app.c2', 'PurchaseIntentionForm'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/marketing/questionnaire/purchase-intention-form']],
                                            ]
                                        ],
                                    ]
                                ],
                                ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Platform')]), 'visible' => \Yii::$app->user->can('P_ESHOP_MARKETING'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                    'items' => [
                                        ['label' => Yii::t('app.c2', 'Platform Cash Record'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/platform']],
                                        ['label' => Yii::t('app.c2', 'Cash Apply'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/cashapply']],
                                    ]
                                ],
                                ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'User')]), 'visible' => \Yii::$app->user->can('P_ESHOP_USER'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                    'items' => [
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Account')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/useraccount/account']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'User Cash Record')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/useraccount/cash-record']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Eshop User Score Record')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/useraccount/score-record']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Coupon')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/useraccount/coupon']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Coupon Record')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/useraccount/coupon-record']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'User Commission Record')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/useraccount/commission-record']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Share Record')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/useraccount/share-record']],
                                    ]
                                ],
                                ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Message')]), 'visible' => \Yii::$app->user->can('P_ESHOP_MARKETING'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                    'items' => [
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Message')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/message/default']],
                                    ]
                                ],
                                ['label' => Yii::t('app.c2', 'Biz-Monitoring'), 'visible' => \Yii::$app->user->can('P_BIZ_MONITORING'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                    'items' => [
                                        ['label' => Yii::t('app.c2', 'Research Forms'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/biz-monitoring/research-form']],
                                      
                                    ]
                                ],
                                ['label' => Yii::t('app.c2', 'Config'), 'visible' => \Yii::$app->user->can('P_ESHOP_CONFIG_MANAGE'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                    'items' => [
                                        ['label' => Yii::t('app.c2', 'Params Setting'), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/config']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'EShops')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/eshop']],
//                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Supplier')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/supplier']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Currency')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/currency']],
//                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Measure')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/measure']],
//                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Warehouse')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/warehouse/default']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'PaymentMethod')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/platform/payment-method']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'ShippingMethod')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/platform/shipping-method']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Eshop Score Level')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/score-level']],
                                    ]
                                ],
                            ]
                        ],
                        [
                            'label' => Yii::t('app.c2', 'CRM'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                            'visible' => \Yii::$app->user->can('P_CRM'),
                            'items' => [
                                ['label' => Yii::t('app.c2', 'Events Management'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'], 'items' => [
                                        ['label' => Yii::t('app.c2', 'Distributor Join Apply'), 'icon' => 'fa fa-circle-o', 'url' => ['/crm/events/distributor-join']],
                                        ['label' => Yii::t('app.c2', 'BizManager Join Apply'), 'icon' => 'fa fa-circle-o', 'url' => ['/crm/events/biz-manager-join']],
                                        ['label' => Yii::t('app.c2', 'Franchisee Join Apply'), 'icon' => 'fa fa-circle-o', 'url' => ['/crm/events/franchisee-join']],
                                        ['label' => Yii::t('app.c2', 'Franchisee Unlink Apply'), 'icon' => 'fa fa-circle-o', 'url' => ['/crm/events/franchisee-unlink']],
                                        ['label' => Yii::t('app.c2', 'Shop Join Apply'), 'icon' => 'fa fa-circle-o', 'url' => ['/crm/events/shop-join']],
                                    ]],
                                ['label' => Yii::t('app.c2', 'Distributor Management'), 'icon' => 'fa fa-circle-o', 'url' => ['/crm/distributor']],
                                ['label' => Yii::t('app.c2', 'Franchisee Management'), 'icon' => 'fa fa-circle-o', 'url' => ['/crm/franchisee'],],
                                ['label' => Yii::t('app.c2', 'Shops Management'), 'icon' => 'fa fa-circle-o', 'url' => ['/crm/shops'],],
                                ['label' => Yii::t('app.c2', 'Salesman Management'), 'icon' => 'fa fa-circle-o', 'url' => ['/crm/salesman'],],
                                ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'BizManager')]), 'icon' => 'fa fa-circle-o', 'url' => ['/crm/bizmanager'],],
                                ['label' => Yii::t('app.c2', 'Customer Management'), 'icon' => 'fa fa-circle-o', 'url' => ['/crm/customer'],],
                                ['label' => Yii::t('app.c2', 'Worker Management'), 'icon' => 'fa fa-circle-o', 'url' => ['/crm/worker'],],
                                ['label' => Yii::t('app.c2', 'Customer Feedback'), 'icon' => 'fa fa-circle-o', 'url' => ['/crm/feedback'],],
                            ]
                        ],
//                        [
//                            'label' => Yii::t('app.c2', 'Sales'), 'visible' => \Yii::$app->user->can('P_Sales'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
//                            'items' => [
//                                ['label' => Yii::t('app.c2', 'Consume Query'), 'icon' => 'fa fa-circle-o', 'url' => ['/sales/consume']],
//                                ['label' => Yii::t('app.c2', 'Commission Record'), 'icon' => 'fa fa-circle-o', 'url' => ['/sales/commission']],
//                            ]
//                        ],
//                        [
//                            'label' => Yii::t('app.c2', 'Activity'), 'visible' => \Yii::$app->user->can('P_ESHOP_MARKETING'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
//                            'items' => [
//                                ['label' => Yii::t('app.c2', 'Activity'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
//                                    'items' => [
//                                        ['label' => Yii::t('app.c2', 'BonusActivity'), 'icon' => 'fa fa-circle-o', 'url' => ['/activity/bonus']],
//                                        ['label' => Yii::t('app.c2', 'GameActivity'), 'icon' => 'fa fa-circle-o', 'url' => ['/activity/game']],
//                                    ]
//                                ],
//                                ['label' => Yii::t('app.c2', 'Prize'), 'icon' => 'fa fa-circle-o', 'url' => ['/activity/prize']],
//                                ['label' => Yii::t('app.c2', 'User Record Address', ['s1' => Yii::t('app.c2', 'Topic')]), 'icon' => 'fa fa-circle-o', 'url' => ['/activity/record']],
//                                ['label' => Yii::t('app.c2', 'User Record', ['s1' => Yii::t('app.c2', 'Topic')]), 'icon' => 'fa fa-circle-o', 'url' => ['/activity/record/record']],
//                            ]
//                        ],
                        [
                            'label' => Yii::t('app.c2', 'Purchase Sale Storage System'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                            'visible' => \Yii::$app->user->can('P_P3S'),
                            'items' => [
                                ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Inventory')]), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                    'items' => [
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Inventory Receipt Notes')]), 'icon' => 'fa fa-circle-o', 'url' => ['/p3s/inventory/receipt-note']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Inventory Delivery Notes')]), 'icon' => 'fa fa-circle-o', 'url' => ['/p3s/inventory/delivery-note']],
                                        ['label' => Yii::t('app.c2', 'Product Stock'), 'icon' => 'fa fa-circle-o', 'url' => ['/p3s/inventory/stock']],
                                        ['label' => Yii::t('app.c2', 'Logs'), 'icon' => 'fa fa-circle-o', 'url' => ['/p3s/inventory/logs']],
                                    ]
                                ],
                                ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Finance')]), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'], 'items' => [
                                    ]],
                                ['label' => Yii::t('app.c2', 'Config'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                    'items' => [
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Warehouse')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/warehouse/default']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Supplier')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/supplier']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Measure')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/measure']],
                                    ]
                                ],
                            ]
                        ],
                        [
                            'label' => Yii::t('app.c2', 'CMS'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                            'visible' => \Yii::$app->user->can('P_CMS'),
                            'items' => [
                                ['label' => Yii::t('app.c2', 'Cms Page Management'), 'icon' => 'fa fa-circle-o', 'url' => ['/cms/page'],],
                                ['label' => Yii::t('app.c2', 'Cms Block Management'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'], 'items' => [
                                        ['label' => Yii::t('app.c2', 'Cms GenericBlock'), 'icon' => 'fa fa-circle-o', 'url' => ['/cms/block/default']],
                                        ['label' => Yii::t('app.c2', 'Cms AlbumBlock'), 'icon' => 'fa fa-circle-o', 'url' => ['/cms/block/album-block']],
                                    ]],
                                ['label' => Yii::t('app.c2', 'Label Management'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'], 'items' => [
                                        ['label' => Yii::t('app.c2', 'Label Collection'), 'icon' => 'fa fa-circle-o', 'url' => ['/cms/label/collection/default']],
                                    ]],
                                ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Article')]), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                    'items' => [
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Topic Article')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/article/topic-article']],
                                        ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Topic')]), 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/article/topic']],
                                    ]
                                ],
                                ['label' => Yii::t('app.c2', 'Cms Case'), 'icon' => 'fa fa-circle-o', 'url' => ['/cms/cases'],],
                            ]
                        ],
//                        [
//                            'label' => Yii::t('app.c2', 'Promotion'), 'visible' => \Yii::$app->user->can('P_Promotion'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
//                            'items' => [
//                                ['label' => Yii::t('app.c2', 'Wechat'), 'icon' => 'fa fa-circle-o', 'url' => ['/promotion/wechat'], 'items' => [
//                                        ['label' => Yii::t('app.c2', 'Media Info'), 'icon' => 'fa fa-circle-o', 'url' => ['/promotion/wechat/material-info']],
//                                        ['label' => Yii::t('app.c2', 'Template Info'), 'icon' => 'fa fa-circle-o', 'url' => ['/promotion/wechat/tpl-info']],
//                                    ]],
//                            ]
//                        ],
//                        [
//                            'label' => Yii::t('app.c2', 'Statistics'), 'visible' => \Yii::$app->user->can('P_Statistics'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
//                            'items' => [
//                                ['label' => Yii::t('app.c2', 'Shops'), 'icon' => 'fa fa-circle-o', 'url' => ['/statistics/shops']],
//                                ['label' => Yii::t('app.c2', 'Salesmans'), 'icon' => 'fa fa-circle-o', 'url' => ['/statistics/salesmans']],
//                                ['label' => Yii::t('app.c2', 'Customer Statistics'), 'icon' => 'fa fa-circle-o', 'url' => ['/statistics/customers']],
//                                ['label' => Yii::t('app.c2', 'Consumption'), 'icon' => 'fa fa-circle-o', 'url' => ['/statistics/consumption']],
//                                ['label' => Yii::t('app.c2', 'Distributor'), 'icon' => 'fa fa-circle-o', 'url' => ['/statistics/distributor']],
//                                ['label' => Yii::t('app.c2', 'Franchisee'), 'icon' => 'fa fa-circle-o', 'url' => ['/statistics/franchisee']],
//                                ['label' => Yii::t('app.c2', 'BizManager Warning'), 'icon' => 'fa fa-circle-o', 'url' => ['/statistics/bizmanager/warning/index']],
//                                [
//                                    'label' => Yii::t('app.c2', 'Report'), 'visible' => \Yii::$app->user->can('P_Statistics'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
//                                    'items' => [
//                                        ['label' => Yii::t('app.c2', 'Distributor'), 'icon' => 'fa fa-circle-o', 'url' => ['/report/distributor']],
//                                        ['label' => Yii::t('app.c2', 'Franchisee'), 'icon' => 'fa fa-circle-o', 'url' => ['/report/franchisee']],
//                                        ['label' => Yii::t('app.c2', 'Shops'), 'icon' => 'fa fa-circle-o', 'url' => ['/report/shops']],
//                                        ['label' => Yii::t('app.c2', 'Salesman'), 'icon' => 'fa fa-circle-o', 'url' => ['/report/salesman']],
//                                    ]
//                                ],
//                            ]
//                        ],
//                        [
//                            'label' => Yii::t('app.c2', 'Ranking'), 'visible' => \Yii::$app->user->can('P_Ranking'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
//                            'items' => [
//                                ['label' => Yii::t('app.c2', 'Distributor Ranking'), 'icon' => 'fa fa-circle-o', 'url' => ['/ranking/distributor']],
//                            ]
//                        ],
                        [
                            'label' => Yii::t('app.c2', 'Logistics'), 'visible' => \Yii::$app->user->can('P_Logistics'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                            'items' => [
                                ['label' => Yii::t('app.c2', 'Region'), 'icon' => 'fa fa-circle-o', 'url' => ['/logistics/region']],
                            ]
                        ],
                        [
                            'label' => Yii::t('app.c2', 'SEO'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                            'visible' => \Yii::$app->user->can('P_SEO'),
                            'items' => [
                                ['label' => Yii::t('app.c2', 'Url Rule Manange'), 'icon' => 'fa fa-circle-o', 'url' => ['/seo/url-rule']],
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
