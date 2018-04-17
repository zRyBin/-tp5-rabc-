<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/13
 * Time: 16:46
 */
namespace app\admin\validate;

use think\Validate;

class Role extends Validate
{
    protected $rule = [
        'name' => 'require|max:25|unique:role'
    ];
    protected $message = [
        'name.require' => '角色名称必须填写',
        'name.max' => '位数最大不能超过25位',
        'name.unique' => '角色名称不能重复'
    ];
    protected $scene = [
        'add' => ['name'=>'require|unique:role'],
        'edit' => ['name'=>'require|unique:role'],
    ];
}