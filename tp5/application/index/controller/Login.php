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
        if(session('studentId') != null)
            $this->success('登陆成功','messagelist');
        $students = new Students;
        if(request()->isPost())
        {
            $result1 = $students->checkStudent(input('post.sno'),input('post.password'));
            if($result1)
            {
                if(!isset($_SESSION))
                    session_start();
                session('students.studentId',$result1['studentId']);
                session('students.sno',$result1['sno']);
                $this->success('登陆成功','messagelist');
            } else{
                $this->erroe('学号或密码错误','login');
            }
        }
        return view();
    }
    public function adminerlogin()
    {
        if(session('adminerId') != null)
            $this->success('登陆成功','getData');
        $adminer = new Adminer;
        if(request()->isPost())
        {
            $result2 = $adminer->checkAdminer(input('post.adminername'),input('post.password'));
            if($result2)
            {
                if(!isset($_SESSION))
                    session_start();
                session('adminer.adminerId',$result2['adminerId']);
                session('adminer.adminername',$result2['name']);
                $this->success('登陆成功','getData');
            } else{
                $this->error('用户名或密码错误','adminerlogin');
            }
        }
    }
    public function loginout()
    {
        session(null);
        $this->success('退出成功','login');
    }
    public function adminerloginout()
    {
        session(null);
        $this->success('退出成功','adminerlogin');
    }
}