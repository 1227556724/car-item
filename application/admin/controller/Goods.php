<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/25
 * Time: 11:40
 */

namespace app\admin\controller;


use think\Db;

class Goods
{
    public function index(){
        $data=Db::name('goods')->select();
//        var_dump($data);
        return view('index',['index'=>$data]);
    }
}