<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/7/15
 * Time: 23:09
 */

namespace app\index\controller;
use app\index\model\Students;
use think\Controller;
use think\Db;

class Data extends Controller
{
    public function messagelist()
    {
        if(session('sno') == null)
        {
            $this->error('您还未登陆','login');
        }else {
            $std = Db::table('students')
                ->where(['Sno'=>session('sno')])
                ->find();
            $this->assign('info',$std);
        return view();
        }
    }
    public function article()
    {
        if(session('sno') == null)
        {
            $this->error('您还未登录','index/Login/login');
        }
        $stud = new Students;
        $art = $stud->getArticles(session('sno'));
        $content = array();
        foreach($art as $v)
        {
            $content[$v['term']]=$v['content'];
        }
        $this->assign('content',$content);
        return $this->fetch('Data/article');;
    }
    public function getData()
    {
        if((!session('adminername') == null) || (!session('sno') == null))
        {
            $this->error('您还未登录','index/Login/login');
        }else {
            $stu = new Students;
            if(request()->isPost())
            {
                $result3 = $stu->checkStu(input('post.sno'));
                if($result3) {
//                    if(!isset($_SESSION))
//                        session_start();
//                    session('students.Sno',$result3['sno']);
//                    $this->success('查询成功','messagelist');
//                }else {
//                    $this->error('学号不存在','getData');
//                }
                    $this->assign('info',$result3);
                }
            }
            return view();
        }
    }
}