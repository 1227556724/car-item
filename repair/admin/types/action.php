<?php
header('Content-type:text/html;charset=utf8');
include '../../config/db.php';
$type=$_GET['type'];

switch ($type){
    case "add":
        //接受数据
        $name =$_POST["name"];
//var_dump($name);
        if ($name){
            if(strlen($name)>=6&&strlen($name)<=30){
//                        验证产品是否存在
                $sql="select * from types where username='$name' ";
                $result=$mysql->query($sql);
                $datasql=$result->fetch_all(MYSQLI_ASSOC);
//        var_dump($datasql);
                if(!$datasql){
                    $datamysql="insert into types(username) value ('$name')";
                    $resultAdmin=$mysql->query($datamysql);
                    $data=[
                        "code"=>200,
                        "msg"=>"产品添加成功"
                    ];
                }else{
                    $data=[
                        "code"=>400,
                        "msg"=>"产品已经存在"
                    ];
                }
            }else{
                $data=[
                    "code"=>400,
                    "msg"=>"请输入6-30位字符"
                ];
            }
        }else {
            $data=[
                "code"=>400,
                "msg"=>"请输入正确的产品详情"
            ];
        }
        echo json_encode($data);
        break;
    case "find":
        //拿到当前显示的页数
        $page=$_GET['page'];
//var_dump($page);
//拿到每页显示的条数
        $limit=$_GET['limit'];
//页数是可变的
        $pagetoo=($page-1)*$limit;
        $sql="select * from types order by id desc limit $pagetoo,$limit ";
        $result=$mysql->query($sql);
        $data=$result->fetch_all(MYSQLI_ASSOC);
//var_dump($data);
//查数据表总长度
        $sqltop='select count(*) tot from admin';
        $resulttop=$mysql->query($sqltop);
        $datatop=$resulttop->fetch_all(MYSQLI_ASSOC);
        $start=$datatop[0]['tot'];
        if($data){
            $data0=[
                "code"=>0,
                "msg"=>"数据请求成功",
                "count"=>$start,
                "data"=>$data,
            ];
        }else{
            $data0=[
                "code"=>1,
                "msg"=>"数据请求失败",
            ];
        }
        echo json_encode($data0);
        break;
    case "del":
        $id=$_GET['id'];
        $sql="delete from types where id='$id' ";
        $reuslt=$mysql->query($sql);
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
    case "edit":
        $id=$_GET['id'];
        $sql="select * from types  where id='$id'";
        $reuslt=$mysql->query($sql);
        $data=$reuslt->fetch_all(MYSQLI_ASSOC);
        $newdata=$data[0];
        echo json_encode($newdata);
        break;
    case "update":
        $name =$_POST['newdata']['usernames'];
        $id=$_POST["id"];
        $sql="update types set username='$name' where id=$id";
        $result=$mysql->query($sql);
        if($mysql->affected_rows){
            $data=[
                "code"=>200,
                "msg"=>"修改成功",
            ];
        }else{
            $data=[
                "code"=>400,
                "msg"=>"产品已经存在",
            ];
        }
        echo json_encode($data);
        break;
}