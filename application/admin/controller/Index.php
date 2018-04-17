<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/8
 * Time: 11:02
 */
namespace app\admin\controller;
use think\Request;

class Index extends Base
{
    public function index()
    {
      return $this->view->fetch();
    }
}