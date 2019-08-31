<?php

header('Content-type:text/html;charset=utf8');
include "../commen.php";
include "../../config/db.php";
$sql="select * from slider ";
$imgresult=$mysql->query($sql)->fetch_all(MYSQLI_ASSOC);

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
            <button type="submit" class="layui-btn  addbtn sliderbtn">添加图片</button>
            <table id="demo" lay-filter="test" lay-data="{id: 'idTest'}"></table>

        </div>
    </div>
    <script src="../../asset/admin/jquery-3.4.1.min.js"></script>
    <script src="../../asset/admin/layui/layui.js"></script>
    <script src="../../asset/admin/jquery.validate.min.js"></script>

    <script type="text/html" id="titleTpl">

        <button type="button" class="layui-btn layui-btn-warm  layui-btn-sm" onclick="edit({{ d.id }})">编辑</button>
        <button type="button" class="layui-btn layui-btn-danger  layui-btn-sm" onclick="del({{ d.id }},this)">删除</button>

    </script>
    <script>
        var $,index,layer,form,table,index2,upload;
        layui.use(['element', 'layer', 'jquery', 'form', 'table','upload'], function () {
            var element=layui.element;
               layer=layui.layer;
               upload=layui.upload;
               $=layui.jquery;
               form=layui.form;
               table=layui.table;
//               点击添加添加图片
            $(".sliderbtn").click(function(){
               index= layer.open({
                    type: 1,
                    skin: 'layui-layer-molv', //加上边框
                    area: ['420px', ''], //宽高
                    content: $('#addForm'),
                });
                $().ready(function() {
                    $("#addForm").validate({
                        rules:{
//                            img:{
//                                minlength:2,
//                                maxlength:12
//                            },
                            sort:{
                                minlength:3,
                            },
                        },
                        messages:{
//                            navname:{
//                                minlength:"不能少于2位字符",
//                                maxlength:"最多只能输入12位字符"
//                            },
                            url:{

                                minlength:"不能超过3个数字",
                            },
                        }

                    })
                })
            });
            form.on('submit(formDemo)',function(data){
                $.post('action.php?type=add',data.field,function(res){
                    let imgdata=JSON.parse(res);
                    if(imgdata.code===200){
                        layer.close(index);
                        layer.msg(imgdata.msg,{icon:1,time:500})
                        table.reload('demo',{
                            url:'action.php?type=find'
                        })
                    }else{
                        layer.close(index);
                    }
                })

                return false //阻止按钮跳转
            })
//            渲染表格
            table.render({
                elem:'#demo',
                url:'action.php?type=find',
                page:true,
                limit:5,
                limits:[5,10,15],
                toolbar:true,
                cols:[[
                    {field: 'id', title: 'ID', width:100, sort: true, fixed: 'left'},
                    {field: 'img', title: '图片'},
                    {field: 'sort', title: '排序',templet:function (d){
                        return `<input type="name" value="${d.sort}" name="sort" onchange="sort(${d.id},this)" style="width:50px;text-align: center;cursor: pointer;">`
                    } },
                    {field: 'sort', title: '操作',templet:'#titleTpl'},
                ]]
            })
//            上传图片
            upload.render({
                elem:'#test1',
                url:'../upload/upload.php',
                accept:'',
                accepMime:'image/*',
                done:function(res){
                    if(res.code===200){
                        $('#src2').attr("src",res.url);
                        $('#src1').val(res.url);
                        layer.msg(res.msg,{icon:1,time:600})
                    }else{
                        layer.msg(res.msg,{icon:2,time:600})
                    }
                },
            })
//            修改图片
            })

//            修改排序函数
            function sort(id,obj){
            let value=$(obj).val();
                $.get("action.php?type=sort",{id:id,value:value},function(res){
                    let sorts=JSON.parse(res)
                    if(sorts.code===200){
                        layer.msg(sorts.msg,{icon:1,time:500})
                        table.reload('demo',{
                            url:'action.php?type=find'
                        })
                    }else{
                        layer.msg(sorts.msg,{icon:2,time:500})
                    }
                })
            }
//            点击删除删除全部
            function del(id,obj){
                layer.confirm('您确定要删除吗？', {
                    btn: ['确认','取消'], //按钮
                    title:"删除图片",
                    skin: 'layui-layer-molv',
                }, function(){
                    $.get('action.php?type=del',{id:id},function(res){
                        var del=JSON.parse(res);
                        if(del.code===200){
                            $(obj).parents("tr").remove();
                            layer.msg(del.msg, {icon: 1,time:500});
                            table.reload('demo',{
                                url:'action.php?type=find'
                            })
                        }else{
                            layer.msg(del.msg, {icon: 2,time:500});
                        }
                    })
                }, function(){
                   layer.close()
                });

            }
//            点击修改进行图片的修改
            function edit(id){
                upload.render({
                    elem:'#test2',
                    url:'../upload/upload.php',
                    accept:'',
                    accepMime:'image/*',
                    done:function(res){
                        if(res.code===200){
                            $('#src2').attr("src",res.url);
                            $('#src1').val(res.url);
                            layer.msg(res.msg,{icon:1,time:600})
                        }else{
                            layer.msg(res.msg,{icon:2,time:600})
                        }
                    },
                })
                index2=layer.open({
                    type: 1,
                    skin: 'layui-layer-molv', //加上边框
                    area: ['420px', ''], //宽高
                    content: $('#editForm'),})
                $.get("action.php?type=query",{id:id},function(res){
                    let query=JSON.parse(res);
                    $("#img").val(query.img);
                })
                $().ready(function() {
                    $("#addForm").validate({
                        rules:{
//                            img:{
//                                minlength:2,
//                                maxlength:12
//                            },
                            sort:{
                                minlength:3,
                            },
                        },
                        messages:{
//                            navname:{
//                                minlength:"不能少于2位字符",
//                                maxlength:"最多只能输入12位字符"
//                            },
                            url:{

                                minlength:"不能超过3个数字",
                            },
                        }

                    })
                })
                form.on('submit(editformDemo)',function(data){
                    var id1=id;
                    var data=data.field;

                    $.post('action.php?type=update',{id:id,data:data},function(res){
                        let update=JSON.parse(res);

                        if(update.code===200){
                            layer.close(index2);
                            layer.msg(update.msg,{icon:1,time:500});
                            table.reload('demo',{
                                url:'action.php?type=find'
                            })
                        }else{
                            layer.msg(update.msg,{icon:2,time:500});
                        }
                    })
                    return false;
                })

        }

    </script>
    <!--添加信息表单-->
    <form class="layui-form" id="addForm">
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">上传图片：</label>
            <div class="layui-input-block">
                <button type="button" class="layui-btn" id="test1">
                    <i class="layui-icon">&#xe67c;</i>上传图片
                    <input type="hidden" id="src1" name="img" >
<!--                    <img id="src2" src="--><?php //echo $data['aimg'] ?><!--" alt="">-->
                </button>
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
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">修改图片：</label>
            <div class="layui-input-block">
                <input type="hidden" name="id" value="">
                <button type="button" class="layui-btn" id="test2">
                    <i class="layui-icon">&#xe67c;</i>修改图片
                    <input type="hidden" id="img" name="editimg" >
<!--                    <img id="src2" src="--><?php //echo $imgresult['img'] ?><!--" alt="">-->
                </button>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block submitbtn">
                <button class="layui-btn" lay-submit lay-filter="editformDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
    </body>
    </html>
<?php
include "../footer.php";

?>