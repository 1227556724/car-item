<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/19
 * Time: 18:02
 */
header('Content-type:text.html;charset=utf8');
include "../../config/db.php";
$type=$_GET['type'];
//var_dump($type);
switch($type){
    case 'add':
        $img=$_POST['img'];
        $sort=$_POST['sort'];

                $sql="select * from slider where img='$img'";
                $result=$mysql->query($sql);
                $datasql=$result->fetch_all(MYSQLI_ASSOC);
                    $newsql="insert into slider(img,sort) values ('$img','$sort')";
                    $newresult=$mysql->query($newsql);
//                    var_dump($newresult);
                    if($mysql->affected_rows){
                        $data=[
                            "code"=>200,
                            "msg"=>"插入成功",
                        ];
                    }else{
                        $data=[
                            "code"=>400,
                            "msg"=>"插入失败",
                        ];
                    }

        echo json_encode($data);
        break;
    case 'find':
        $page=$_GET['page'];
        $limit=$_GET['limit'];
        $pagetoo=($page-1)*$limit;
        $sql="select * from slider order by sort desc limit $pagetoo,$limit";
        $result=$mysql->query($sql);
        $data=$result->fetch_all(MYSQLI_ASSOC);
//        查找数据库的总长度
        $sqlL="select count(*) tot from slider ";
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
                "msg"=>"获取数据失败",
            ];
        }
        echo json_encode($data0);
        break;
    case 'sort':
        $id=$_GET['id'];
        $sort=$_GET['value'];
        $sql="update slider set sort='$sort' where id='$id'";
        $result=$mysql->query($sql);
        if($mysql->affected_rows){
            $data=[
                "code"=>200,
                "msg"=>"修改成功",
            ];
        }else{
            $data=[
                "code"=>400,
                "msg"=>"修改失败",
            ];
        }
        echo json_encode($data);
        break;
    case 'del':
        $id=$_GET['id'];
        $sql="delete  from slider where id='$id'";
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
    case 'query':
    $id=$_GET['id'];
    $sql="select * from slider where id='$id'";
    $result=$mysql->query($sql);
    $data=$result->fetch_all(MYSQLI_ASSOC);
    $newdata=$data[0];
    echo json_encode($newdata);
        break;
    case 'update':
        $id=$_POST['id'];
        $newimg=$_POST['data'];
        $img=$newimg['editimg'];
        $sql="update slider set img='$img' where id='$id'";
        $result=$mysql->query($sql);
        if($result){
            $data=[
                "code"=>200,
                "msg"=>"修改成功",
            ];
        }else{
            $data=[
                "code"=>400,
                "msg"=>"修改失败",
            ];
        }
        echo json_encode($data);
        break;
}