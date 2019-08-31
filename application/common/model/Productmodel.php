<?php


namespace app\common\model;


use think\Model;

class Productmodel extends Model
{
    protected $table='types';
    public function querys(){
        return $this->order('id','desc')->select();
    }
}