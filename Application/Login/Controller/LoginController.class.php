<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/2
 * Time: 14:58
 */
namespace Login\Controller;


use Login\Logic\LoginBaseLogic;
use Login\Model\LoginModel;
use Org\Util\Rbac;
use Think\Verify;


/**
 *登录控制器
 */
class LoginController extends LoginBaseController {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 显示登录页面
     */
    public function login() {
        $this->display();
    }

    /**
     * 生成验证码
     */
    public function createVerify() {
        $config= array(
            'length' => 4,
        );
        $Verify = new Verify($config);
        $Verify->entry();
        $this->display();
    }

    /**
     * 验证登录信息
     */
    public function check() {
        if(!IS_POST) {
            exit("页面请求非法");
        }
        $verify = htmlspecialchars($_POST['verify']);
        if(!check_verify($verify)) {
            $this->error("验证码输入错误!");
        }
        $Employee = M('Employee');
        $username = I('post.username', '', 'strip_tags');
        $password = I('post.password', '', 'md5');
        $res = $Employee->where("emp_name = '$username'")->find();

        if($password == $res['password']) {
            session('employee_id',$res['employee_id']);
            session('username', $res['emp_name']);
            session('position', $res['position']);
            session('name', $res['name']);
            $this->success('用户登录成功',U("/Employee/Index/index"),3);
        } else {
            $this->error("用户名或密码错误");
        }
    }

    /**
     * 注销登录
     */
    public function logout() {
        session_destroy();
        $this->success("注销成功", U('/Login/Login/login'), 3);
    }

    //    /**
//     *登录信息验证
//     */
//    public function checkLogin() {
//        $loginlogin = new LoginBaseLogic();
//        $loginmodel = new LoginModel();
//        $res = $loginlogin->checkLogin();
//        if($res) {
//            $this->success("登录成功",U("Temp/index"),3);
//        } else {
//            $this->error("登录失败");
//        }
//    }



}



























