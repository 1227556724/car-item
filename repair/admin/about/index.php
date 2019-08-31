<?php

include '../commen.php';
include '../../config/db.php';
$asql="select * from aboutus";
$data=$mysql->query($asql)->fetch_assoc();

//var_dump($data);
//exit;
?>
<link rel="stylesheet" href="../../asset/admin/layui/css/layui.css">

<style>

    .layui-form-label{
        text-align: left;
    }
    .layui-textarea{
        min-height: 150px;
        width: 400px;
        margin:auto;
    }
    #test1{
        margin-left:240px;
        width:400px;
    }
    .layui-btn{
        margin-left: 354px;
    }
    img{
        height:150px;
        display: block;
        margin: auto;
    }
    p{
        width: 400px;
        margin:0 auto;
    }
    .text{
        height:auto;
    }
    .img{
        width:400px;
        margin:0 auto;
    }
</style>
<body>
<div class="layui-body">
    <div style="padding: 15px;">
        <span class="layui-breadcrumb" style="padding: 34px;margin-left: 324px;" lay-separator="-">
              <a href="">首页</a>
              <a href="">关于我们</a>
        </span>
        <form class="layui-form" action="" style="padding: 20px;">
            <div class="layui-form-item layui-form-text">
                    <textarea placeholder="请输入内容" class="layui-textarea" name="ades">
                        <?php echo $data['ades']?>
                    </textarea>
            </div>
            <div class="layui-form-item layui-form-text">
                <div class="layui-input-block">
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                    <button type="button" class="layui-btn" id="test1">
                        <i class="layui-icon">&#xe67c;</i>上传图片
                        <input type="hidden" id="src1" name="aimg" <?php echo $data['aimg'] ?>">
                    </button>
                </div>
            </div>
            <div class="layui-form-item layui-form-text img">
                <img id="src2" src="<?php echo $data['aimg'] ?>" alt="">
            </div>
            <div class="layui-form-item layui-form-text text">
                    <p>上传图片的最佳比例1:1，最佳尺寸442*294，最大不超过500KB</p>
            </div>
            <div class="layui-form-item btn">
                <div class="layui-input-block">
                    <button class="layui-btn " lay-submit lay-filter="formDemo">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="../../asset/admin/layui/layui.js"></script>
<script>
    layui.use(['element','form','upload'],function(){
        let {form,$,upload,layer}=layui;
        upload.render({
            elem:'#test1',
            url:'../upload/upload.php',
            accept:'',
            size:500,
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
        form.on('submit(formDemo)',function(data){
            console.log(data.field);
            $.ajax({

                url:'action.php',
                type:'post',
                data:data.field,
                dataType:'json',
                success:function(res){
                if(res.code===200){
                    layer.msg(res.msg,{icon:1,time:600})
                }else{
                    layer.msg(res.msg,{icon:2,time:600})
                }
            }
            })
//            delete data.field.file;
//
//            let {ades,aimg,id}=data.field;
//            let xml=new XMLHttpRequest();
//            xml.open('post','/admin/about/action.php');
//            xml.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
//            xml.responseType='json';
//            xml.send(`ades=${ades}&aimg=${aimg}&id=${id}`);
//            xml.onreadystatechange=function () {
//                if(xml.readyState==4){
//                    if(xml.status==200){
//                       let data =xml.response;
//                        if(data.code===200){
//                            layer.msg(res.msg,{icon:1,time:600})
//                        }else{
//                            layer.msg(data.msg,{icon:2,time:600})
//                        }
//                    }
//                }
//            }
            return false;
        })
    })
</script>
<?php
include '../footer.php';
?>


