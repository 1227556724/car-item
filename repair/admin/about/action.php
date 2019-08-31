<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/23
 * Time: 19:51
 */
//if($_SERVER['REQUEST_METHOD']!='POST'){
//    echo json_encode([
//        "code"=>400,
//        "msg"=>"请求格式错误"
//    ]);
//    exit;
//}
$data=$_POST;
//if(!(isset($data['id'])&&!empty($data['id']))||is_int($data['id'])){
//    echo json_encode([
//        "code"=>400,
//        "msg"=>'请求的ID错误'
//    ]);
//}
//if(!(isset($data['ades'])&&!empty($data['ades']))||is_string($data['ades'])){
//    echo json_encode([
//        "code"=>400,
//        "msg"=>'请求的ID错误'
//    ]);
//}
//if(!(isset($data['aimg'])&&!empty($data['aimg']))||is_int($data['aimg'])){
//    echo json_encode([
//        "code"=>400,
//        "msg"=>'请求的ID错误'
//    ]);
//}
header('Content-type:text/html;charset:utf8');
include '../../config/db.php';
$aimg=$data['aimg'];
$ades=$data['ades'];
$sql="update aboutus set ades='$ades',aimg='$aimg'";
$result=$mysql->query($sql);
if($result){
    echo json_encode([
        "code"=>200,
        "msg"=>'修改成功'
    ]);
}else{
    echo json_encode([
        "code"=>400,
        "msg"=>'修改失败'
    ]);
}
?>