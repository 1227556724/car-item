<?php
header('Content-type:text/html;charset=utf8');
include "../commen.php";
include '../../config/db.php';
$sql="select * from team ORDER by id desc";
$data=$mysql->query($sql)->fetch_all(MYSQLI_ASSOC);

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
        .img{
            width:100px;
            height:100px;
            margin-left: 92px;
        }
        img{
            width:100px;
        }
    </style>
    <body>
    <div class="layui-body">
        <div style="padding: 15px;">
            <button type="submit" class="layui-btn  addbtn">添加团队</button>
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
        var $,index,layer,form,table,index2,upload;
        layui.use(['element', 'layer', 'jquery', 'form', 'table','upload'], function () {
            var element = layui.element;
            table = layui.table;
            layer = layui.layer;
            $ = layui.jquery;
            form = layui.form;
            upload=layui.upload;
//            获取数据进行页面渲染
            table.render({
                elem:'#demo',
                url:'action.php?type=find',
                page:true,
                limit:4,
                limits:[4,8,12],
                toolbar:true,
                cols:[[
                    {field: 'id', title: 'ID', width:80},
                    {field: 'head_img', title: '团队图片'},
                    {field: 'teamname', title: '姓名'},
                    {field: 'positions', title: '职务'},
                    { title: '操作',templet:'#titleTpl'},
                ]]
            })
//            添加数据
            $(".addbtn").click(function(){
                index=layer.open({
                    title: "新增团队成员",
                    type: 1,
                    skin: 'layui-layer-molv',
                    area: ['420px', ''], //宽高
                    content:$('#addForm'),
                });
            })
//            提交添加的数据；
            form.on('submit(formDemo)',function(data){
                $.post('action.php?type=add',data.field,function(res){
                    var data=JSON.parse(res);
                    if(data.code===200){
                        layer.close(index);
                        layer.msg(data.msg,{icon:1,time:500});
                        table.reload('demo',{
                            url:'action.php?type=find'
                        })
                    }else{
                        layer.close(index);
                        layer.msg(data.msg,{icon:1,time:500});
                    }
                })
                return false;
            })
//            获取提交图片的数据
            upload.render({
                elem:'#test1',
                url:'../upload/upload.php',
                accept:'',
                size:500,
                accepMime:'image/*',
                done:function(res){
                    if(res.code===200){
                        $('#src2').attr("src",res.url);
                        layer.msg(res.msg,{icon:1,time:600})
                    }else{
                        layer.msg(res.msg,{icon:2,time:600})
                    }
                },
            })
//            修改数据的图片
            upload.render({
                elem:'#test2',
                url:'../upload/upload.php',
                accept:'',
                size:500,
                accepMime:'image/*',
                done:function(res){
                    if(res.code===200){
                        $('#img').attr("src",res.url);
                        layer.msg(res.msg,{icon:1,time:600})
                    }else{
                        layer.msg(res.msg,{icon:2,time:600})
                    }
                },
            })
        })
//        删除团队信息
        function del(id,obj){
            layer.confirm('您要删除吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.get('action.php?type=del',{id:id},function(res){
                    var data=JSON.parse(res);
                    if(data.code===200){
                        $(obj).parents("tr").remove();
                        layer.msg(data.msg, {icon: 1,time:500});
                       table.reload('demo',{
                           url:'action.php?type=find',
                       })
                    }else{
                        layer.msg(data.msg, {icon: 1,time:500});
                    }
                })
            }, function(){
                layer.close()
            });
        }
//        修改数据库中的信息
        function edit(id,obj){
            index2=index=layer.open({
                title: "修改团队成员",
                type: 1,
                skin: 'layui-layer-molv',
                area: ['420px', ''], //宽高
                content:$('#editForm'),
            });
            $.get('action.php?type=edit',{id:id},function(res){
                var newdata=JSON.parse(res);
//                将数据进行渲染
                $("#img").attr('src',newdata.head_img);
                $("#name").val(newdata.teamname);
                $("#pos").val(newdata.positions);
            })
            form.on('submit(edtiform)',function(data){
                var id2=id;
                var newdata=data.field;
                $.post('action.php?type=update',{id:id,data:newdata},function(res1){
                    var res2=JSON.parse(res1);
                   if(res2.code===200){
                       layer.close(index2);
                       layer.msg(res2.msg,{icon:1,time:500})
                       table.reload('demo',{
                           url:'action.php?type=find'
                       })
                   }else{
                       layer.close(index2);
                       layer.msg(res2.msg,{icon:2,time:500})
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
                <input type="hidden" name="id" value="">
                <button type="button" class="layui-btn" id="test1">
                    <i class="layui-icon">&#xe67c;</i>上传图片
                    <input type="hidden" id="src1" name="img" >
                </button>
            </div>
        </div>
        <div class="layui-form-item layui-form-text img">
            <img id="src2" src="<?php foreach ($data as $v){  $v['head_img']; }?>" alt="">
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">姓名：</label>
            <div class="layui-input-block">
                <input type="text" name="name" required lay-verify="required" placeholder="请输入姓名" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">职务：</label>
            <div class="layui-input-block">
                <select name="position" lay-verify="required">
                    <option value="店长">店长</option>
                    <option value="副店长">副店长</option>
                    <option value="维修工">维修工</option>
                    <option value="洗车工">洗车工</option>
                </select>
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
            <label class="layui-form-label">上传图片：</label>
            <div class="layui-input-block">
                <input type="hidden" name="id" value="">
                <button type="button" class="layui-btn" id="test2">
                    <i class="layui-icon">&#xe67c;</i>上传图片
                    <input type="hidden" id="src1" name="editimg" >
                </button>
            </div>
        </div>
        <div class="layui-form-item layui-form-text img">
            <img id="img" src="<?php foreach ($data as $v){  $v['head_img']; }?>" alt="">
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">姓名：</label>
            <div class="layui-input-block">
                <input type="text" name="editname" id="name" required lay-verify="required" placeholder="请输入姓名" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">职务：</label>
            <div class="layui-input-block">
                <select name="editposition" id="pos" lay-verify="required">
                    <option value="店长">店长</option>
                    <option value="副店长">副店长</option>
                    <option value="维修工">维修工</option>
                    <option value="洗车工">洗车工</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block submitbtn">
                <button class="layui-btn" lay-submit lay-filter="edtiform">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>

    </body>
    </html>
<?php
include "../footer.php";
?>