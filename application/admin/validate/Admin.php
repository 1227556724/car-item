<?php


namespace app\admin\validate;


use think\Validate;

class Admin extends Validate
{
    protected   $rule=[
        'username'=>'require|min:6|max:12',
        'password'=>'require|min:6|max:12',
        'repassword'=>'require|min:6|max:12|confirm:passowrd',
        'status'=>'require',
        'id'=>'require'
    ];
    protected $message=[
        'username.require'=>'用户名必填',
        'username.min'=>'用户不能少于6位',
        'username.max'=>'用户名不能超过12位',
        'password.require'=>'密码必填',
        'password.min'=>'密码不能少于6位数',
        'repassword.confirm'=>'两次密码输入必须一致',
        'password.max'=>'密码不能超过12位数',
        'status'=>'状态必选',
        'id'=>'id必填'
    ];
    protected $scene=[
        'add'=>['username','password','status'],
        'del'=>['id'],
    ];
}