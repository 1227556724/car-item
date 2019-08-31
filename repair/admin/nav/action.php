<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/19
 * Time: 15:10
 */
header('Content-type:text/html;charset=utf8');
include'../../config/db.php';

$type=$_GET['type'];

//var_dump($type);
switch ($type){
    case "add":
        $navname=$_POST['navname'];
        $url=$_POST['url'];
        $sort=$_POST['sort'];
        if($navname){
            if(strlen($navname)>=6&&strlen($navname)<=30){
                if($url){

                        $sql="select * from nav where navname='$navname'";
                        $result=$mysql->query($sql);
                        $datasql=$result->fetch_all(MYSQLI_ASSOC);
                        if(!$datasql){
                            $newsql="insert into nav(navname,url,sort) values('$navname','$url','$sort') ";
                            $newresult=$mysql->query($newsql);
                            if($newresult){
                                $data=[
                                    "code"=>200,
                                    "msg"=>"添加成功",
                                ];
                            }else{
                                $data=[
                                    "code"=>400,
                                    "msg"=>"添加失败",
                                ];
                            }
                        }else{
                            $data=[
                                "code"=>400,
                                "msg"=>"导航信息已经存在",
                            ];
                        }

                }else{
                    $data=[
                        "code"=>400,
                        "msg"=>"请输入url地址",
                    ];
                }
            }else{
                $data=[
                    "code"=>400,
                    "msg"=>"请输入6-30位字符",
                ];
            }
        }else{
            $data=[
                "code"=>400,
                "msg"=>"请输入正确的导航信息",
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
        $sql="select * from nav order by sort desc limit $pagetoo,$limit ";
        $result=$mysql->query($sql);
        $data=$result->fetch_all(MYSQLI_ASSOC);
//查找数据库的总长度
        $sqlL="select count(*) tot from nav ";
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
    case "sort":
        $id=$_GET["id"];
        $value=$_GET['value'];
        $sql="update nav set sort='$value' where id='$id'";
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
    case "del":
        $id=$_GET['id'];
        $sql="delete  from nav where id='$id'";
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
    case "edit":
        $id=$_GET['id'];
        $sql="select * from nav where id='$id'";
        $result=$mysql->query($sql);
        $data=$result->fetch_all(MYSQLI_ASSOC);
        $newdata=$data[0];
        echo json_encode($newdata);
        break;
    case "update":
        $id=$_POST['id'];
        $newdata=$_POST['newdata'];
        $name=$newdata['nameUpdate'];
        $url=$newdata['urlUpdate'];
        $sort=$newdata['sortupdate'];
        $sqlupdate="update nav set navname='$name',url='$url',sort='$sort' where id='$id'";
        $resultupdate=$mysql->query($sqlupdate);
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

}