<?php
header('Content-type:text/html;charset=uft8');
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
    #addForm {
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
        <button type="submit" class="layui-btn  addbtn">添加管理员</button>
        <table id="demo" lay-filter="test" lay-data="{id: 'idTest'}"></table>

    </div>
</div>
<script src="../../asset/admin/jquery-3.4.1.min.js"></script>
<script src="../../asset/admin/layui/layui.js"></script>
<script src="../../asset/admin/jquery.validate.min.js"></script>
<!--<script type="text/html" id="titleTpl3">-->
<!---->
<!--</script>-->
<!--黑白名单页面渲染-->
<script type="text/html" id="titleTpl2">
    {{#  if(d.status==1){ }}
    <button type="button" class="layui-btn  layui-btn-normal layui-btn-sm" onclick="status({{ d.id }},this,0)">白名单
    </button>
    {{#  } else { }}
    <button type="button" class="layui-btn  layui-btn-danger  layui-btn-sm" onclick="status({{ d.id }},this,1)">黑名单
    </button>
    {{#  } }}
</script>
<!--按钮的页面渲染-->
<script type="text/html" id="titleTpl">

    <button type="button" class="layui-btn layui-btn-warm  layui-btn-sm" onclick="edit({{ d.id }},this)">编辑</button>
    <button type="button" class="layui-btn layui-btn-danger  layui-btn-sm" onclick="del({{ d.id }},this)">删除</button>

</script>
<script>

    //JavaScript代码区域
    //    定义全局的jquery和layer
    let $, layer,index2,form,table;
    layui.use(['element', 'layer', 'jquery', 'form', 'table',], function () {
        var element = layui.element;
        layer = layui.layer;
        $ = layui.jquery;
//        记录表单
         form = layui.form;
//        记录表格
        table = layui.table;
//        记录时间
        var laydate = layui.laydate;
//        记录添加弹窗
        var index
//        添加管理员
        $(".addbtn").click(function () {
            index = layer.open({
                title: "管理员信息",
                skin: 'layui-layer-molv',
                type: 1,
                area: ['420px', ''], //宽高
                content: $('#addForm'),
            });
            $().ready(function() {
                $("#addForm").validate({
                    rules:{
                        username:{
                            minlength:6,
                            maxlength:18
                        },
                        password:{
                            minlength:6,
                            maxlength:18
                        },
                        repassword:{
                            minlength:6,
                            maxlength:18
                        }
                    },
                    messages:{
                        username:{
                            minlength:"不能少于6位数",
                            maxlength:"最多只能输入12位"
                        },
                        password:{
                            minlength:"密码不能少于6位数",
                            maxlength:"最多只能输入12位"
                        },
                        repassword:{
                            minlength:"密码不能少于6位数",
                            maxlength:"最多只能输入12位",
                            equalTo: "两次密码输入不一致"
                        }
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
                    layer.msg(res1.msg, {icon: 1});
                    table.reload('demo',{
                        url:'action.php?type=find',
                    })
                } else if (res1.code == '400') {
                    layer.msg(res1.msg, {icon: 2});
                }
            })
            return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        })
//        数据渲染
        table.render({
            elem: '#demo',
            url: 'action.php?type=find',
            page: true,
            limit: 5,
            limits: [5, 10, 15, 20],
            toolbar: true,
            cols: [[
                {field: 'id', title: 'ID', flied: 'left', sort: true},
                {field: 'username', title: '用户名'},
                {field: 'time', title: '加入时间', templet: '#titleTpl3'},
                {field: 'status', title: '状态', templet: '#titleTpl2'},
                {title: '操作', templet: '#titleTpl'},
            ]]
        })

//        无刷新修改状态
    });
    //        点击状态栏修改黑白名单调用的函数
    function status(id, obj, state) {
        $.get('action.php?type=status', {id: id, state: state}, function (res) {
            let stats = JSON.parse(res)
            console.log(stats.code);
            console.log(state);
            if (state == 1) {
                if (stats.code == 200) {
                    $(obj).parent().html(`<button  class="layui-btn  layui-btn-normal  layui-btn-sm" onclick="status(${id},this,0)">白名单</button>`);

                    layer.msg(stats.msg, {icon: 1});

                } else if (stats.code == 404) {
                    layer.msg(stats.msg, {icon: 2});
                }
            } else {
                if (stats.code == 200) {
                    $(obj).parent().html(`<button  class="layui-btn  layui-btn-danger  layui-btn-sm" onclick="status(${id},this,1)">黑名单</button>`);
                    layer.msg(stats.msg, {icon: 1});

                } else if (stats.code == 404) {
                    layer.msg(stats.msg, {icon: 2});
                }
            }
        })

    }
//    点击删除
    function del(id,obj1){
        layer.confirm('您确定要删除吗？', {
            title:"删除管理员",
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
                }else {
                    layer.msg(dele.msg, {icon: 5});
                }
            })
        }, function(){
            layer.close()
        });

    }
//        点击修改信息
    function edit(id,obj2){
        index2 = layer.open({
            title: "修改管理员信息",
            skin: 'layui-layer-molv',
            type: 1,
            area: ['420px', ''], //宽高
            content: $('#editForm'),
        });
        $.get("action.php?type=edit",{id:id},function(res){
            var newres = JSON.parse(res);
            $("#editname").val(newres.username);
            $("#editpassword").val(newres.password);
//            if(newres.status==1){
//                console.log($("#white"));
//                $("#white").next().addClass("layui-form-radioed");
//                $("#white").next().children().addClass("layui-anim-scaleSpring");
//            }
//            $("#black").prop("checked ",newres.status==0? true:false);
//            $("#white").prop("checked ",newres.status==1? true:false);
            $("[name=status]").each(function(i,v){
                if($(v).val()==newres.status){
                    $(v).prop("checked",true);
                    form.render()
                }
            })

        })
        $().ready(function() {
            $("#editForm").validate({
                rules:{
                    username:{
                        minlength:6,
                        maxlength:18
                    },
                    password:{
                        minlength:6,
                        maxlength:18
                    },
                    repassword:{
                        minlength:6,
                        maxlength:18,
                        equalTo:"#password"
                    }
                },
                messages:{
                    username:{
                        minlength:"不能少于6位数",
                        maxlength:"最多只能输入18位"
                    },
                    password:{
                        minlength:"密码不能少于6位数",
                        maxlength:"最多只能输入18位"
                    },
                    repassword:{
                        minlength:"密码不能少于6位数",
                        maxlength:"最多只能输入18位",
                        equalTo: "两次密码输入不一致"
                    }
                }

            })
        })
    }
    //    添加表单验证的校验规则

</script>
<!--添加信息弹窗-->
<form class="layui-form" id="addForm">
    <div class="layui-form-item">
        <label class="layui-form-label">姓名：</label>
        <div class="layui-input-block">
            <input type="text" name="username" required lay-verify="required" placeholder="请输入姓名" autocomplete="off"
                   class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密码：</label>
        <div class="layui-input-block">
            <input type="password" name="password" id="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off"
                   class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">确认密码：</label>
        <div class="layui-input-block">
            <input type="password" name="repassword" required lay-verify="required" placeholder="确认密码"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
            <input type="radio" name="status" value="0" title="黑名单" checked>
            <input type="radio" name="status" value="1" title="白名单">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block submitbtn">
            <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<!--修改信息弹窗-->
<form class="layui-form" id="editForm">
    <div class="layui-form-item">
        <label class="layui-form-label">姓名：</label>
        <div class="layui-input-block">
            <input type="text" name="username" id="editname" disabled required lay-verify="required" placeholder="请输入姓名" autocomplete="off"
                   class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">修改密码：</label>
        <div class="layui-input-block">
            <input type="text" name="password" id="editpassword" required lay-verify="required" placeholder="请输入密码" autocomplete="off"
                   class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">确认密码：</label>
        <div class="layui-input-block">
            <input type="password" name="repassword" required lay-verify="required" placeholder="确认修改密码"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
            <input type="radio" name="status" value="0" title="黑名单" id="black">
            <input type="radio" name="status" value="1" title="白名单" id="white">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block submitbtn">
            <button class="layui-btn" lay-submit lay-filter="formDemo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
</body>
</html>
<?php
include "../footer.php";

?>
<!--1/$_post-->
<!--2/add.php  验证数据-->
<!--用户名为空 长度，密码长度-->
<!--$data-->
<!--echo json_encode($data)-->
<!--3/js res-->
<!--res.code  弹出提示、关闭页面层-->

<!--table  模块   table.rander-->
<!--find.php 注意数据接口的形式-->
<!--返回来用自定义模板  按钮 黑白名单，时间戳-->

<!--给按钮添加事件，获取到id，函数放到layui的外面-->