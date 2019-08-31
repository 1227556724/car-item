<?php


namespace app\common\model;


use think\Model;

class Slider extends Model
{
    protected $table='slider';
//    插入数据库
    public  function inserts($data){
        return $this->isUpdate(false)->save($data);
    }
//    查询多条数据
    public function finds($data,$page,$limit){
        return $this->where($data)->order('sort','desc')->page($page,$limit)->select();
    }
//    查询长度
    public function counts($data){
        return $this->where($data)->count();
    }
    //    查询单条数据
    public function edits($id){
        return $this->where($id)->find();
    }
//    删除数据
    public function deletes($arr){
        return $this->where($arr)->delete();
    }
//    修改数据
    public function updates($id,$img,$sort){
        return $this->isUpdate(true)->save($img,$sort,$id);
    }
//    修改单条数据
    public function sorts($id,$sort){
        return $this->isUpdate(true)->save($sort,$id);
    }
}