<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/7/16
 * Time: 0:27
 */

namespace app\index\model;
use think\Model;
use think\Db;

class Adminer extends Model
{
    protected $table = 'adminer';

    public function checkAdminer($id,$pw)
    {
        return Db::table('adminer')->where(['adminername'=>$id,'password'=>$pw])->find();
    }
}