<?php
/**
 * Created by PhpStorm.
 * User: DarkKris
 * Date: 2018/7/28
 * Time: 下午3:01
 */
namespace app\index\controller;

use think\Controller;

class Admin extends Controller
{
    public function getPage()
    {
        if(session('adminername')==null)
        {
            $this->error('您还未登录或没有管理员权限','index/Login/adminerlogin');
        }
        $this->assign('name',session('adminername'));
        return $this->fetch('Admin/main');
    }

    //TODO 学生信息查看；学生信息修改时间设定；生成/导出excel表格
}