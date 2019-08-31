<?php


namespace app\admin\validate;


use think\Validate;

class Slider   extends Validate
{
    protected  $rule=[
        'sort'=>'require|number',
        'id'=>'number'
    ];
    protected $message=[
        'sort.number'=>'必须是数字',
        'id'=>'必须是数字'
    ];
    protected $scene=[
        'add'=>['navname','url','sort'],
        'del'=>['id'],
        'sort'=>['id'],
        'sort1'=>['id'],
    ];
}