<?php


namespace app\admin\controller;


use think\Controller;
use think\Exception;

class Upload extends Controller
{
    function index(){
        $file=$this->request->file('file');
        $info=$file->move(ROOT_PATH.'public'.DS.'uploads');
        try{
            if($info){
                return json([
                    'code'=>config('code.success'),
                    'msg'=>'图片上传成功',
                    'src'=>DS.'pastry'.DS.'public'.DS.'uploads'.DS.$info->getSaveName(),
                ]);
            }
        }catch(Exception $exception){
            return json([
                'code'=>config('code.fali'),
                'msg'=>'图片上传失败',
            ]);
        }
    }
    function files(){
        $file=$this->request->file('file');
        $info=$file->move(ROOT_PATH.'public'.DS.'uploads');
        try{
            if($info){
                return json([
                    'code'=>0,
                    'msg'=>'',
                    'data'=>[
                        'src'=>DS.'pastry'.DS.'public'.DS.'uploads'.DS.$info->getSaveName(),
                    ]
                ]);
            }
        }catch(Exception $exception){
            return json([
                'code'=>config('code.fali'),
                'msg'=>'图片上传失败',
            ]);
        }
    }
}