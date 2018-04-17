<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/8
 * Time: 16:59
 */
namespace app\Admin\controller;
use app\admin\model\Article as ArticleModel;
use think\Loader;
use think\Request;


class Article extends Base
{
    public function lst()
    {
        $list = ArticleModel::paginate(3);
        $this->assign('list',$list);
        return $this->view->fetch();
    }

    public function add(Request $request)
    {
        if($request->isPost()){
            $data = [
                'title' => input('title'),
                'author' => input('author'),
                'desc' => input('desc'),
                'keywords' => str_replace('，',',',input('keywords')),
                'content' => input('content'),
                'cateid' => input('cateid'),
            ];
            //state选择on,返回on,选择off,没有返回什么
            if(input('state') == 'on'){
                $data['state'] = 1;
            }else{
                $data['state'] = 0;
            }
            if($_FILES['pic']['tmp_name']){
                $file = $request->file('pic');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                $data['pic']='/uploads/'.$info->getSaveName();
            }
            $validate = Loader::validate('Article');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());die;
            }
            $article = new ArticleModel();
            if($article->save($data)){
                return $this->success('添加文章成功！','lst');
            }else{
                return $this->error('添加文章失败！');
            }

            return;
        }
        $cateres = db('cate')->select();
        $this->assign('cateres',$cateres);
        return $this->view->fetch();
    }

    public function edit(Request $request)
    {
        $id = input('id');
        $articles = ArticleModel::get($id);
        if($request->isPost()){
            $data = [
                'id' => input('id'),
                'title' => input('title'),
                'author' => input('author'),
                'desc' => input('author'),
                'desc' => input('desc'),
                'keywords' => input('keywords'),
                'content' => input('content'),
                'cateid' => input('cateid'),
            ];
            if(input('state') == 'on'){
                $data['state'] = 1;
            }else{
                $data['state'] = 0;
            }
            if($_FILES['pic']['tmp_name']){
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                $data['pic']='/uploads/'.$info->getSaveName();
            }
            $validate = \think\Loader::validate('Article');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError()); die;
            }
            $article = new ArticleModel();
            if($article->save($data,['id'=>$id])){
                $this->success('修改文章成功！','lst');
            }else{
                $this->error('修改文章失败！');
            }
            return;
        }
        $cateres = db('cate')->select();
        $this->assign('cateres',$cateres);
        $this->assign('articles',$articles);
        return $this->view->fetch();
    }

    public function del()
    {
        $id = input('id');
        if(ArticleModel::destroy($id)){
            $this->success('删除文章成功！','lst');
        }else{
            $this->error('删除文章失败！');
        }
    }
}