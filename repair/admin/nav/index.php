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
            <button type="submit" class="layui-btn  addbtn">添加导航</button>
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
        var $,index,layer,form,table,index2;
        layui.use(['element', 'layer', 'jquery', 'form', 'table'], function () {
            var element = layui.element;
            table = layui.table;
            layer = layui.layer;
            $ = layui.jquery;
            form = layui.form;
//             点击添加产品事件
            $(".addbtn").click(function(){
                index=layer.open({
                    title: "新增导航信息",
                    skin: 'layui-layer-molv',
                    type: 1,
                    area: ['420px', '350'], //宽高
                    content: $('#addForm'),
                });
                $().ready(function() {
                    $("#addForm").validate({
                        rules:{
                            navname:{
                                minlength:2,
                                maxlength:12
                            },
//                            url:{
//                                minlength:20,
//                            },
                        },
                        messages:{
                            navname:{
                                minlength:"不能少于2位字符",
                                maxlength:"最多只能输入12位字符"
                            },
//                            url:{
//                                minlength:"不能少于20位字符",
//                                url:"请输入有效的网址",
//                            },
                        }

                    })
                })
            });
            //        提交添加数据
            form.on('submit(formDemo)',function(data){
//                利用ajax方式获取数据
                $.post('action.php?type=add',data.field,function(res){
                    var data=JSON.parse(res);
                    if(data.code=='200'){
                        layer.close(index);
                        layer.msg(data.msg, {icon: 1,time:500});
                        table.reload('demo',{
                            url:'action.php?type=find',
                        })
                    }else if(data.code=='400'){
                        layer.msg(data.msg, {icon: 2,time:500});
                    }
                })
                return false //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            })
//            表格页面渲染
            table.render({
                elem:'#demo',
                url:'action.php?type=find',
                page:true,
                limit:5,
                limits:[5,10,15],
                toolbar:true,
                cols:[[
                    {field:"id",title:"ID",width:100,sort:true},
                    {field:"navname",title:"导航名称"},
                    {field:"url",title:"地址信息"},
                    {field:"sort",title:"排序",templet:function(d){
                        return `<input type="text"   name="sort" value="${d.sort}" onchange="sorts(${d.id},this)" style="width:50px;text-align: center;cursor: pointer;   ">`
                    }},
                    {title:"操作",templet:'#titleTpl'}
            ]]
        }
            )
        })
//        排序需要的函数
        function sorts(id,obj){
            var val=$(obj).val()
            $.get("action.php?type=sort",{id:id,value:val},function(res){
                var sorts=JSON.parse(res);
                if(sorts.code===200){
                    layer.msg(sorts.msg,{icon:1,time:500});
                    table.reload('demo',{
                        url:'action.php?type=find'
                    })
                }else{
                    layer.msg(sorts.msg,{icon:2,time:500});
                }
            })

        }
        //    删除一条数据
        function del(id,obj){
            layer.confirm('您确定要删除吗？', {
                title:"删除导航",
                skin: 'layui-layer-molv',
                btn: ['确认','取消'] //按钮,
            }, function(){
                $.get("action.php?type=del",{id:id},function(res){
                    var newdata=JSON.parse(res);
                    if(newdata.code===200){
                       $(obj).parents("tr").remove();
                        layer.msg(newdata.msg,{icon:1,time:500});
                        table.reload('demo',{
                            url:"action.php?type=find",
                        })
                    }else if(newdata.code==400){
                        layer.msg(newdata.msg,{icon:2,time:500})
                    }
                })
            }, function(){
                layer.close()
            });

        }
        //    修改数据
        function edit(id,obj){
            index2=layer.open(
                {
                    title: "修改导航信息",
                    skin: 'layui-layer-molv',
                    type: 1,
                    area: ['420px', '350'], //宽高
                    content: $('#editForm'),
                });
            $.get("action.php?type=edit",{id:id},function(res){
                    let newres=JSON.parse(res);
                    $("#name").val(newres.navname);
                    $("#url").val(newres.url);
                    $("#sort").val(newres.sort);
            })
            $().ready(function() {
                $("#editForm").validate({
                    rules:{
                        nameUpdate:{
                            minlength:2,
                            maxlength:12
                        },
//                        urlUpdate:{
//                            minlength:20,
//                        },
                    },
                    messages:{
                        nameUpdate:{
                            minlength:"不能少于2位字符",
                            maxlength:"最多只能输入12位字符"
                        },
//                        urlUpdate:{
//                            url:"请输入网址",
//                            minlength:"不能少于20位字符",
//                        },
                    }

                })
            })
            form.on('submit(formDemoUp)',function(data){
                var id2=id;
                var newdata=data.field;
                $.post("action.php?type=update",{newdata:newdata,id:id},function(res){
                    var newres=JSON.parse(res);
                    if(newres.code===200){
                        layer.close(index2)
                        layer.msg(newres.msg,{icon:1,time:500});
                        table.reload('demo',{
                            url:'action.php?type=find'
                        })
                    }else if(newres.code===400){
                        layer.msg(newres.msg,{icon:2,time:500});
                    }
                })
                return false
            })
        }

    </script>
<!--添加信息表单-->
    <form class="layui-form" id="addForm">
        <div class="layui-form-item">
            <label class="layui-form-label">导航名称：</label>
            <div class="layui-input-block">
                <input type="text" name="navname"  required lay-verify="required" placeholder="请输入导航信息" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">跳转地址：</label>
            <div class="layui-input-block">
                <input type="text" name="url" required lay-verify="required" placeholder="请输入跳转地址" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">排序：</label>
            <div class="layui-input-block">
                <input type="number" name="sort" value="0" required lay-verify="required" placeholder="请输入排序" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block submitbtn">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
<!--    修改信息表单-->
    <form class="layui-form" id="editForm">
        <div class="layui-form-item">
            <label class="layui-form-label">导航信息</label>
            <div class="layui-input-block">
                <input type="text" name="nameUpdate" id="name" required lay-verify="required" placeholder="请输入导航信息" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">跳转地址</label>
            <div class="layui-input-block">
                <input type="text" name="urlUpdate" id="url" required lay-verify="required" placeholder="请输入跳转地址" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-block">
                <input type="number" name="sortupdate" id="sort"  required lay-verify="required" placeholder="请输入排序" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block submitbtn">
                <button class="layui-btn" lay-submit lay-filter="formDemoUp">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
    </body>
    </html>
<?php
include "../footer.php";
?>