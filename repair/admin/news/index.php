<?php
header('Content-type:text/html;charset=utf8');
include "../commen.php";
?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../../asset/admin/layui/css/layui.css">
        <title>Document</title>
    </head>
    <style>
        table{
            text-align: center;
        }
        #addNews{
            display: none;
            margin-top: 30px;
        }
        #editNews{
            display: none;
            margin-top: 30px;
        }
        .layui-form-label {
            padding-right: 0;
            text-align: left;
            padding-left: 20px;
            width: 70px;
        }

        .layui-input-block {
            width: 70%;
            margin-left: 95px;
        }

        .submitbtn {
            margin-left: 120px;
        }

        table {
            text-align: center;
        }

        .layui-table-cell {
            text-align: center;
        }
        .layui-form-item{
            /*position:relative;*/
            margin-bottom: 28px;
        }
        label.error{
            color:red;
            position: absolute;
            bottom:-24px;
            left:0;
        }
        .addbtn{
            position:absolute;
            z-index:1000;
            top:30px;
        }
    </style>
    <body>
    <div class="layui-body">
        <div style="padding: 15px;">
            <button type="submit" class="layui-btn  addbtn">添加新闻资讯</button>
            <table id="demo" lay-filter="test" lay-data="{id: 'idTest'}"></table>

        </div>
    </div>
    <script src="../../asset/admin/jquery-3.4.1.min.js"></script>
    <script src="../../asset/admin/layui/layui.js"></script>
    <script src="../../asset/admin/jquery.validate.min.js"></script>
    <script type="text/html" id="titleTpl">

        <button type="button" class="layui-btn layui-btn-warm  layui-btn-sm" onclick="edit({{ d.id }},this)">编辑</button>
        <button type="button" class="layui-btn layui-btn-danger  layui-btn-sm" onclick="del({{ d.id }},this)">删除</button>

    </script>
    <script>
        //    初始化页面
        var $,index,layer,form,table,index2;
        layui.use(['element', 'layer', 'jquery', 'form', 'table'], function () {
            var element = layui.element;
            table = layui.table;
            layer = layui.layer;
            $ = layui.jquery;
            form = layui.form;
            table.render({
                elem: '#demo',
                url: 'action.php?type=find' ,//数据接口
                page: true ,//开启分页
                limit:5,
                limits:[5,10,15],
                toolbar:true,
                cols: [[ //表头
                    {field: 'id', title: 'ID', width:80, sort: true}
                    ,{field: 'title', title: '标题'}
                    ,{field: 'date', title: '发布日期'}
                    ,{field: 'time', title: '时间'}
                    ,{field: 'content', title: '内容'}
                    ,{title: '操作',templet:'#titleTpl'}
                ]]
            });
            $(".addbtn").click(function () {
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
                        table.reload('demo',{
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
                        table.reload('demo',{
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
        })
//    删除新闻资讯
        function del(id,obj){
            layer.confirm('您是要删除吗？', {
                title:"删除新闻资讯",
                skin: 'layui-layer-molv',
                btn: ['确定','取消'] //按钮
            }, function(){
                $.get('action.php?type=del',{id:id},function(res){
                    obj=JSON.parse(res);
                    if(obj.code===200){
                        table.reload('demo',{
                            url:'action.php?type=find'
                        })
                        layer.msg(obj.msg, {icon: 1,time:500});
                    }else{
                        layer.msg(obj.msg, {icon: 2,time:500});
                    }
                })
            }, function(){
               layer.close();
            });
        }
        function edit(id){
            index2=layer.open({
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
    <!--添加信息表单-->
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
    <!--    修改-->
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
    </body>
    </html>
<?php
include "../footer.php";
?>