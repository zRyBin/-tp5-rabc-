<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/9
 * Time: 11:26
 */
namespace app\admin\validate;
use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'title' => 'require|max:25',
        'cateid' => 'require',
    ];
    protected $message = [
        'title.require' => '文章标题必须填写',
        'title.max' => '文章标题长度不得大于25位',
        'cateid.require' => '请选择文章所属栏目',
    ];
    protected $scene = [
        'add' => ['title','cateid'],
        'edit' => ['title','cateid'],
    ];
}