<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/2
 * Time: 14:26
 */
namespace Login\Logic;
use OCommon\Logic\BaseLogic;

/**
 * 登录业务逻辑
 */
class LoginBaseLogic extends BaseLogic {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 显示登录界面
     */
    public function index() {
        $this->dislpay();
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
    public function checkLogin() {
        if(!IS_POST) {
            exit("页面请求非法");
        }

        $verify = htmlspecialchars($_POST['verify']);
        if(!check_verify($verify)) {
            $this->error("验证码输入错误!");
        }

        $Register = M('Employee');
        $username = htmlspecialchars($_POST['username']);
        $password = MD5($_POST['password']);

        //$res = $Register->where("emp_name = '$username'")->find();

        $loginModel = new LoginModel();
        $where = [
            "emp_name" => $username,
        ];
        $order = [];
        $field = [
            'password',
            'emp_id',
        ];
        $res = $loginModel->findByWhere($where, $order, $field);

        return $password == $res['password'];

//        if($password == $res['password']) {
//            session('emp_id',$res['employee_id']);
//            $this->success('用户登录成功','U(Index/index)',3);
//        } else {
//            $this->error("用户名或密码错误");
//        }
    }

}






















