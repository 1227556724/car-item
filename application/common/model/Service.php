<?php


namespace app\common\model;


use think\Model;

class Service extends Model
{
    protected  $table='service';
    public function add($data){
        return $this->allowField(true)->isUpdate(false)->save($data);
    }
//    查询多条数据
    public function finds($data,$page,$limit){
        return $this->where($data)->order('id','desc')->page($page,$limit)->select();
    }
//    查询数据的总长度
    public function counts($data){
        return $this->where($data)->count();
    }
//    删除一条数据
    public function dels($id){
        return $this->where($id)->delete();
    }
//    查询一条数据
    public function edits($id){
        return $this->where($id)->find();
    }
//    更新数据
    public function updates($data){
        $id=$data['id'];
        unset($data['id']);
        return $this->allowField(true)->isUpdate(true)->save($data,['id'=>$id]);
    }
}