<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/8
 * Time: 15:00
 */
namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
    //验证规则
    protected $rule = [
        'username' => 'require|max:25|unique:admin',
        'password' => 'require',
        'status' => 'require',
        'role_id' => 'require'
    ];

    protected $message = [
        'username.require' => '管理员名称必须填写',
        'username,max' => '管理员名称的长度不得大于25位',
        'username.unique' => '管理员名称不得重复',
        'password.require' => '管理员密码必须填写',
        'status.require' => '管理员状态必须填写',
        'role_id.require' => '角色必须选择'
    ];

    //验证场景
    protected $scene = [
        'add' => ['username'=>'require|unique:admin','password','status','role_id'],
        'edit' => ['username'=>'require|unique:admin'],
    ];
}