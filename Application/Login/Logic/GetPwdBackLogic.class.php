<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/6
 * Time: 18:14
 */
namespace Login\Logic;


use OCommon\Logic\BaseLogic;

/**
 *
 */
class GetPwdBackLogic extends BaseLogic {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 发送邮件
     */
    public function findpwd() {
        $map['email'] = $_POST['email'];
        $info = M('Employee')->where($map)->find();
        if($info) {
            $key = md5($info['username'].'+'.$info['password']);
            $string = base64_encode($info['username'].'+'.$key);
            $time = time();
            $code = md5('mytime',$time);

            $findpwd = $_SERVER['HTTP_HOST'].U('GetPwdBack/editpwd').'?key='.$key."$info=".$string.'$time='.$time.'$code='.$code;
            $username = $info['username'];
            $title = "找回密码";

            $content = "<h2>亲爱的 $username 用户 ： <h2>
                        <br><br>请点击链接修改密码  <>br<br>http;//$findpwd
                         <br><br><h3>有效期30分钟</h3>";
            $from = "iamhuzp@163.com";
            $to = $info['email'];

            $status = send_email($title, $content, $from, $to);

            if($status == 1) {
                $this->success("发送邮件...", U(''), 3);
            } else {
                $this->error("发送邮件失败...");
                exit();
            }
        } else {
            $this->erroe("此邮箱未注册");
            exit();
        }
    }

    /**
     * 跳转到密码修改界面
     */
    public function editpwd() {
        $_SESSION['emailpwd'] = array(
            'key' => trim($_GET['key']),
            'info' => trim($_GET['info']),
            'code' => trim($_GET['code']),
            'time' => trim($_GET['time']),
        );
        $this->display();
    }

    /**
     * 密码修改操作
     */
    public function doeditpwd() {
        $str = base64_decode($_SESSION['emailpwd']['info']);
        $arr = explode('+',$str);
        $user['username'] = $arr[0];
        $reinfo = M("Employee")->where($user)->find();


        $retime = time ();
        if (($_SESSION ['emailpwd'] ['code'] == md5 ( 'mytime' . $_SESSION ['emailpwd'] ['time'] )) && ((($_SESSION ['emailpwd'] ['time']) + (60 * 30)) >= $retime)) {

            if (md5 ( $reinfo ['username'] . '+' . $reinfo ['password'] ) == $_SESSION ['emailpwd'] ['key']) { // 判断URL传输中username是否更改

                $upid ['id'] = $reinfo ['id'];
                $username = $reinfo ['username'];

                if ($_POST ['user_password'] == $_POST ['reuser_password'] && $_POST ['user_password'] != '') {

                    $data ['salt'] = rand ( 10000, 99999 );
                    $data ['password'] = md5 ( trim ( $_POST ['reuser_password'] ) . $data ['salt'] );
                    $edit = M ( 'user' )->where ( $upid )->data ( $data )->save ();
                    if ($edit) {

                        // session_destroy();
                        unset ( $_SESSION ['emailpwd'] );
                        $this->success ( '修改成功,请重新登录！！', U ( 'Email/success' ), 2 );
                    } else {
                        $this->error ( '修改失败！！' );
                    }
                } else {
                    $this->error ( '两次输入密码不一致，或者密码为空！' );
                    exit ();
                }
            } else {
                $this->error ( '链接出现错误或密码已经修改，请重试！！',U('Email/index'),3 );
            }
        } else {

            // session_destroy();
            unset ( $_SESSION ['emailpwd'] );
            $this->error ( '链接失效，请重新申请', U ( 'Email/index' ), 2 );
        }
    }












}













