<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/8
 * Time: 11:04
 */
namespace app\admin\controller;

use app\admin\model\Admin;
use think\Controller;
use think\Request;

class Login extends Controller
{
    //登录方法
    public function index(Request $request)
    {
        if($request->isPost()){
            $admin = new Admin();
            $data = input('post.');
            $num = $admin->login($data);
            if($num == 3){
                $this->success('信息正确，正在为你跳转...','index/index');
            }elseif ($num == 4){
                $this->error('验证码错误');
            }else{
                $this->error('用户名或者密码错误');
            }
        }
        return $this->view->fetch();
    }
}