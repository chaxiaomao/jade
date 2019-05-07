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
    <?php if (count($model) > 0): ?>
        <?php foreach ($model as $item): ?>
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img src="/images/avatar.png" class="mr-3 avatar60" alt="">
                    </a>
                </div>
                <div class="media-body">
                    <h6 class="mt-0"><?= $item->user->username ?><span
                                class="label label-info mf10"><?= $item->user->mobile_number ?></span>
                    </h6>
                    <p><?= Yii::t('app.c2', 'Register at') . "：" . $item->user->created_at ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-warning" role="alert"><?= Yii::t('app.c2', 'Data empty') ?></div>
    <?php endif; ?>

<!--    <div id="tree"></div>-->

    <table id="table1" class="layui-table" lay-filter="table1"></table>
</div>
<!-- 操作列 -->
<script type="text/html" id="oper-col">
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="edit">修改</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>

<script>

</script>

<?php
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
            layer.load(2);
            treetable.render({
                treeColIndex: 1,
                treeSpid: -1,
                treeIdName: 'id',
                treePidName: 'pid',
                treeDefaultClose: true,
                treeLinkage: false,
                elem: '#table1',
                url: 'json/data.json',
                page: false,
                cols: [[
                    {type: 'numbers'},
                    {field: 'name', title: 'name'},
                    {field: 'id', title: 'id'},
                    {field: 'sex', title: 'sex'},
                    {field: 'pid', title: 'pid'},
                    {templet: '#oper-col', title: 'oper'}
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
                layer.msg('修改' + data.id);
            }
        });
    });
// $("#tree").jqmtree({
//         title : 'Items',
//         collapsed: false,
//         data: [
//             { "id": 1, "title": "item1" },
//             { "id": 2, "title": "item1_1", "pid":1 },
//             { "id": 3, "title": "item1_2", "pid": 1 },
//             { "id": 4, "title": "item2", "pid": 0 },
//             { "id": 5, "title": "item3", "pid": 0 },
//             { "id": 6, "title": "item1_2_1", "pid": 3 }
//         ]
//     });
JS;
$this->registerJs($js);


?>
