<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/8
 * Time: 17:04
 */
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;

class Article extends Model
{
    //软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';

    public function getStateAttr($value)
    {
        $state = [1 => '推荐',0 => '不推荐'];
        return $state[$value];
    }


    public function cate()
    {
        return $this->belongsTo('cate','cateid');
    }

}
