<?php


namespace app\admin\validate;


use think\Validate;

class Team extends Validate
{
    protected $rule=[
        'teamname'=>'require|max:5',
        'positions'=>'require',
        'id'=>'require'

    ];
    protected $message=[
        'teamname.require'=>'姓名必填',
        'teamname.max'=>'不得超过五位',
        'id.require'=>'ID必填'
    ];
    protected $scene =[
        'del'=>['id'],
        'edit'=>['id']
    ];
}