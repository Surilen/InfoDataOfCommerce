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
        return $this->hasMany('message','sudentId','studentId');//此步暂时留着以后更改
    }
    public function checkStudent($id,$pw)
    {
        return Db::table('students')->where(['sno'=>$id,'password'=>$pw])->find();
    }
    public function checkStu($id)
    {
        return Db::table('students')->where(['sno'=>$id])->find();
    }
}