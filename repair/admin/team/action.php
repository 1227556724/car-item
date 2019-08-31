<?php
header('Content-type:text/html;charset=utf8');
include '../../config/db.php';

$type=$_GET['type'];
switch($type){
    case 'add':
        $img=$_POST['img'];
        $name=$_POST['name'];
        $position=$_POST['position'];

            $newsql="select * from team where head_img='$img'";
            $newresult=$mysql->query($newsql);
            $newdata=$newresult->fetch_all(MYSQLI_ASSOC);
                $sql="insert into team(head_img,teamname,positions) values('$img','$name','$position')";
                $result=$mysql->query($sql);
                if($mysql->affected_rows){
                    $data0=[
                        "code"=>200,
                        "msg"=>"插入成功"
                    ];
                }else{
                    $data0=[
                        "code"=>400,
                        "msg"=>"插入图片失败"
                    ];
                }

        echo json_encode($data0);
        break;
    case 'find':
        $page=$_GET['page'];
        $limit=$_GET['limit'];
        $pagetoo=($page-1)*$limit;
        $sql="select * from team order by id desc limit $pagetoo,$limit";
        $result=$mysql->query($sql);
        $data=$result->fetch_all(MYSQLI_ASSOC);
//        获取数据总长度
        $sqlL="select count(*) tot from team";
        $resultL=$mysql->query($sqlL);
        $dataL=$resultL->fetch_all(MYSQLI_ASSOC);
        $start=$dataL[0]['tot'];
        if($data){
            $data0=[
                "code"=>0,
                "msg"=>"",
                "count"=>$start,
                "data"=>$data,
            ];
        }else{
            $data0=[
                "code"=>1,
                "msg"=>"请求数据失败",
            ];
        }
        echo json_encode($data0);
        break;
    case 'del':
        $id=$_GET['id'];
        $sql="delete from team where id='$id'";
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
    case 'edit':
        $id=$_GET['id'];
        $sql="select * from team where id='$id'";
        $result=$mysql->query($sql);
        $data=$result->fetch_all(MYSQLI_ASSOC);
        $newdata=$data[0];
        echo json_encode($newdata);
        break;
    case 'update':
        $id=$_POST['id'];
        $data=$_POST['data'];
        $img=$data['editimg'];
        $name=$data['editname'];
        $position=$data['editposition'];
        $sql="update team set head_img='$img',teamname='$name',positions='$position' where id='$id'";
        $result=$mysql->query($sql);
        if($mysql->affected_rows){
            $data0=[
                "code"=>200,
                "msg"=>"修改成功",
            ];
        }else{
            $data0=[
                "code"=>400,
                "msg"=>"修改失败",
            ];
        }
         echo json_encode($data0);
        break;
}