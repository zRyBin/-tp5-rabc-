<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/8
 * Time: 16:25
 */
namespace app\admin\validate;
use think\Validate;

class Cate extends Validate
{
    protected $rule = [
        'catename' => 'require|max:25|unique:cate'
    ];

    protected $message = [
        'catename.require' => '分类名称必须填写',
        'catename.max' => '分类名称不能超过25位',
        'catename.unique' => '分类名称不能重复',
    ];

    protected $scene = [
        'add' => ['catename'=>'require|unique:cate'],
        'edit' => ['catename'=>'require|unique:cate'],
    ];
}