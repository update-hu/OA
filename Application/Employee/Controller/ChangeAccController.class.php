<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/8
 * Time: 14:56
 */
namespace Employee\Controller;


use Employee\Logic\ChangeAccLogic;
use OCommon\Controller\BaseController;


/**
 *
 */
class ChangeAccController extends BaseController {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 修改账号密码
     */
    public function changeAccount() {
        $emp_name = I('post.emp_name', '', '');
        if($emp_name == "") {
            $this->display();
            exit();
        }
        $employee_id = I('session.employee_id', '', 'intval');
        $password = I('post.password', '', 'md5');
        $email = I('post.email', '', 'strip_tags');

        $data = [
            'emp_name' => $emp_name,
            'password' => $password,
            'email' => $email,
        ];

        $ChangeAccLogic = new ChangeAccLogic();
        $res = $ChangeAccLogic->changeAccount($employee_id,$data);

        if($res) {
            $this->success("账号密码修改成功", U("/Employee/ChangeAcc/changeAccount"), 3);
        } else {
            $this->error();
        }
    }
}




























