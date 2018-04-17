<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/13
 * Time: 11:51
 */
namespace app\admin\controller;
use app\admin\model\Role as RoleModel;
use think\Loader;
use think\Request;

class Role extends Base
{
    public function lst()
    {
        //获取角色信息
        $roles = RoleModel::paginate(3);
        $this->assign('roles',$roles);
        return $this->view->fetch();
    }

    //权限分配
    public function distribute($id)
    {
        $role = new RoleModel();
        //两个逻辑：展示和收集
        if($this->request->isPost()){
            if(!empty($_POST)){
                //$_POST需要二期制作才可以写入数据库
                $z = $role->saveAuth($id,$_POST['id']);
                if($z){
                    $this->redirect('lst',array(),2,'分配权限成功');
                }else{
                    $this->redirect('distribute',array('id'=>$id),2,'分配权限失败');
                }
            }
        }else {
            //查询被分配权限的角色信息
            $role_info = RoleModel::get($id);

            //角色已经拥有的权限信息
            $have_auth = explode(',',$role_info['auth_ids']);

            //所有权限信息
            $auth_info_a = db('auth')->where('level=0')->select();
            $auth_info_b = db('auth')->where('level=1')->select();

            $this->assign('have_auth',$have_auth);
            $this->assign('auth_info_a', $auth_info_a);
            $this->assign('auth_info_b', $auth_info_b);
            $this->assign('role_info', $role_info);
            return $this->view->fetch();
        }
    }

    //角色添加
    public function add(Request $request)
    {
        if($request->isPost()){
            $data = [
                'name'=>input('name'),
            ];
            $validate = Loader::validate('Role');
            if(!$validate->scene('add')->check($data)){

                $this->error($validate->getError());die;
            }
            $role = new RoleModel;

            if($role->save($data)){
                return $this->success('添加角色成功！','lst');
            }else{
                return $this->error('添加角色失败');
            }
            return;
        }
        return $this->view->fetch();
    }


    //角色修改
    public function edit(Request $request)
    {
        $role = new RoleModel();
        $id = input('id');
        if($request->isPost()){
            $data = [
                'name' => input('name'),
            ];
            $validate = Loader::validate('Role');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());die;
            }
            $role = new RoleModel();

            if($role->save($data,array('id'=>$id))){
                return $this->success('修改角色成功！','lst');
            }else{
                return $this->error('修改角色失败！');
            }
            return;
        }
        $id = input('id');
        $info = $role->find($id);
        $this->assign('info',$info);
        return $this->view->fetch();
    }

    //角色删除
    public function delete()
    {
        $id = input('id');
        if(RoleModel::destroy($id)){
           return $this->success('删除角色成功！','lst');
        }else{
            return $this->error('删除角色失败！');
        }
        return $this->view->fetch();
    }

}