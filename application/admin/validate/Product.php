<?php


namespace app\admin\validate;


use think\Validate;

class Product extends Validate
{
    protected $rule=[
        'goodsname'=>'require|min:2',
        'market_price'=>'require|number',
        'price'=>'require|number',
        'stock'=>'require|number',
        'content'=>'require',
        'ids'=>'require',

    ];
    protected $message=[
        'goodsname.require'=>'产品名称必填',
        'goodsname.min'=>'产品名称最少两位',
        'market_price.require'=>'市场价必填',
        'market_price.number'=>'必须是数字',
        'price.require'=>'零售价必填',
        'price.number'=>'必须是数字',
        'content.require'=>'产品详情必填',
    ];
    protected $scene=[
        'del'=>['ids'],
        'edit'=>['ids']
    ];

}