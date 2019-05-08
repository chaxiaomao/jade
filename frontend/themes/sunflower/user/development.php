<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/9
 * Time: 10:16
 */

use yii\widgets\LinkPager;
$this->title = Yii::t('app.c2', 'My members');
$this->params['navbar'] = Yii::t('app.c2', 'Back');

$assets = \frontend\themes\sunflower\AppAsset::register($this);
// $this->registerCssFile("{$assets->baseUrl}/css/jquery.mobile-1.4.5.min.css");
// $this->registerJsFile("{$assets->baseUrl}/js/jquery-1.11.3.min.js");
// $this->registerJsFile("{$assets->baseUrl}/js/jquery.mobile-1.4.5.min.js");
// $this->registerJsFile("{$assets->baseUrl}/js/jqm-tree.js");

$this->registerCssFile("{$assets->baseUrl}/layui/css/layui.css");
$this->registerCssFile("{$assets->baseUrl}/layui/common.css");
$this->registerJsFile("{$assets->baseUrl}/layui/layui.js");
?>
<style>
    .media {
        border-bottom: 1px solid #eeeeee;
    }
</style>
<div class="container-fluid">

<!--    <div id="tree"></div>-->
    <div class="alert alert-success">
        <?= Yii::t('app.c2', 'Place the mobile horizontally for a good experience.') ?>
    </div>

    <table id="table1" class="layui-table" lay-filter="table1"></table>
</div>
<!-- 操作列 -->
<script type="text/html" id="oper-col">
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="edit">查看</a>
</script>
<!--<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>-->

<?php
$developmentRequestUrl = '/user/user-development';
$js = <<<JS

 layui.config({
        base: 'module/'
    }).extend({
        treetable: 'treetable-lay/treetable'
    }).use(['layer', 'table', 'treetable'], function () {
        var $ = layui.jquery;
        var table = layui.table;
        var layer = layui.layer;
        var treetable = layui.treetable;

        // 渲染表格
        var renderTable = function () {
            layer.load(4);
            treetable.render({
                treeColIndex: 1,
                treeSpid: -1,
                treeIdName: 'id',
                treePidName: 'pid',
                treeDefaultClose: true,
                treeLinkage: false,
                elem: '#table1',
                url: "{$developmentRequestUrl}",
                page: false,
                cols: [[
                    {type: 'numbers'},
                    {field: 'username', title: '用户名称'},
                    // {field: 'id', title: 'id'},
                    {field: 'mobile_number', title: '手机号码'},
                    // {field: 'pid', title: 'pid'},
                    {templet: '#oper-col', title: '操作'}
                ]],
                done: function () {
                    layer.closeAll('loading');
                }
            });
        };

        renderTable();

        $('#btn-expand').click(function () {
            treetable.expandAll('#table1');
        });

        $('#btn-fold').click(function () {
            treetable.foldAll('#table1');
        });

        $('#btn-refresh').click(function () {
            renderTable();
        });

        //监听工具条
        table.on('tool(table1)', function (obj) {
            var data = obj.data;
            var layEvent = obj.event;

            if (layEvent === 'del') {
                layer.msg('删除' + data.id);
            } else if (layEvent === 'edit') {
                layer.msg(data.mobile_number);
            }
        });
    });
JS;
$this->registerJs($js);


?>
