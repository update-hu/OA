<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/6
 * Time: 14:53
 */
namespace Login\Controller;


/*
 * 找回密码Controller
 */
class GetPwdBackController extends LoginBaseController {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 发送邮件
     */
    public function checkEmail() {
        $email = I('post.email', '', 'strip_tags');
        $Employee = M('Employee');
        $where = [
            'email' => $email,
        ];
        $res = $Employee->where($where)->find();
        if(!$res) {
            $this->error("该邮箱未被注册");
        }
        $passwordToken = md5($res['employee_id'].$res['emp_name'].$res['password']);
        $link = "http://localhost/OA/Login/GetPwdBack/resetPassword/email/{$email}/passwordToken/{$passwordToken}";
        $str = "您好，{$res['emp_name']} 员工,请点击如下链接修改密码:<br><br>  <a>$link</a>";
        $sendResult = send_email($str,$email);
        if($sendResult) {
            $this->success("邮件发送成功",U("Login/login"),3);
        } else {
            exit();
            $this->error("邮件发送失败");
        }
    }

    /**
     * 修改密码
     */
    public function resetPassword() {

//        $email = I('get.email', '', 'strip_tags');
//        $passwordToken = I('get.passwordToken', '', 'strip_tags');

        $email = I('get.email');
        $passwordToken = I('get.passwordToken');

        $Employee = M('Employee');
        $condition = [
            'email' => $email,
        ];
        $res = $Employee->where($condition)->find();
        if(!$res) {
            exit("链接错误");
        }
        $checkToken = md5($res['employee_id'].$res['emp_name'].$res['password']);
        if($checkToken != $passwordToken) {
            exit("无效的链接");
        }
        $employee_id = $res['employee_id'];
        $link = "http://localhost/OA/Login/GetPwdBack/editpwd?employee_id=$employee_id}";
        //header('location:',$link);
        $this->success("密码修改",U("GetPwdBack/editpwd?employee_id=$employee_id"),3);
    }

//    /**
//     * 显示更改密码页面
//     */
//    public function edit() {
//        $employee_id = I('get.employee_id');
//        if(!$employee_id) {
//            exit("请求非法");
//        }
//        $this->success("",U());
//    }

    /**
     * 修改密码
     */
    public function editpwd() {
        $password = I('post.password', '', 'strip_tags');
        if($password == '') {
            $employee_id = I('get.employee_id', '', 'intval');
            $this->assign("employee_id",$employee_id);
            $this->display();
        }
        $employee_id = I('post.employee_id', '', 'intval');
        $Employee = M('Employee');
        $password = I('post.password' , '', 'md5');
        $data = [
            'password' => $password,
        ];
        $where = [
            'employee_id' => $employee_id,
        ];
        $result = $Employee->where($where)->save($data);
        if($result) {
            $this->success("密码修改成功，请重新登录",U("Login/login"),3);
        }
    }


    /**
     * 发送邮件
     */
//    public function findpwd() {
//        $map['email'] = $_POST['email'];
//        $info = M('Employee')->where($map)->find();
//        if($info) {
//            $key = md5($info['username'].'+'.$info['password']);
//            $string = base64_encode($info['username'].'+'.$key);
//            $time = time();
//            $code = md5('mytime',$time);
//
//            $findpwd = $_SERVER['HTTP_HOST'].U('GetPwdBack/editpwd').'?key='.$key."$info=".$string.'$time='.$time.'$code='.$code;
//            $username = $info['username'];
//            $title = "找回密码";
//
//            $content = "<h2>亲爱的 $username 用户 ： <h2>
//                        <br><br>请点击链接修改密码  <>br<br>http;//$findpwd
//                         <br><br><h3>有效期30分钟</h3>";
//            $from = "iamhuzp@163.com";
//            $to = $info['email'];
//
//            $status = send_email($title, $content, $from, $to);
//
//            if($status == 1) {
//                $this->success("发送邮件...", U(''), 3);
//            } else {
//                $this->error("发送邮件失败...");
//                exit();
//            }
//        } else {
//            $this->erroe("此邮箱未注册");
//            exit();
//        }
//    }

    /**
     * 密码修改操作
     */
//    public function doeditpwd() {
//        $str = base64_decode($_SESSION['emailpwd']['info']);
//        $arr = explode('+',$str);
//        $user['username'] = $arr[0];
//        $reinfo = M("Employee")->where($user)->find();
//
//
//        $retime = time ();
//        if (($_SESSION ['emailpwd'] ['code'] == md5 ( 'mytime' . $_SESSION ['emailpwd'] ['time'] )) && ((($_SESSION ['emailpwd'] ['time']) + (60 * 30)) >= $retime)) {
//
//            if (md5 ( $reinfo ['username'] . '+' . $reinfo ['password'] ) == $_SESSION ['emailpwd'] ['key']) { // 判断URL传输中username是否更改
//
//                $upid ['id'] = $reinfo ['id'];
//                $username = $reinfo ['username'];
//
//                if ($_POST ['user_password'] == $_POST ['reuser_password'] && $_POST ['user_password'] != '') {
//
//                    $data ['salt'] = rand ( 10000, 99999 );
//                    $data ['password'] = md5 ( trim ( $_POST ['reuser_password'] ) . $data ['salt'] );
//                    $edit = M ( 'user' )->where ( $upid )->data ( $data )->save ();
//                    if ($edit) {
//
//                        // session_destroy();
//                        unset ( $_SESSION ['emailpwd'] );
//                        $this->success ( '修改成功,请重新登录！！', U ( 'Email/success' ), 2 );
//                    } else {
//                        $this->error ( '修改失败！！' );
//                    }
//                } else {
//                    $this->error ( '两次输入密码不一致，或者密码为空！' );
//                    exit ();
//                }
//            } else {
//                $this->error ( '链接出现错误或密码已经修改，请重试！！',U('Email/index'),3 );
//            }
//        } else {
//
//            // session_destroy();
//            unset ( $_SESSION ['emailpwd'] );
//            $this->error ( '链接失效，请重新申请', U ( 'Email/index' ), 2 );
//        }
//    }




}

























