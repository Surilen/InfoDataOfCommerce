<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/7/15
 * Time: 21:09
 */

namespace app\index\controller;
use think\Controller;
use app\index\model\Students;
use app\index\model\Adminer;

class Login extends Controller
{
    public function login()
    {
        if(session('sno') != null)
//            $this->success('登陆成功','messagelist');
            $this->redirect('index/Data/article');
        $students = new Students;
        if(request()->isPost())
        {
            $result1 = $students->checkStudent(input('post.sno'),input('post.password'));
            if($result1)
            {
                if(!isset($_SESSION))
                    session_start();
                session('sno',$result1['sno']);
//                $this->success('登陆成功','messagelist');
                $this->redirect('index/Data/article');
            } else{
                $this->error('学号或密码错误','login');
            }
        }
        return $this->fetch('Login/login');
    }
    public function adminerlogin()
    {
        if(session('adminername') != null)
            $this->success('登陆成功','getData');
        $adminer = new Adminer;
        if(request()->isPost())
        {
            $result2 = $adminer->checkAdminer(input('post.adminername'),input('post.password'));
            if($result2)
            {
                if(!isset($_SESSION))
                    session_start();
                session('adminername',$result2['adminername']);
                $this->success('登陆成功','getData');
            } else{
                $this->error('用户名或密码错误','adminerlogin');
            }
        }
    }
    public function loginout()
    {
        session('sno',null);
        $this->success('退出成功','index/Login/login');
    }
    public function adminerloginout()
    {
        session('adminername',null);
        $this->success('退出成功','adminerlogin');
    }
}