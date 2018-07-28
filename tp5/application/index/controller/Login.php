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
//            $this->success('您已经登录过了','index/Data/article');
            $this->redirect('index/Data/article');
        if(request()->isPost())
        {
            $students = new Students;
            $sno = input('post.sno');
            $result1 = $students->checkStudent($sno,base64_encode(md5(input('post.password'))));
            if($result1)
            {
                if(!isset($_SESSION))
                    session_start();
                session('sno',$result1['sno']);
                $this->success('登陆成功','index/Data/article');
//                $this->redirect('index/Data/article');
            } else{
                if($students->checkStu($sno)) {
                    $this->error('密码错误', 'index/Login/login');
                }else{
                    $this->error('系统中暂无此人', 'index/Login/login');
                }
            }
        }
        return $this->fetch('Login/login');
    }

    public function adminerlogin()
    {
        if(session('adminername') != null)
            $this->success('登陆成功','index/Login/getData');
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
        $this->success('退出成功','index/Login/adminerlogin');
    }

    private function work()
    {
        $student = Db('students')->select();
        $cnt = 0;
        foreach ($student as $v)
        {
            $pass = $v['password'];
//            echo $pass . '<br>';
            $res = Db('students')->where('sno',$v['sno'])->setField('password',base64_encode(md5($pass)));
            if($res) $cnt++;
        }
        echo $cnt . 'Success!';
    }
}