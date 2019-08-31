<?php


namespace app\admin\controller;


use think\Controller;
use think\Session;

class Base extends  Controller
{
    public function _initialize()
    {
        parent::_initialize();
        if(!Session::has('id') || !Session::has('username')){
            $this->error('请先登录','/admin/login/index');
            exit();
        }
        $this->assign('id',Session::get('id'));
        $this->assign('username',Session::get('username'));

    }
}