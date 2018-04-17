<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/9
 * Time: 12:18
 */
namespace app\admin\controller;
use think\Request;
use app\admin\model\Links as LinksModel;

class Links extends Base
{
    public function lst()
    {
        $list =LinksModel::paginate(3);
        $this->assign('list',$list);
        return $this->view->fetch();
    }

    public function add(Request $request)
    {
        if($request->isPost()){
            $data=[
                'title'=>input('title'),
                'url'=>input('url'),
                'desc'=>input('desc'),
            ];
            $validate = \think\Loader::validate('links');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError()); die;
            }
            $link = new LinksModel();
            if($link->save($data)){
                return $this->success('添加链接成功！','lst');
            }else{
                return $this->error('添加链接失败！');
            }
            return;
        }
        return $this->view->fetch();
    }

    public function edit()
    {
        $id=input('id');
        $links=db('links')->find($id);
        if(request()->isPost()){
            $id = input('id');
            $data=[
                'title'=>input('title'),
                'url'=>input('url'),
                'desc'=>input('desc'),
            ];
            $validate = \think\Loader::validate('links');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError()); die;
            }
            $link = new LinksModel();
            if($link->save($data,['id'=>$id])){
                $this->success('修改链接成功！','lst');
            }else{
                $this->error('修改链接失败！');
            }
            return;
        }
        $this->assign('links',$links);
        return $this->fetch();
    }

    public function del()
    {
        $id=input('id');
        if(LinksModel::destroy($id)){
            $this->success('删除链接成功！','lst');
        }else{
            $this->error('删除链接失败！');
        }
    }
}