<?php


namespace app\admin\controller;


use think\Exception;

class Service   extends Base
{
    public function addindex(){
        return $this->fetch();
    }
    public function index(){
        return $this->fetch();
    }
    public function add(){
        if(!$this->request->isPost()){
            return json([
                'code'=>config('code.fali'),
                'msg'=>'请求方式错误'
            ]);;
        }
        $data=$this->request->post();
        try{
            $model=model('Service');
            $result=$model->add($data);
            if($result){
                return json([
                    'code'=>config('code.success'),
                    'msg'=>'添加成功',
                ]);
            }else{
                return json([
                    'code'=>config('code.fali'),
                    'msg'=>'添加失败',
                ]);
            }
        }catch (Exception $exception){
            return json([
                'code'=>config('code.fali'),
                'msg'=>'添加失败',
            ]);
        }
    }
    public function find(){
        if(!$this->request->isGet()){
            return json([
                'code'=>config('code.fali'),
                'msg'=>'请求方式错误'
            ]);
        }
        $data=$this->request->get();
        if(!isset($data['page'])&&empty($data['page'])){
            $page=1;
        }else{
            $page=$data['page'];
        }
        if(!isset($data['limit'])&&empty($data['limit'])){
            $limit=1;
        }else{
            $limit=$data['limit'];
        }
        $sdata=[];
        try{
            $model=model('Service');
            $result=$model->finds($sdata,$page,$limit);
            $count=$model->counts($sdata);
            if($result){
                return json([
                    'code'=>0,
                    'msg'=>'',
                    'count'=>$count,
                    'data'=>$result
                ]);
            }else{
                return json([
                    'code'=>1,
                    'msg'=>'请求数据失败',
                ]);
            }
        }catch (Exception $exception){
            return json([
                'code'=>1,
                'msg'=>'请求数据失败',
            ]);
        }
    }
    public function del(){
        if(!$this->request->isPost()){
            return json([
                'code'=>config('code.fali'),
                'msg'=>'请求方式错误'
            ]);
        }
        $id=$this->request->post();
        try{
            $model=model('Service');
            $result=$model->dels($id);
            if($result){
                return json([
                    'code'=>config('code.success'),
                    'msg'=>'删除成功',
                ]);
            }else{
                return json([
                    'code'=>config('code.fali'),
                    'msg'=>'删除失败',
                ]);
            }

        }catch (Exception $exception){
            return json([
                'code'=>config('code.fali'),
                'msg'=>'删除失败',
            ]);
        }
    }
    public function edit(){
        if(!$this->request->isPost()){
            return json([
                'code'=>config('code.fali'),
                'msg'=>'请求方式错误'
            ]);
        }
        $id=$this->request->post();
        try{
            $model=model('Service');
            $result=$model->edits($id);
            if($result){
                return json([
                    'code'=>config('code.success'),
                    'msg'=>"数据获取成功",
                    'data'=>$result
                ]);
            }else{
                return json([
                    'code'=>config('code.fali'),
                    'msg'=>"数据获取失败",
                ]);
            }

        }catch (Exception $exception){
            return json([
                'code'=>config('code.fali'),
                'msg'=>"数据获取失败",
            ]);
        }

    }
    public function update(){
        if(!$this->request->isPost()){
            return json([
                'code'=>config('code.fali'),
                'msg'=>'请求方式错误'
            ]);
        }
        $data=$this->request->post();
        try{
            $model=model('Service');
            $result=$model->updates($data);
            if($result){
                return json([
                    'code'=>config('code.success'),
                    'msg'=>"修改成功",
                ]);
            }else{
                return json([
                    'code'=>config('code.fali'),
                    'msg'=>"修改失败",
                ]);
            }

        }catch (Exception $exception){
            return json([
                'code'=>config('code.fali'),
                'msg'=>"修改失败",
            ]);
        }
    }
}