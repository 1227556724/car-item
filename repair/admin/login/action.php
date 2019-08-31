<?php
header('Content-type:text/html;charset:utf8');
include'../../config/db.php';
//验证请求方式、验证请求参数
//接受数据
if($_SERVER['REQUEST_METHOD']!='POST'){
    echo json_encode([
        "code"=>400,
        "msg"=>"登录失败"
    ]);
    exit;
}
$sq=$_POST;
if(!isset($sq['username'])||empty($sq['username'])){
    echo json_encode([
        "code"=>400,
        "msg"=>"用户名必填"
    ]);
    exit;
}
if(!isset($sq['password'])||empty($sq['password'])){
    echo json_encode([
        "code"=>400,
        "msg"=>"用户名必填"
    ]);
    exit;
}
$username=$_POST['username'];
$password=$_POST['password'];
$sql="select * from admin where username='$username'";

$result=$mysql->query($sql)->fetch_all(MYSQLI_ASSOC);
if(count($result)){
    for($i=0;$i<count($result);$i++){
        $data=$result[$i];
        if(md5($password)==$data['password']){
            session_start();
            $_SESSION['id']=$data['id'];
            $_SESSION['username']=$data['username'];
            echo json_encode([
                "code"=>200,
                "msg"=>"登录成功"
            ]);
            exit;
        }echo json_encode([
            "code"=>400,
            "msg"=>"密码错误"
        ]);

    }

}else{
    echo json_encode([
        "code"=>400,
        "msg"=>"用户不存在"
    ]);
}

//接受前台
//获取数据库的用户名密码
//拿到后进行比较