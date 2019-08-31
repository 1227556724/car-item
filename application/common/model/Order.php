<?php


namespace app\common\model;


use think\Model;

class Order extends Model
{
    protected $table='orders';
    public function inserts($data){
        return $this->allowField(true)->isUpdate(false)->save($data);
    }
    public function querys($sdata,$page,$limit){
        return $this->where($sdata)->order('id','desc')->page($page,$limit)->select();
    }
    public function counts($sdata){
        return $this->where($sdata)->count();
    }
}