<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Base
{
    public function index()
    {
        $banner=Db::table('slider')->order('id','desc')->select();
        $this->assign('banner',$banner);
        $this->assign('nid',0);
        return $this->fetch();
    }
    public function nav(){
        $nid=$this->request->get('nid');
        $navinfo=Db::table('nav')->where('id',$nid)->find();
        $this->assign('nid',$nid);
        $tpl=substr($navinfo['url'],0,-5);
        switch ($nid){
            case 19:
                $team=Db::table('team')->order('id','asc')->select();
                $this->assign('team',$team);
                break;
            case 21:
                $category=[['id'=>0,'username'=>'全部']];
                $category1=Db::table('types')->order('id','asc')->select();
                $product=Db::table('goods')->order('ids','desc')->select();
                $category=array_merge($category,$category1);
                $goods=[];
                $goods[0]=$product;
                for($i=1;$i<count($category);$i++){
                    $arr=[];
                    $typeid=$category[$i]['id'];
                    for($j=0;$j<count($product);$j++){
                        if ($product[$j]['typeid']==$typeid){
                            array_push($arr,$product[$j]);
                        }
                    }
                    array_push($goods,$arr);
                }
                $this->assign('category',$category);
                $this->assign('goods',$goods);
                break;
            case 23:
                $service=Db::table('service')->order('id','asc')->select();
                $this->assign('service',$service);
                break;
            case 22:

                break;
            case 20:

                break;
        }
        return $this->fetch($tpl);
    }

    public function order(){
        return $this->fetch();
    }
    public function detalis(){
        $id=$this->request->get('did');
        $this->assign("nid",21);
        $model=model('Products');
        $result=$model->edits(['ids'=>$id]);
        $result['banner']=explode(',',$result['img2']);
        $this->assign('goods',$result);
        return $this->fetch();
    }

    public function news1(){
        $id=$this->request->post('id');
        $result=Db::table('news')->where('id',$id)->find();
        return json($result);
    }
//    新闻翻页
    public function knowledge(){
        $this->assign('nid',22);
        $id=$this->request->get('kid');
        $data=Db::table('news')->where('id',$id)->find();
        $this->assign('news',$data);
        $pre=Db::table('news')->where('id','<',$id)->order('id','desc')->select();
        if($pre){
            $preData=$pre[0];
        }else{
            $preData['title']='没有了';
            $preData['id']=0;
        }
        $this->assign('pre',$preData);
        $next=Db::table('news')->where('id','>',$id)->order('id','asc')->select();
        if($next){
            $nextData=$next[0];
        }else{
            $nextData['title']='没有了';
            $nextData['id']=0;
        }
        $this->assign('next',$nextData);
        return $this->fetch('knowledge');
    }
}
