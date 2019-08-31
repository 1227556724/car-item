<?php


namespace app\common\model;


use think\Model;

class News  extends Model
{
    protected $table='news';
    protected $autoWriteTimestamp = true;
    //    添加数据
    public function inserts($data){
        $data['time']=date('Y-m-d',time());
        $data['date']=date('Y-m-d H:i:s',time());
        return $this->allowField(true)->isUpdate(false)->save($data);
    }
//    读取多条数据
    //    查询多条数据
    public function finds($data,$page,$limit){
        return $this->where($data)->order('id','desc')->page($page,$limit)->select();
    }
//    查询长度
    public function counts($data){
        return $this->where($data)->count();
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