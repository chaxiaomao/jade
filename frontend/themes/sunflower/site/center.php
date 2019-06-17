<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/22
 * Time: 17:11
 */

use yii\helpers\Html;
\frontend\assets\ChartAsset::register($this);
// $assets = \frontend\assets\AppAsset::register($this);
// $this->registerCssFile("{$assets->baseUrl}/org_chart/css/font-awesome.min.css");
// $this->registerCssFile("{$assets->baseUrl}/org_chart/css/jquery.orgchart.css");
// $this->registerCssFile("{$assets->baseUrl}/org_chart/css/style.css");
// $this->registerJsFile("{$assets->baseUrl}/org_chart/js/html2canvas.min.js");
// $this->registerJsFile("{$assets->baseUrl}/org_chart/js/jquery.orgchart.js");

$this->title = Yii::t('app.c2', 'Profile center');
?>
<div class="container-fluid">
    <div class="">
        <h2><?= $grpModel->label ?><?= Yii::t('app.c2', 'GRP Station') ?><a href="/"
                                                                            class="btn btn-link"><?= Yii::t('app.c2', 'Change') ?></a>
        </h2>
        <p><?= Yii::t('app.c2', 'Code Num') . ":" . $grpModel->code ?></p>
    </div>

    <div id="chart-container"></div>

    <div class="list-group">
        <?php if ($type == \common\models\c2\statics\GRPStationType::TYPE_C1
            || $type == \common\models\c2\statics\GRPStationType::TYPE_C2
            || $type == \common\models\c2\statics\GRPStationType::TYPE_C3): ?>
        <?php else: ?>
            <?= Html::a(Yii::t('app.c2', 'My Kpi'), ['/user/kpi'], ['class' => 'list-group-item']) ?>
        <?php endif; ?>
        <?= Html::a(Yii::t('app.c2', 'My Profit'), ['/user/profit'], ['class' => 'list-group-item']) ?>
    </div>

    <?= Html::beginForm(['/user/logout'], 'post') ?>
    <?= Html::submitButton(Yii::t('app.c2', 'Logout') . Yii::$app->user->currentUser->username, [
        'class' => 'btn btn-danger btn-block mb10'
    ]) ?>
    <?= Html::endForm() ?>

</div>


<script type="text/javascript">
    // JQuery.notConfit();
    $(function ($) {

        var datascource = <?= $grpModel->getGRPStationJson(['withMember' => true]) ?>

        // var nodeTemplate = function (data) {
        //     var tag = `<div class="title" data-id="${data.id}" data-type="${data.type}">${data.name}</div>`;
        //     tag += `<div class="warpper">`;
        //     if (data.userList) {
        //         data.userList.map(function (item) {
        //             tag += `<p>${item.name}</p>`
        //         })
        //     }
        //     tag += '</div>';
        //     return tag;
        // };

        var nodeTemplate = function (data) {
            var tag = `<div class="title" data-id="${data.id}" data-type="${data.type}">${data.name}</div>`;
            tag += `<div class="warpper">`;
            if (data.memberList) {
                data.memberList.map(function (item) {
                    tag += `<p>${item.user.username}</p>`
                    if (item.user.invite_username != null) {
                        tag += `<p style="color:#199475">推荐人:${item.user.invite_username}</p>`
                    }
                })
            }
            tag += '</div>';
            return tag;
        };

        var oc = $('#chart-container').orgchart({
            'data': datascource,
            'chartClass': 'edit-state',
            'exportButton': false,
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

        // oc.$chartContainer.on('click', '.node', function () {
        //
        // });

        // oc.$chartContainer.on('click', '.orgchart', function (event) {
        //     if (!$(event.target).closest('.node').length) {
        //         $('#selected-node').val('');
        //     }
        // });

    });
</script>