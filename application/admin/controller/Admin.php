<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/8
 * Time: 12:53
 */
namespace app\admin\controller;

use think\Loader;
use think\Request;
use app\admin\model\Admin as AdminModel;
use app\admin\model\Role as RoleModel;

class Admin extends Base
{
    //管理员列表
    public function lst()
    {
        //$list = AdminModel::paginate(3);
        $admin = new AdminModel;
        $list = $admin->paginate(3);
        $role = RoleModel::all();
        $this->assign('role',$role);
        $this->assign('list',$list);
        return $this->view->fetch();
    }

    //管理员添加
    public function add(Request $request)
    {
        if($request->isPost()){
            $data = [
                'username' => input('username'),
                'password' => md5(input('password')),
                'status' => input('status'),
                'role_id' => input('role_id')
            ];
            $validate = Loader::validate('Admin');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());die;
            }
            $admin = new AdminModel;
            if($admin->save($data)){
                return $this->success('添加管理员成功！','lst');
            }else{
                return $this->error('添加管理员失败');
            }
            return;
        }
        $role = RoleModel::all();
        $this->assign('role',$role);
        return $this->view->fetch();
    }

    //管理员修改
    public function edit(Request $request)
    {
        //获取id
        $id = input('id');
        $admins = db('admin')->find($id);
        if($request->isPost()){
            $data = [
                'username'=> input('username'),
                'status' => input('status'),
                'role_id' => input('role_id')
            ];
            if(input('password')){
                $data['password'] = md5(input('password'));
            }else{
                $data['password'] = $admins['password'];
            }
            $validate = Loader::validate('Admin');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());die;
            }
            $admin = new AdminModel;
            if($admin->save($data,['id'=>$id])){
                $this->success('修改管理员成功！','lst');
            }else{
                $this->error('修改管理员失败！');
            }
            return;
        }
        $role = RoleModel::all();
        $this->assign('role',$role);
        $this->assign('admins',$admins);
        return $this->view->fetch();
    }

    //管理员删除
    public function del()
    {
        $id = input('id');
        if($id != 1){
            if(AdminModel::destroy($id)){
                $this->success('删除管理员成功！','lst');
            }else{
                $this->error('删除管理员失败！');
            }
        }else{
            $this->error('初始化管理员不能删除！');
        }
    }

    //管理员退出
    public function logout()
    {
        session(null);
        $this->success('退出成功！','Login/index');
    }
}