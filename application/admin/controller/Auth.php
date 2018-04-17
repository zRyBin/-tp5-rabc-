<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/16
 * Time: 14:20
 */
namespace app\admin\controller;

use app\admin\model\Auth as AuthModel;
use think\Loader;
use think\Request;

class Auth extends Base
{
    //列表展示
    public function lst()
    {
        //获取权限信息，展示给模板
        $info =AuthModel::paginate(10);
        $this->assign('info',$info);
        return $this->view->fetch();
    }

    //添加权限
    public function add(Request $request)
    {
        $auth = new AuthModel();
        if($request->isPost()){
            $validate = Loader::validate('auth');
            if(!$validate->scene('add')->check($_POST)){
                $this->error($validate->getError());die;
            }
            //全路径和等级字段数据需要二期制作
            $z = $auth->saveData($_POST);
            if($z){
                $this->redirect('lst',array(),2,'添加权限成功！');
            }else{
                $this->redirect('add',array(),2,'添加权限失败！');
            }
            return;
        }
        //获取用于选择的顶级权限
        $auth_info_a = $auth->where('level=0')->select();
        $this->assign('auth_info_a',$auth_info_a);
        return $this->view->fetch();
    }

    //修改权限
    public function edit(Request $request)
    {
        $id  = input('id');
        $auth = new AuthModel();
        if($request->isPost()){
            $data = [
                'name' => input('name'),
                'pid' => input('pid'),
                'model' => input('model'),
                'action' => input('action'),
            ];
            $validate = Loader::validate('auth');
            if(!$validate->scene('edit')->check($_POST)){
                $this->error($validate->getError());die;
            }
            //全路径和等级字段数据需要二期制作
            $z = $auth->updateData($data,$id);
            if($z){
                $this->success('修改成功！','lst');
            }else{
                $this->error('修改失败！');
            }
            return;
        }

        $info = AuthModel::get($id);
        $auth_info_a = $auth->where('level=0')->select();
        $this->assign('auth_info_a',$auth_info_a);
        $this->assign('info',$info);
        return $this->view->fetch();
    }

    //删除权限
    public function delete()
    {
        $id = input('id');
        if(AuthModel::destroy($id)){
            $this->success('删除成功！','lst');
        }else{
            $this->error('删除失败！');
        }
    }
}
