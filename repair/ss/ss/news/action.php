<?php
include "../../config/db.php";
$type=$_GET['type'];

switch($type){
    case 'find':
        $limit=$_GET['limit'];
        $page=$_GET['page'];
        $start=($page-1)*$limit;

        $sql="select * from news order by id desc limit $start,$limit";
        $result=$mysql->query($sql);
        $data=$result->fetch_all(MYSQLI_ASSOC);

        $sqlTol="select count(*) from news";
        $resultTol=$mysql->query($sqlTol);
        $dataTol=$resultTol->fetch_all(MYSQLI_ASSOC);
        $num=$dataTol[0]['count(*)'];

        if($result){
            $datas=[
                'code'=>0,
                'msg'=>'',
                'count'=>$num,
                'data'=>$data
            ];
        }else{
            $datas=[
                'code'=>404,
                'msg'=>'数据获取失败',
            ];
        }

        echo json_encode($datas);
        break;

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

    case 'delete':
        $id=$_GET['id'];
        $sql="delete from news where id='$id'";
        $result=$mysql->query($sql);
        if($mysql->affected_rows){
            $data=[
                'code'=>200,
                'msg'=>'删除成功'
            ];
        }else{
            $data=[
                'code'=>404,
                'msg'=>'删除失败'
            ];
        }
        echo json_encode($data);
        break;

    case 'select':
        $id=$_GET['id'];
        $sql="select * from news where id='$id'";
        $result=$mysql->query($sql);
        $data=$result->fetch_all(MYSQLI_ASSOC);
//        var_dump($data[0]);
        echo json_encode($data[0]);
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