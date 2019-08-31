<?php
header('Content-type:text/html;charset=utf8');
include '../../config/db.php';
$type=$_GET['type'];

switch ($type){
    case "add":
        $username=$_POST['username'];
        $password=$_POST['password'];
        $repass=$_POST['repassword'];
        $status=$_POST['status'];
        if ($username){
            if(strlen($username)>=6&&strlen($username)<=12){
                if($password){
                    if(strlen($password)>=6&&strlen($password)<=12){
                        if($password==$repass){
//                        验证用户是否存在
                            $sql="select * from admin where username='$username' ";
                            $result=$mysql->query($sql);
                            $datasql=$result->fetch_all(MYSQLI_ASSOC);

                            if(!$datasql){
                                $time=date("Y-m-d H:i:s");
//                            $time=time();
                                $password=md5($password);
                                $datamysql="insert into admin(username,password,status,time) value ('$username','$password','$status','$time')";
                                $resultAdmin=$mysql->query($datamysql);
                                $data=[
                                    "code"=>200,
                                    "msg"=>"添加成功"
                                ];
                            }else{
                                $data=[
                                    "code"=>400,
                                    "msg"=>"用户名已经存在"
                                ];
                            }
                        }else{
                            $data=[
                                "code"=>400,
                                "msg"=>"两次输入的密码不一致"
                            ];
                        }
                    }else{
                        $data=[
                            "code"=>400,
                            "msg"=>"请输入6-20位密码"
                        ];
                    }
                }else{
                    $data=[
                        "code"=>400,
                        "msg"=>"请输入密码"
                    ];
                }
            }else{
                $data=[
                    "code"=>400,
                    "msg"=>"请输入6-12位用户名"
                ];
            };
        }else {
            $data=[
                "code"=>400,
                "msg"=>"请输入用户名"
            ];
        }
        echo json_encode($data);
        break;
    case "find":
        //拿到当前显示的页数
        $page=$_GET['page'];
//拿到每页显示的条数
        $limit=$_GET['limit'];
//页数是可变的
        $pagetoo=($page-1)*$limit;
//接收数据库数据s
        $sql="select * from admin order by id desc limit $pagetoo,$limit";
        $result=$mysql->query($sql);
//var_dump($result);
        $data=$result->fetch_all(MYSQLI_ASSOC);
//查数据表总长度
        $sqltop='select count(*) tot from admin';
        $resulttop=$mysql->query($sqltop);
        $datatop=$resulttop->fetch_all(MYSQLI_ASSOC);
        $start=$datatop[0]['tot'];
//判断如果$data存在那就拿到数据进行渲染页面
        if($data){
            $data0=[
                "code"=>0,
                "msg"=>"",
                "count"=>$start,
                "data"=>$data
            ];
//    不存在请求错误
        }else{
            $data0=[
                "code"=>1,
                "msg"=>"数据请求错误",
            ];
        }
        echo json_encode($data0);
//关联数据->转为字符串格式
//前台转为json格式
        break;
    case "del":
        $id=$_GET["id"];
//var_dump($id);
        $sql ="DELETE FROM admin  WHERE id='$id'";
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
//var_dump($id);
        $sql="SELECT *  FROM admin where id='$id'";
        $result = $mysql->query($sql);
        $newresult=$result->fetch_all(MYSQLI_ASSOC);
        $newdata=$newresult[0];
//md5需要解密


//$password=$newresult[0]['password'];
        echo json_encode($newdata);

        break;
    case "status":
        //获取id
        $id=$_GET['id'];
        $state=$_GET['state'];
//var_dump($status);
//修改数据库
        $sql="update admin set status='$state' where id='$id'";

        $result=$mysql->query($sql);

//var_dump($mysql->affected_rows);
//判断当数据库影响一行的时候
        if($mysql->affected_rows){
            $data=[
                "code"=>200,
                "msg"=>'修改成功',
            ];
        }else{
            $data=[
                "code"=>404,
                "msg"=>'修改失败',
            ];
        }
        echo json_encode($data);
        break;
    case "update":
        break;

}

