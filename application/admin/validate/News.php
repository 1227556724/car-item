<?php


namespace app\admin\validate;


use think\Validate;

class News extends Validate
{
    protected  $rule=[
        'title'=>'require|max:30',
        'content'=>'require',
        'id'=>'require'
    ];
    protected $message=[
        'title.require'=>'标题名称不能为空',
        'title.max'=>'标题名称最多30位',
        'content.require'=>'内容不能为空',
        'id.require'=>'ID必填'
    ];
    protected $scene=[
        'add'=>['title','content'],
        'del'=>['id'],
        'sort'=>['id'],
        'sort1'=>['id']
    ];
}