<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/6 0006
 * Time: 上午 11:34
 */
\backend\assets\ChartAsset::register($this);
?>
<div class="container-fluid">
    <h2><?= Yii::t('app.c2', '{s1} Kpi', ['s1' => $user->username]) ?></h2>
    <div id="chart-container-kpi"></div>
</div>

<script type="text/javascript">
    // JQuery.notConfit();
    $(function ($) {

        var datascource = <?= json_encode($data) ?>

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
            var tag = `<div class="title" data-id="${data.id}">${data.name}</div>`;
            tag += `<div class="warpper">`;
            tag += '</div>';
            return tag;
        };

        var oc = $('#chart-container-kpi').orgchart({
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