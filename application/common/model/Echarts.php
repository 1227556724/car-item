<?php


namespace app\common\model;


use think\Model;

class Echarts extends Model
{
    protected $table='types';
    public function querys(){
        $data=$this->order('id','desc')->select();
        return $data;
    }
}