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
        <button type="submit" class="layui-btn  addbtn">新增预约名单</button>
        <table id="demo" lay-filter="test" lay-data="{id: 'idTest'}"></table>

    </div>
</div>
<script src="../../asset/admin/jquery-3.4.1.min.js"></script>
<script src="../../asset/admin/layui/layui.js"></script>
<script src="../../asset/admin/jquery.validate.min.js"></script>
<script type="text/html" id="titleTpl2">
    {{#  if(d.sex==1){ }}
    <button type="button" class="layui-btn  layui-btn-normal layui-btn-sm" onclick="status({{ d.id }},this,0)">男
    </button>
    {{#  } else { }}
    <button type="button" class="layui-btn  layui-btn-danger  layui-btn-sm" onclick="status({{ d.id }},this,1)">女
    </button>
    {{#  } }}
</script>
<script type="text/html" id="titleTpl">

<!--    <button type="button" class="layui-btn layui-btn-warm  layui-btn-sm" onclick="edit({{ d.id }},this)">编辑</button>-->
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
            elem:'#demo',
            url:'action.php?type=find',
            page:true,
            limit:5,
            limits:[5,10,15],
            toolbar:true,
            cols:[[
                {field: 'id', title: 'ID', width:80, sort: true, fixed: 'left'},
                {field: 'serve', title: '预约服务'},
                {field: 'times', title: '预约时间'},
                {field: 'username', title: '您的姓名'},
                {field: 'sex', title: '性别',templet:'#titleTpl2'},
                {field: 'phone', title: '联系电话'},
                {field: 'explain', title: '补充说明',width:300},
                { title: '操作',templet:'#titleTpl'},
            ]]
        })
//        添加预约名单
//        $(".addbtn").click(function(){
//            index=layer.open({
//                title: "新增预约人员",
//                skin: 'layui-layer-molv',
//                type: 1,
//                area: ['420px', ''], //宽高
//                content: $('#addForm'),
//            });
////            $().ready(function() {
////                $("#addForm").validate({
////                    rules:{
////                        username:{
////                            minlength:2,
////                            maxlength:12
////                        },
////                        phone:{
////                            maxlength:11,
////                            minxlength:11,
////                        },
//////                        text:{
//////                            maxlength:100,
//////                            required:false,
//////                        }
////                    },
////                    messages:{
////                        username:{
////                            required:"必填项",
////                            minlength:"不能少于2位字符",
////                            maxlength:"最多只能输入12位字符"
////                        },
////                        phone:{
////                            required:"必填项",
////                            maxlength:"最多只能输入11位字符",
////                            minlength:"最少输入11位字符",
////                        },
//////                        text:{
//////                            maxlength:"最多只能输入100位字符",
//////
//////                        }
////                    }
////
////                })
////            })
//        })
//        form.on('submit(formDemo)',function(data){
////                利用ajax方式获取数据
//            $.post('action.php?type=add',data.field,function(res){
//                var data=JSON.parse(res);
//                if(data.code=='200'){
//                    layer.close(index);
//                    layer.msg(data.msg, {icon: 1,time:500});
//                    table.reload('demo',{
//                        url:'action.php?type=find',
//                    })
//                }else if(data.code=='400'){
//                    layer.msg(data.msg, {icon: 2,time:500});
//                }
//            })
//            return false //阻止表单跳转。如果需要表单跳转，去掉这段即可。
//        })
    })
//        删除
    function del(id,obj){
        layer.confirm('您是要删除吗？', {
            btn: ['确定','取消'] ,//按钮
            title:"删除预约名单",
            skin: 'layui-layer-molv',
        }, function(){
            $.get('action.php?type=del',{id:id},function(res){
                let data=JSON.parse(res);
                if(data.code===200){
                    layer.msg(data.msg, {icon: 1,time:500});
                    table.reload('demo',{
                        url:'action.php?type=find',
                    })
                }else{
                    layer.msg(data.msg, {icon: 2,time:500});
                }
            })
        }, function(){
            layer.close();
        });

    }
</script>
<!--添加信息表单-->
<form class="layui-form" id="addForm">
    <div class="layui-form-item">
        <label class="layui-form-label">预约服务</label>
        <div class="layui-input-block">
            <select name="serve" lay-verify="required">
                <option value="汽车美容" >汽车美容</option>
                <option value="汽车维修" >汽车维修</option>
                <option value="钣金喷漆" >钣金喷漆</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">姓名</label>
        <div class="layui-input-block">
            <input type="text" name="username"  required lay-verify="required" placeholder="请输入姓名" autocomplete="off"
                   class="layui-input">
        </div>
    </div>
    <div class="layui-form-item" pane>
        <label class="layui-form-label">性别</label>
        <div class="layui-input-block">
            <input type="radio" name="sex" value="男" title="男"checked>
            <input type="radio" name="sex" value="女" title="女" >
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">电话</label>
        <div class="layui-input-block">
            <input type="number" name="phone"  required lay-verify="required" placeholder="请输入电话" autocomplete="off"
                   class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">补充说明</label>
        <div class="layui-input-block">
            <textarea name="text" placeholder="请输入内容" class="layui-textarea"></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block submitbtn">
            <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>

</body>
</html>
<?php
include "../footer.php";
?>
