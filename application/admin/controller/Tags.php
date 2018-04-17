<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/9
 * Time: 12:47
 */
namespace app\admin\controller;
use app\admin\model\Tags as TagsModel;

class Tags extends Base
{
    public function lst()
    {
        $list = TagsModel::paginate(3);
        $this->assign('list',$list);
        return $this->view->fetch();
    }

    public function add()
    {
        if(request()->isPost()){

            $data=[
                'tagname'=>input('tagname'),
            ];
            $validate = \think\Loader::validate('Tags');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError()); die;
            }
            $tag = new TagsModel();
            if($tag->save($data)){
                return $this->success('添加Tag标签成功！','lst');
            }else{
                return $this->error('添加Tag标签失败！');
            }
            return;
        }
        return $this->view->fetch();
    }

    public function edit()
    {
        $id=input('id');
        $Tags=db('Tags')->find($id);
        if(request()->isPost()){
            $data=[
                'id'=>input('id'),
                'tagname'=>input('tagname'),
            ];
            $validate = \think\Loader::validate('Tags');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError()); die;
            }
            $tag = new TagsModel();
            if($tag->save($data,['id'=>$id])){
                $this->success('修改Tag标签成功！','lst');
            }else{
                $this->error('修改Tag标签失败！');
            }
            return;
        }
        $this->assign('Tags',$Tags);
        return $this->view->fetch();
    }

    public function del()
    {
        $id=input('id');
        if(TagsModel::destroy($id)){
            $this->success('删除Tag标签成功！','lst');
        }else{
            $this->error('删除Tag标签失败！');
        }
    }

}
