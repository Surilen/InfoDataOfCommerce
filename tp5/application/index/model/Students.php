<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/7/16
 * Time: 0:26
 */

namespace app\index\model;
use think\Model;
use think\Db;
class Students extends Model
{
    protected $table = 'students';

    public function comm()
    {
        return $this->hasMany('message','sudentId','studentId');
    }
    public function checkStudent($id,$pw)
    {
        return Db::name('students')->where(['name'=>$id,'password'=>$pw])->find();
    }
}