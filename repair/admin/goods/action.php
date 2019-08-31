<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/19
 * Time: 18:01
 */
header('Content-type:text/html;charset=utf8');
include '../../config/db.php';
$type=$_GET['type'];
switch($type){
    case "add":
        $name=$_GET['name'];
        $typeid=$_GET['typeid'];
        $img1=$_GET['img1'];
        $img2=$_GET['img2'];
        $market_price=$_GET['market_price'];
        $price=$_GET['price'];
        $stock=$_GET['stock'];
        $content=$_GET['content'];
        $sqladd="insert into goods(name,typeid,img1,img2,market_price,price,stock,content) values('$name','$typeid','$img1','$img2','$market_price','$price','$stock','$content')";
        $resultadd=$mysql->query($sqladd);
        if($resultadd){
            $data=[
                'code'=>200,
                'msg'=>'添加成功'
            ];
        }else{
            $data=[
                'code'=>404,
                'msg'=>'添加失败'
            ];
        }
        echo json_encode($data);
        break;
    case "find":
        $page=$_GET['page'];
//获取分页器
        $limit=$_GET['limit'];

        $pagetoo=($page-1)*$limit;
//获取数据
        $sql="select * from goods order by id desc limit $pagetoo,$limit ";
        $result=$mysql->query($sql);
        $data=$result->fetch_all(MYSQLI_ASSOC);
//查找数据库的总长度
        $sqlL="select count(*) tot from goods ";
        $resultL=$mysql->query($sqlL);
        $dataL=$resultL->fetch_all(MYSQLI_ASSOC);
        $newdataL=$dataL[0]['tot'];

        if($data){
            $data0=[
                "code"=>0,
                "msg"=>"",
                "count"=>$newdataL,
                "data"=>$data,
            ];
        }else{
            $data0=[
                "code"=>400,
                "msg"=>"数据请求失败",
            ];
        }
        echo json_encode($data0);
        break;
    case "del":
        $id=$_GET['id'];
        $sql="delete from goods where id='$id'";
        $result=$mysql->query($sql);
        if($mysql->affected_rows){
            $data=[
                "code"=>200,
                "msg"=>"删除成功",
            ];
        }else{
            $data=[
                "code"=>400,
                "msg"=>"删除失败",
            ];
        }
        echo json_encode($data);
        break;
}