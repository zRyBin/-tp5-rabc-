<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/8
 * Time: 16:13
 */
namespace app\admin\controller;
use app\admin\model\Cate as  CateModel;
use think\Loader;
use think\Request;

class Cate extends Base
{
    //分类列表
    public function lst()
    {
        $list = CateModel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch();
    }

    //分类添加
    public function add(Request $request)
    {
        if($request->isPost()){
            $data = [
                'catename' => input('catename'),
            ];
            $validate = Loader::validate('Cate');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());die;
            }
            $cate = new CateModel();
            if($cate->save($data)){
                return $this->success('添加成功！','lst');
            }else{
                return $this->error('添加失败！');
            }
            return;
        }
        return $this->fetch();
    }

    //分类修改
    public function edit(Request $request)
    {
        $id = input('id');
        $cates = CateModel::get($id);
        if($request->isPost()){
            $data = [
                'catename' => input('catename'),
            ];
            $validate = Loader::validate('Cate');
            if (!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());die;
            }
            $cate = new CateModel();
            if($cate->save($data,['id'=>$id])){
                return $this->success('修改成功！','lst');
            }else{
                return $this->error('修改失败！');
            }
            return;
        }
        $this -> assign('cates',$cates);
        return $this->view->fetch();
    }

    public function del()
    {
        $id = input('id');
        if($id != 1) {
            if (CateModel::destroy($id)) {
                $this->success('删除栏目成功！', 'lst');
            } else {
                $this->error('删除栏目失败！');
            }
        }else{
            $this->error('初始化的栏目不能删除！');
        }
    }


}