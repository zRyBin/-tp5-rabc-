<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/12
 * Time: 16:18
 */
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Tags extends Model
{
    use SoftDelete;
    protected $delete_time = 'delete_time';
}
