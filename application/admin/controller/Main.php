<?php


namespace app\admin\controller;

use think\Session;
class Main extends Base
{
    public function _initialize(){
        parent::_initialize();
    }
    public function index(){
        return $this->fetch();
    }
    public function  back(){
         Session::clear();
         return $this->redirect('/pastry/public/admin/login/index');
    }
}