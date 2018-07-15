<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/7/15
 * Time: 23:09
 */

namespace app\index\controller;
use think\Controller;
use think\Db;
class Data extends Controller
{
    public function messagelist()
    {
        $std = Db::table('students')
            ->where(['studentId'=>session('students.studentId')])
            ->find();
        $rows = $std['pagrows'];
        $list = Db::table('students')
            ->alias('stds')
            ->join('message mess','stds.studentId = mess.studentId')
            ->paginate($rows);
        $this->assign('list',$list);
        return $this->fetch('message/messagelist');
    }
    public function admmessagelist()
    {   $rows = Db::table('students')
        ->count();
        $list = Db::table('students')
            ->paginate($rows);
        $this->assign('list',$list);
        return $this->fetch('message/admmessagelist');
    }
}