<?php
header('Content-type:text/html;charset=utf8');
//通过post方式将图片传到后台
$file=$_FILES['file'];
//var_dump($_FILES);
//如果这个图片是上传的文件
if($file['error']>0){
    echo json_encode([
        "code"=>400,
        "msg"=>'上传失败，失败的状态码'.$file['error']
    ]);
}else{
    if(is_uploaded_file($file['tmp_name'])){
        $imgtype=$file['type'];
        $imgsize=$file['size'];
        if($imgtype=='image/jpg'||$imgtype=='image/jpeg'||$imgtype=='image/png'||$imgtype=='image/webp'||$imgtye=='image/JPG'){
            if($imgsize<=500*1024){
                //    判断本地的文件是否存在
                $pathname='../../upload';
                if(!file_exists($pathname)){
//        如果不存在那就创建一个新的文件夹
                    mkdir($pathname);
                }
                //        创建一个时间子文件夹
                $date=date('Y-m-d');
                $newdate=$pathname.'/'.$date;
                if(!file_exists($newdate)){
                    mkdir($newdate);
                }
//        用于截取图片的名称只需要后半段
                $ext=explode('/',$file['type']);
//        var_dump($ext[1]);
//    生成随机的时间戳
                $time=time().mt_rand(0,100);
//        生成图片的随机时间戳名称
                $imgname=$time.'.'.$ext[1];
//        图片存放的路径
                $movepath=$newdate.'/'.$imgname;
                $imgurl='/upload/'.$date.'/'.$imgname;
                if(move_uploaded_file($file['tmp_name'],$movepath)){
                    echo json_encode([
                        "code"=>200,
                        "msg"=>"上传成功",
                        "url"=>$imgurl
                    ]);
                }else{
                    echo json_encode([
                        "code"=>400,
                        "msg"=>"上传失败",
                    ]);
                }
            }else{
                echo json_encode([
                    "code"=>400,
                    "msg"=>"上传的文件太大了",
                ]);
            }
        }else{
            echo json_encode([
                "code"=>400,
                "msg"=>"上传正确格式的文件",
            ]);
        }
    }
}

