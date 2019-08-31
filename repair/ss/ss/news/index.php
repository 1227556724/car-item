<?php
include "../common.php";
?>
<style>
    #addNews{
        padding-top:30px;
        display:none;
    }
    #editNews{
        padding-top:30px;
        display:none;
    }
    .layui-input{
        width:80%;
    }
    .layui-textarea{
        width:80%;
        min-height:150px;
    }
</style>

<div class="layui-body">
    <div style="padding: 15px;">
        <button type="button" class="layui-btn add">添加新闻资讯</button>
        <table id="newsDemo" lay-filter="test"></table>
        <script type="text/html" id="caozuo">
            <button type="button" class="layui-btn layui-btn-sm" onclick="edits({{d.id}})">编辑</button>
            <button type="button" class="layui-btn layui-btn-sm layui-btn-danger" onclick="dels({{d.id}})">删除</button>
        </script>

    </div>
</div>

<!--添加-->
<form action="" class="layui-form" id="addNews" lay-filter="addtest1">
    <div class="layui-form-item">
        <label class="layui-form-label" for="title">主题</label>
        <div class="layui-input-block inputs">
            <input type="text" name="title" required  lay-verify="required" placeholder="请输入主题" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label" for="content">内容</label>
        <div class="layui-input-block">
            <textarea name="content" placeholder="请输入详细内容" required class="layui-textarea"></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="submit" class="layui-btn" lay-submit lay-filter="addDemo">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>

<form action="" class="layui-form" id="editNews" lay-filter="addtest1">
    <input type="hidden" id="newsId" name="id">
    <div class="layui-form-item">
        <label class="layui-form-label" for="title">主题</label>
        <div class="layui-input-block inputs">
            <input type="text" name="title" id="title" required  lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label" for="content">内容</label>
        <div class="layui-input-block">
            <textarea name="content" id="content" required class="layui-textarea"></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="submit" class="layui-btn" lay-submit lay-filter="editDemo">立即修改</button>
            <button type="button" class="layui-btn layui-btn-primary" id="cancel">取消</button>
        </div>
    </div>
</form>

<?php
include "../footer.php";
?>

<script>

    var table,layer,form;
    layui.use(['element','jquery','table','form','layer'],function(){
        var element = layui.element;
        var $ =layui.jquery;
        layer = layui.layer;
        table = layui.table;
        form = layui.form;


        $(".news").parent().addClass("layui-this");
        $(".news").parents("li").addClass("layui-nav-itemed");

        // 表格数据渲染
        table.render({
            elem: '#newsDemo',
            url: 'action.php?type=find',
            page: true,
            limit: 5,
            limits:[5,10,15,20],
            cols: [[
                {field:'id',title:'ID',width:50},
                {field:'title',title:'主题',width:280},
                {field:'date',title:'日期',width:120},
                {field:'time',title:'时间',width:100},
                {field:'content',title:'内容'},
                {title:'操作',templet:'#caozuo',width:150}
            ]]
        });

        // 点击添加
        let index;
        $(".add").click(function () {
            index=layer.open({
                type:1,
                title:'添加新闻资讯',
                skin:'layui-layer-molv',
                area:['500px','400px'],
                content:$('#addNews')
            })
        });
        //添加 => 立即提交
        form.on('submit(addDemo)',function(data){
            // console.log(data.field);
            $.get("action.php?type=add",data.field,function(res){
                let datas=JSON.parse(res);
                if(datas.code===200){
                    layer.msg(datas.msg,{icon:1,time:500});
                    layer.close(index);
                    table.reload('newsDemo',{
                        url: 'action.php?type=find'
                    })
                }else{
                    layer.msg(datas.msg,{icon:2,time:1000});
                }
            });
            return false;
        });
        // 编辑 => 立即修改
        form.on('submit(editDemo)',function(data){
            console.log(data.field);
            $.get("action.php?type=update",data.field,function(res){
                let datas=JSON.parse(res);
                if(datas.code===200){
                    layer.msg(datas.msg,{icon:1,time:500});
                    layer.close(indexEdit);
                    table.reload('newsDemo',{
                        url: 'action.php?type=find'
                    })
                }else{
                    layer.msg(datas.msg,{icon:2,time:1000});
                }
            });
            return false;
        });
        // 编辑 => 取消
        $("#cancel").click(function(){
            layer.close(indexEdit);
        });
    });

    // 删除操作
    function dels(id){
        layer.confirm('您确定要删除吗？', {
            title:'删除',
            skin:'layui-layer-molv',
            btn: ['确定','取消'] //按钮
        }, function(){
            $.get('action.php?type=delete',{id:id},function(res){
                let data=JSON.parse(res);
                if(data.code===200){
                    layer.close();
                    layer.msg(data.msg,{icon:6,time:800});
                    table.reload('newsDemo',{
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

    // 修改操作
    let indexEdit;
    function edits(id){
        indexEdit=layer.open({
            type:1,
            title:'修改新闻资讯',
            skin:'layui-layer-molv',
            area:['500px','400px'],
            content:$('#editNews')
        });
        $.get('action.php?type=select',{id:id},function(res){
            let datas=JSON.parse(res);
            // console.log(datas);
            $("#newsId").val(datas.id);
            $("#title").val(datas.title);
            $("#content").val(datas.content);
        });
    }

</script>