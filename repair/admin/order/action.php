<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/19
 * Time: 18:02
 */
header('Content-type:text/html;charset=utf8');
include '../../config/db.php';
$type=$_GET['type'];
switch($type){
//    case "add":
//        $serice=$_POST['serve'];
//        $time=date("Y-m-d");
//        $name=$_POST['username'];
//        $sex=$_POST['sex'];
//        $phone=$_POST['phone'];
//        $text=$_POST['text'];
//        $sql="insert into orders(serve,times,username,sex,phone,explain) values('$serice','$time','$name','$sex','$phone','$text') ";
//        $result=$mysql->query($sql);
//        var_dump($sql);
//        if($mysql->affected_rows){
//            $data=[
//                "code"=>200,
//                "msg"=>"添加成功",
//            ];
//        }else{
//            $data=[
//                "code"=>400,
//                "msg"=>"添加失败",
//            ];
//        }
////        echo json_encode($data);
//        break;
    case "find":
        $page=$_GET['page'];
        $limit=$_GET['limit'];
        $pagetoo=($page-1)*$limit;
//        读取数据库数据
        $sql="select * from orders order by id desc limit $pagetoo,$limit";
        $result=$mysql->query($sql);
        $data=$result->fetch_all(MYSQLI_ASSOC);
//        读取数据的总长度
        $sqlL="select count(*) tot from orders ";
        $resultL=$mysql->query($sqlL);
        $dataL=$resultL->fetch_all(MYSQLI_ASSOC);
        $start=$dataL[0]['tot'];
        if($mysql->affected_rows){
            $data0=[
                "code"=>0,
                "msg"=>"",
                "count"=>$start,
                "data"=>$data,
            ];
        }else{
            $data0=[
                "code"=>1,
                "msg"=>"请求失败",
            ];
        }
        echo json_encode($data0);
        break;
    case "del";
        $id=$_GET['id'];
        $sql="delete from orders where id='$id'";
        $result=$mysql->query($sql);
        if($mysql->affected_rows){
            $data=[
                "code"=>200,
                "msg"=>"删除成功"
            ];
        }else{
            $data=[
                "code"=>400,
                "msg"=>"删除失败"
            ];
        }
        echo json_encode($data);
        break;
}