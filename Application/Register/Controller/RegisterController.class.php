<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/2
 * Time: 17:05
 */
namespace Register\Controller;


/**
 *注册控制器
 */
class RegisterController extends RegisterBaseController {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 显示注册页面
     */
    public function register()
    {
        $this->display();
    }

    /**
     * 验证输入内容
     */
    public function check() {
        if(!IS_POST) {
            exit("页面请求非法");
        }

        $username = I('post.username', '', 'strip_tags');
        $password = I('post.password', '', 'md5');
        $email = I('post.email', '', 'strip_tags');

        $data = [
            'emp_name' => $username,
            'password' => $password,
            'email' => $email,
            'condition' => "在职",
            'position' => "普通员工"
        ];

        $Employee = M('Employee');

        $name = $Employee->where("emp_name = '$username'" )->find();
        $email = $Employee->where("email = '$email'")->find();
        if($name) {
            $this->error("用户名已被占用，请重新注册");
        }
        if($email) {
            $this->error("邮箱地址已经被注册，请换一个邮箱");
        }

        $result = $Employee->data($data)->add();

        if($result) {
            $this->success("注册成功,请重新登录",U("Login/Login/login"),3);
        } else {
            $this->error("注册失败");
        }

    }



}
























