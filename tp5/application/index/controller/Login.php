<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/7/15
 * Time: 21:09
 */

namespace app\index\controller;
use think\Controller;

class Login extends Controller
{
    public function login()
    {
        if(session('students.studentId') != null)
            $this->success('登陆成功',url('messagelist'));
        $students = new Students;
        if(request()->isPost())
        {
            $result1 = $students->checkStudent(imput('post.name'),imput('post.password'));
            if($result1)
            {
                if(!isset($_SESSION))
                    session_start();
                session('students.studentId',$result1['studentId']);
                session('students.name',$result1['name']);
                $this->success('登陆成功',url('messagelist'));
            } else{
                $this->assign("iserror",1);
                $this->assign("studentname",imput('post.studentname'));
                $this->display('login');
            }
        }
        return view();
    }
    public function adminerlogin()
    {
        if(session('adminer.adminerId') != null)
            $this->success('登陆成功',url('admmessagelist'));
        $adminer = new Adminer;
        if(request()->isPost())
        {
            $result2 = $adminer->checkAdminer(import('post.name'),import('post.password'));
            if($result2)
            {
                if(!isset($_SESSION))
                    session_start();
                session('adminer.adminerId',$result2['adminerId']);
                session('adminer.name',$result2['name']);
                $this->success('登陆成功',url('admmessagelist'));
            } else{
                $this->assign("iserror",1);
                $this->assign("adminername",imput('post.adminername'));
                $this->display('adminerlogin');
            }
        }
    }
    public function loginout()
    {
        session(null);
        $this->success('退出成功',url('login'));
    }
    public function adminerloginout()
    {
        session(null);
        $this->success('退出成功',url('adminerlogin'));
    }
}