<?php
namespace app\admin\controller;
//子模块  控制Login
//功能 方法（操作）check
//路由 一个概念规则，去找某一个方法或者功能
use think\Controller;
use think\Db;
use think\Session;

class Login extends Controller
{
    public function index()
    {
//        方法1
        return view();
    }

    public function check()
    {
//        验证请求的方式
        if (!$this->request->ispost()) {
            return json([
                "code" => 400,
                "msg" => "请求方式错误"
            ]);
        }
//        验证请求的参数
        $data = $this->request->post();
        $validate = validate('Login');
        if (!$validate->check($data)) {
            return json([
                "code" => 400,
//                将验证返回
                "msg" => $validate->getError(),
            ]);
        }
        // 业务逻辑
        $admin=Db::table('admin')->where('username',$data['username'])->find();
        if($admin){
            if(md5($data['password'])==$admin['password']){
                // 验证码
                $captcha=$data['captcha'];
                if($captcha){
                    if (captcha_check($captcha)){
                        Session::set('id',$admin['id']);
                        Session::set('username',$admin['username']);
                        return json([
                            'code'=>config('code.success'),
                            'msg'=>'登录成功'
                        ]);
                    }else{
                        return json([
                            'code'=>config('code.fail'),
                            'msg'=>'验证码错误'
                        ]);
                    }
                }else{
                    return json([
                        'code'=>config('code.fail'),
                        'msg'=>'请输入验证码'
                    ]);
                }
            }else{
                return json([
                    'code'=>config('code.fail'),
                    'msg'=>'密码错误'
                ]);
            }
        }else{
            return json([
                'code'=>config('code.fail'),
                'msg'=>'用户名不存在'
            ]);
        }
    }}