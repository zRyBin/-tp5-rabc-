<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/8
 * Time: 11:08
 */
namespace app\admin\model;

use think\captcha\Captcha;
use think\Db;
use think\Model;
use traits\model\SoftDelete;

class Admin extends Model
{
    //软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';

    //检验登录信息
    public function login($data)
    {
        $captcha = new Captcha();
        if(!$captcha->check($data['code'])){
            return 4;//验证码错误
        }
        $admin = Db::name('admin')->where('username','=',$data['username'])->where('status',1)->where('delete_time','NULL')->find();
        if($admin){
            if($admin['password'] == md5($data['password'])){
                session('username',$admin['username']);
                session('uid',$admin['id']);
                return 3;//信息正确
            }else{
                return 2;//密码错误
            }
        }else{
         return 1;//用户不存在
        }
    }

    public function getStatusAttr($value){
         $status=[
            '1'=>'启用',
            '0'=>'禁用',
        ];
         return $status[$value];
    }

    //定义关联查询
    public function role()
    {
        return $this->belongsTo('role','role_id');
    }


}
