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
    case 'add':
        $title=$_GET['title'];
        $content=$_GET['content'];
        date_default_timezone_set("Asia/Shanghai");
        $date=date("Y-m-d");
        $time=date("H:i:s");
        $sqladd="insert into news(title,date,time,content) values('$title','$date','$time','$content')";
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
        $limit=$_GET['limit'];
        $pagetoo=($page-1)*$limit;
        $sql="select * from news order by id desc limit $pagetoo,$limit";
        $result=$mysql->query($sql);
        $data=$result->fetch_all(MYSQLI_ASSOC);
//        获取数据的总长度
        $sqlL="select count(*) tot from news";
        $resultL=$mysql->query($sqlL);
        $dataL=$resultL->fetch_all(MYSQLI_ASSOC);
        $newdata=$dataL[0]['tot'];
        if($data){
            $data0=[
                "code"=>0,
                "msg"=>"",
                "count"=>$newdata,
                "data"=>$data
            ];
        }else{
            $data0=[
                "code"=>1,
                "msg"=>"请求失败",
            ];
        }
        echo json_encode($data0);
        break;
    case "del":
        $id=$_GET['id'];
        $sql="delete from news where id='$id'";
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
    case 'update':
        $id=$_GET['id'];
        $title=$_GET['title'];
        $content=$_GET['content'];
        date_default_timezone_set("Asia/Shanghai");
        $date=date("Y-m-d");
        $time=date("H:i:s");
        $sqlEdit="update news set title='$title',content='$content',date='$date',time='$time' where id='$id'";
        $resultEdit=$mysql->query($sqlEdit);
        if($mysql->affected_rows){
            $datas=[
                'code'=>200,
                'msg'=>'修改成功'
            ];
        }else{
            $datas=[
                'code'=>400,
                'msg'=>'修改失败'
            ];
        }
        echo json_encode($datas);
        break;
}