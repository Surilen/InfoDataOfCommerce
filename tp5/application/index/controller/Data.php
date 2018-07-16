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
        if(session('studentId') == null)
        {
            $this->error('您还未登陆','login');
        }else {
            $std = Db::table('students')
                ->where(['Sno'=>session('studentId')])
                ->find();
            $this->assign('info',$std);
        return view();
        }
    }
    public function getData()
    {
        if(session('adminerId') == null)
        {
            $this->error('您还未登录','adminerlogin');
        }else {
            $stu = new Students;
            if(request()->isPost())
            {
                $result3 = $stu->checkStu(input('post.stusno'));
                if($result3)
                {
                    if(!isset($_SESSION))
                        session_start();
                    session('students.studentId',$result3['stuId']);
                    $this->success('查询成功','messagelist');
                }else {
                    $this->error('学号不存在','getData');
                }
            }
            return view();
        }
    }
}