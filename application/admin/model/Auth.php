<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/16
 * Time: 15:17
 */
namespace app\admin\model;
 use think\Model;
 use traits\model\SoftDelete;

 class Auth extends Model
 {

     //软删除
     use SoftDelete;
     protected $deleteTime = 'delete_time';

     //全路径和等级二期制作
     public function saveData($data)
     {
         //插入新纪录
         if($this->save($data)){
             $new_id = $this->id;
         }
         //制作全路径
         if($data['pid'] == 0){//顶级权限
             $path = $new_id;
         }else{
             //次级权限
             $p_info = $this->find($data['pid']);
             $p_path = $p_info['path'];
             $path = $p_path.'-'.$new_id;
         }
         //制作等级
         $level = substr_count($path,'-');
         $sql = "update tp_auth set path='$path',level='$level' where id='$new_id'";
         return $this->execute($sql);
     }


     //全路径和等级二期制作
     public function updateData($data,$id)
     {
         //修改记录
         if($this->save($data,array('id'=>$id))){
             //全路径
             if($data['pid'] == 0){
                 $path = $id;
             }else{
                 //次级权限
                 $p_info = $this->find($data['pid']);
                 $p_path = $p_info['path'];
                 $path = $p_path.'-'.$id;
             }

             //制作等级
             $level = substr_count($path,'-');
             $sql = "update tp_auth set path='$path',level='$level' where id = '$id'";
             return $this->execute($sql);
         }else{
             return false;
         }
     }
 }