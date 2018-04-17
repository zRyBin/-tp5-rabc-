<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/8
 * Time: 16:15
 */
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;

class Cate extends Model
{

    //软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
}
