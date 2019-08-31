<?php
include "../common.php";
?>

<div class="layui-body">
    <div style="padding: 15px;">
        <table id="goodsDemo" lay-filter="test"></table>
        <script type="text/html" id="caozuo">
            <button type="button" class="layui-btn layui-btn-sm">编辑</button>
            <button type="button" class="layui-btn layui-btn-sm layui-btn-danger" onclick="dels({{d.id}})">删除</button>
        </script>

    </div>
</div>

<?php
include "../footer.php";
?>

<script>

    var table,layer;
    layui.use(['element','jquery','table','layer'],function() {
        var element = layui.element;
        var $ = layui.jquery;
        layer = layui.layer;
        table = layui.table;


        $(".goodsSee").parent().addClass("layui-this");
        $(".goodsSee").parents("li").addClass("layui-nav-itemed");

        // 表格数据渲染
        table.render({
            elem: '#goodsDemo',
            url: 'action.php?type=find',
            page: true,
            limit: 5,
            limits: [5, 10, 15, 20],
            cols: [[
                {field: 'id', title: 'ID',width:50},
                {field: 'name', title: '产品名称'},
                {field: 'typeid', title: '产品分类'},
                {field: 'img1', title: '图片1'},
                {field: 'img2', title: '图片2'},
                {field: 'market_price', title: '市场价'},
                {field: 'price', title: '零售价'},
                {field: 'content', title: '内容'},
                {title: '操作', templet: '#caozuo', width: 150}
            ]]
        });
    });

    // 删除操作
    function dels(id){
        layer.confirm('您确定要删除该产品吗？', {
            title:'删除',
            skin:'layui-layer-molv',
            btn: ['确定','取消'] //按钮
        }, function(){
            $.get('action.php?type=delete',{id:id},function(res){
                let data=JSON.parse(res);
                if(data.code===200){
                    layer.close();
                    layer.msg(data.msg,{icon:6,time:800});
                    table.reload('goodsDemo',{
                        url:'action.php?type=find'
                    })
                }else{
                    layer.msg(data.msg,{icon:5,time:1000})
                }
            });
        }, function(){
            layer.close();
        });
    }

</script>