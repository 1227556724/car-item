<?php


namespace app\admin\validate;


use think\Validate;

class Order extends Validate
{
    protected $rules=[
        'serve'=>'require',
        'username'=>'require',
        'sex'=>'require',
        'phone'=>'require',
        'explain'=>'require',
        'vdate'=>'require'
    ];
    protected $message=[
        'serve.require'=>'预约服务必填',
        'username.require'=>'您的姓名必填',
        'sex.require'=>'您的性别必填',
        'phone'=>'您的电话必填',
        'explain.require'=>'补充说明必填',
        'vdate.require'=>'验证码必填'
    ];

}