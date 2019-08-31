<?php
namespace app\admin\validate;
use think\Validate;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/25
 * Time: 17:05
 */
class Login extends Validate
{
    protected   $rule=[
        'username'=>'require|min:6|max:12',
        'password'=>'require|min:6|max:12',
    ];
    protected $message=[
        'username.require'=>'用户名必填',
        'username.min'=>'用户不能少于6位',
        'username.max'=>'用户名不能超过12位',
        'password.require'=>'密码必填',
        'password.min'=>'密码不能少于6位数',
        'password.max'=>'密码不能超过12位数',
    ];
}