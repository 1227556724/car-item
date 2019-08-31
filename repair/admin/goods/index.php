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
            <button type="submit" class="layui-btn  addbtn">添加产品</button>
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

//            请求数据渲染页面
            table.render({
                elem:'#demo',
                url:'action.php?type=find',
                page:true,
                limit:10,
                limites:[10,20,30],
                toolbar:true,
                cols:[[
                    {field: 'id', title: 'ID', width:80, sort: true},
                    {field: 'goodsname', title: '产品名称'},
                    {field: 'img1', title: '图片1'},
                    {field: 'img2', title: '图片2'},
                    {field: 'market_price', title: '市场价'},
                    {field: 'price', title: '零售价'},
                    {field: 'stock', title: '库存'},
                    {field: 'content', title: '产品详情'},
                    {field: 'typeid', title: '产品类型'},
                    {title: '产品类型',templet:'#titleTpl'},
                ]]
            })
            $(".addbtn").click(function(){
                location.href='http://localhost/repair/admin/goods/produt.php'
            })
        })
//        删除产品
        function del(id,obj){
            layer.confirm('您确定要删除吗？', {
                title:"删除产品信息",
                skin: 'layui-layer-molv',
                btn: ['确认','取消'] //按钮,
            }, function(){
                $.get("action.php?type=del",{id:id},function(res){
                    var data=JSON.parse(res);
                    if(data.code===200){
                        $(obj).parents("tr").remove();
                        layer.msg(data.msg,{icon:1,time:500});
                        table.reload('demo',{
                            url:"action.php?type=find",
                        })
                    }else{
                        layer.msg(data.msg,{icon:2,time:500})
                    }
                })
            }, function(){
                layer.close()
            });

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
                <input type="url" name="url" required lay-verify="required|url" placeholder="请输入跳转地址" autocomplete="off"
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
                <input type="url" name="urlUpdate" id="url" required lay-verify="required|url" placeholder="请输入跳转地址" autocomplete="off"
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