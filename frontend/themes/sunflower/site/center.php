<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/22
 * Time: 17:11
 */

$assets = \frontend\assets\AppAsset::register($this);

$this->registerCssFile("{$assets->baseUrl}/org_chart/css/font-awesome.min.css");
$this->registerCssFile("{$assets->baseUrl}/org_chart/css/jquery.orgchart.css");
$this->registerCssFile("{$assets->baseUrl}/org_chart/css/style.css");
$this->registerJsFile("{$assets->baseUrl}/org_chart/js/html2canvas.min.js");
$this->registerJsFile("{$assets->baseUrl}/org_chart/js/jquery.orgchart.js");

$this->title = Yii::t('app.c2', 'Profile center');

?>
<div class="container-fluid">
    <div class="">
        <h2><?= $model->label ?><?= Yii::t('app.c2', 'GRP Station') ?><a href="/" class="btn btn-link"><?= Yii::t('app.c2', 'Change') ?></a></h2>
        <p><?= Yii::t('app.c2', 'Code Num') . ":" . $model->code ?></p>
    </div>

    <div id="chart-container"></div>

    <div class="list-group">
        <a href="" class="list-group-item"><?= Yii::t('app.c2', 'My Kpi') ?></a>
        <a href="" class="list-group-item"><?= Yii::t('app.c2', 'My Profit') ?></a>
    </div>

</div>



<script type="text/javascript">
    // JQuery.notConfit();
    $(function ($) {

        var datascource = <?= $model->getGRPStationJson(['withMember' => true]) ?>

        var getId = function () {
            return (new Date().getTime()) * 1000 + Math.floor(Math.random() * 1001);
        };
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
                })
            }
            tag += '</div>';
            return tag;
        };

        var oc = $('#chart-container').orgchart({
            'data': datascource,
            // 'chartClass': 'edit-state',
            'exportButton': true,
            'exportFilename': 'SportsChart',
            // 'parentNodeSymbol': 'fa-th-large',
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

        oc.$chartContainer.on('click', '.node', function () {

        });

        oc.$chartContainer.on('click', '.orgchart', function (event) {
            if (!$(event.target).closest('.node').length) {
                $('#selected-node').val('');
            }
        });

    });
</script>