<?php
include "../../config/db.php";
$type=$_GET['type'];

switch($type){
    case 'add':
        $name=$_GET['name'];
        $typeid=$_GET['typeid'];
        $img1=$_GET['img1'];
        $img2=$_GET['img2'];
        $market_price=$_GET['market_price'];
        $price=$_GET['price'];
        $stock=$_GET['stock'];
        $content=$_GET['content'];
        $sqladd="insert into goods(goodsname,img1,img2,market_price,price,stock,content,typeid) values('$name','$img1','$img2','$market_price','$price','$stock','$content','$typeid')";
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

    case 'find':
        $limit=$_GET['limit'];
        $page=$_GET['page'];
        $start=($page-1)*$limit;

        $sql="select * from goods order by id desc limit $start,$limit";
        $result=$mysql->query($sql);
        $data=$result->fetch_all(MYSQLI_ASSOC);

        $sqlTol="select count(*) from goods";
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

    case 'delete':
        $id=$_GET['id'];
        $sql="delete from goods where id='$id'";
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

}
