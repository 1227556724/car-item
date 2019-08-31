<?php


namespace app\common\model;


use think\Model;

class About extends Model
{
    protected $table='aboutus';
    //    添加数据
    public function inserts($data){
        return $this->allowField(true)->isUpdate(false)->save($data);
    }
//    读取多条数据
    //    查询多条数据
    public function finds(){
        return $this->order('id','desc')->select();
    }
//    删除数据
    public function dels($id){
        return $this->where($id)->delete();
    }
//    查询一条数据
    public function edits($id){
        return $this->where($id)->find();
    }
//    修改数据
    public function updates($data){
        $id=$data['id'];
        unset($data['id']);
        return $this->allowField(true)->isUpdate(true)->save($data,['id'=>$id]);
    }

}