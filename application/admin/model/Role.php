<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/12
 * Time: 12:22
 */
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;

class Role extends Model
{
    use SoftDelete;
    protected $delete_time = 'delete_time';

    //权限分配，收集信息，二期制作，存储信息
    function saveAuth($role_id,$authids)
    {
        //1,数组authids变为字符串authid
        $authid_str = implode(',',$authids);
        //2,根据字符串的authid信息，查询对应的“控制器-操作方法”
        $authinfo = db('auth')->select($authid_str);
        $s = "";
        foreach ($authinfo as $k=>$v){
            if(!empty($v['model']) && !empty($v['action'])){
                $s .= $v['model']."-".$v['action'].",";
            }
        }
        $s = rtrim($s,',');
        $sql = "update tp_role set auth_ids='$authid_str',auth_am='$s' where id='$role_id'";
        return $this->execute($sql);
    }

}