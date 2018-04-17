<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/8
 * Time: 10:58
 */
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Auth as AuthModel;

class Base extends Controller
{
    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        if (!session('username')){
            $this->error('请先登录系统！','Login/index');
        }
        $this->menu();
    }

    public function __construct(Request $request )
    {
        parent::__construct($request);
        //获取但却控制器-操作方法
        $nowac = strtolower($request->controller())."-".strtolower($request->action());
        //用户信息
        $admin_name = session('username');
        $admin_id = session('uid');
        $admin_info = db('admin')->find($admin_id);
        //角色信息
        $role_id = $admin_info['role_id'];
        $role_info = db('role')->find($role_id);

        //拥有权限
        $auth_ac = $role_info['auth_am'];


        //设置默认允许访问权限
        $allowac = "login-index,admin-logout,index-index";

        if(strpos($auth_ac,$nowac) === false && strpos($allowac,$nowac) === false && $admin_name!=='admin'){
            $this->error('没有访问权限');
        }

    }

    //根据权限定义菜单
    public function menu()
    {
        //用户id
        $admin_id = session('uid');
        //根据信息获取用户信息
        $admin_info = db('admin')->find($admin_id);
        //获取角色信息
        $role_id = $admin_info['role_id'];
        //获取角色信息
        $role_info = db('role')->find($role_id);

        //获取权限ids
        $auth_ids = $role_info['auth_ids'];
        //获取权限数据
        //顶级权限
        if($admin_id == 1){
            $auth_info_a = AuthModel::all(['level'=>0]);
            $auth_info_b = AuthModel::all(['level'=>1]);

        }else{
            $auth = new AuthModel();
            $auth_info_a = $auth ->where("level=0 and id in ($auth_ids)")->select();
            //次级权限
            $auth_info_b = $auth->where("level=1 and id in ($auth_ids)")->select();
        }
        //赋值给模板
        $this->assign('auth_info_a',$auth_info_a);
        $this->assign('auth_info_b',$auth_info_b);
        $this->view->fetch('common/left');
    }
}