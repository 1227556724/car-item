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
    #addForm{
        display: none;
        margin-top: 30px;
    }
    #editForm{
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
        <button type="submit" class="layui-btn  addbtn">添加分类</button>
        <table id="demo" lay-filter="test" lay-data="{id: 'idTest'}"></table>

    </div>
</div>
<script src="../../asset/admin/jquery-3.4.1.min.js"></script>
<script src="../../asset/admin/layui/layui.js"></script>
<script src="../../asset/admin/jquery.validate.min.js"></script>
<!--<script type="text/html" id="titleTpl2">-->
<!--    {{#  if(d.status==1){ }}-->
<!--    <button type="button" class="layui-btn  layui-btn-normal layui-btn-sm" onclick="status({{ d.id }},this,0)">显示-->
<!--    </button>-->
<!--    {{#  } else { }}-->
<!--    <button type="button" class="layui-btn  layui-btn-danger  layui-btn-sm" onclick="status({{ d.id }},this,1)">隐藏-->
<!--    </button>-->
<!--    {{#  } }}-->
<!--</script>-->
<script type="text/html" id="titleTpl">

    <button type="button" class="layui-btn layui-btn-warm  layui-btn-sm" onclick="edit({{ d.id }},this)">编辑</button>
    <button type="button" class="layui-btn layui-btn-danger  layui-btn-sm" onclick="del({{ d.id }},this)">删除</button>

</script>
<script>
//    初始化页面
    let $,index,layer,form,table;
    layui.use(['element', 'layer', 'jquery', 'form', 'table'], function () {
        var element=layui.element;
            table=layui.table;
             layer=layui.layer;
             $=layui.jquery;
            form=layui.form;
//             点击添加产品事件
        $(".addbtn").click(function () {
            index = layer.open({
                title: "新增产品",
                skin: 'layui-layer-molv',
                type: 1,
                area: ['420px', '350'], //宽高
                content: $('#addForm'),
            });
            $().ready(function() {
                $("#addForm").validate({
                    rules:{
                        name:{
                            minlength:6,
                            maxlength:18
                        },
                    },
                    messages:{
                        username:{
                            minlength:"不能少于6位字符",
                            maxlength:"最多只能输入30位字符"
                        },
                    }

                })
            })
        })

//        提交添加数据
        form.on('submit(formDemo)', function (data) {
            // 利用jquery中的ajax方式获取到数据
            $.post('action.php?type=add', data.field, function (res) {
//                接受数据库中返回的数据，为json格式
                res1 = JSON.parse(res);
//                console.log(res1);
                if (res1.code == '200') {
                    layer.close(index);
                    layer.msg(res1.msg, {icon: 1,time:500});
                    table.reload('demo',{
                        url:'action.php?type=find',
                    })
                } else if (res1.code == '400') {
                    layer.msg(res1.msg, {icon: 2,time:500});
                }
            })
            return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        });
//        表单页面渲染
            table.render({
                elem:'#demo',
                url:'action.php?type=find',
                page: true,
                limit: 5,
                limits: [5, 10, 15, 20],
                toolbar: true,
                cols: [[
                    {field: 'id', title: 'ID',width:80, flied: 'left', sort: true},
                    {field: 'username', title: '产品名称'},
//                    {field: 'status', title: '状态', templet: '#titleTpl2'},
                    {title: '操作', templet: '#titleTpl',width:200},
                ]]
            })
    })
//    删除一条数据
    function del(id,obj1){
    layer.confirm('您确定要删除吗？', {
        title:"删除产品",
        skin: 'layui-layer-molv',
        btn: ['确认','取消'] //按钮,
    }, function(){
        $.get("action.php?type=del",{id:id},function(r){
            let dele=JSON.parse(r)
            if(dele.code===200){
                $(obj1).parents("tr").remove();
                layer.msg(dele.msg, {icon: 6,time:500});
                table.reload('demo',{
                    url:'action.php?type=find',
                })
            }else if(dele.code===400) {
                layer.msg(dele.msg, {icon: 5,time:500});
            }
        })
    }, function(){
        layer.close()
    });

}
//    修改数据
    function edit(id){
        index = layer.open({
            title: "修改产品",
            skin: 'layui-layer-molv',
            type: 1,
            area: ['420px', '350'], //宽高
            content: $('#editForm'),
        });
        $().ready(function() {
            $("#addForm").validate({
                rules:{
                    name:{
                        minlength:6,
                        maxlength:18
                    },
                },
                messages:{
                    username:{
                        minlength:"不能少于6位字符",
                        maxlength:"最多只能输入30位字符"
                    },
                }

            })
        })
        $.get("action.php?type=edit",{id:id},function(res){
                let data=JSON.parse(res)
                $("#name").val(data.username);
        })
        form.on('submit(formDemoUp)', function (data) {
            // 利用jquery中的ajax方式获取到数据
            let id2=id;
            let newdata=data.field;
            $.post('action.php?type=update', {newdata:newdata,id:id2}, function (res) {
//                接受数据库中返回的数据，为json格式
                res1 = JSON.parse(res);
                if (res1.code == '200') {
                    layer.close(index);
                    layer.msg(res1.msg, {icon: 1});
                    table.reload('demo',{
                        url:'action.php?type=find',
                    })
                } else if (res1.code == '400') {
                    layer.msg(res1.msg, {icon: 2});
                }
            })
            return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        });

    }
//    修改数据

</script>
<!--添加信息弹窗-->
<form class="layui-form" id="addForm">
    <div class="layui-form-item">
        <label class="layui-form-label">产品名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" id="username"   required lay-verify="required" placeholder="请输入产品名" autocomplete="off"
                   class="layui-input">
        </div>
    </div>
<!--    <div class="layui-form-item">-->
<!--        <label class="layui-form-label">状态</label>-->
<!--        <div class="layui-input-block">-->
<!--            <input type="radio" name="status" value="0" title="隐藏" checked>-->
<!--            <input type="radio" name="status" value="1" title="显示">-->
<!--        </div>-->
<!--    </div>-->
    <div class="layui-form-item">
        <div class="layui-input-block submitbtn">
            <button class="layui-btn formDemo" lay-submit lay-filter="formDemo">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<!--修改信息弹窗-->
<form class="layui-form" id="editForm">
    <div class="layui-form-item">
        <label class="layui-form-label">产品名称</label>
        <div class="layui-input-block">
            <input type="text" name="usernames" required lay-verify="required" id="name" placeholder="请输入产品名" autocomplete="off"
                   class="layui-input">
        </div>
    </div>
<!--    <div class="layui-form-item">-->
<!--        <label class="layui-form-label">状态</label>-->
<!--        <div class="layui-input-block">-->
<!--            <input type="radio" name="status" value="0" title="隐藏" id="black">-->
<!--            <input type="radio" name="status" value="1" title="显示" id="white">-->
<!--        </div>-->
<!--    </div>-->
    <div class="layui-form-item">
        <div class="layui-input-block submitbtn">
            <button class="layui-btn formDemoUP" lay-submit lay-filter="formDemoUp">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
</body>
</html>
<?php
include "../footer.php";

?>