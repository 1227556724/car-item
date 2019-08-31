<?php


namespace app\admin\validate;


use think\Controller;
use think\Validate;

class Nav extends Validate
{
    protected  $rule=[
        'navname'=>'require|min:2|max:5',
        'url'=>'require',
        'sort'=>'require|number',
        'id'=>'require'
    ];
    protected $message=[
        'navname.require'=>'导航名称不能为空',
        'navname.min'=>'导航名称最少2位',
        'navname.max'=>'导航名称最多5位',
        'url'=>'导航地址不能为空',
        'sort'=>'必须是数字',
        'id'=>'id必填'
    ];
    protected $scene=[
        'add'=>['navname','url','sort'],
        'del'=>['id'],
        'sort'=>['id'],
        'sort1'=>['id']
    ];
}