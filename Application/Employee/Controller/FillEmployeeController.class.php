<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/7
 * Time: 16:35
 */
namespace Employee\Controller;

use Department\Model\DepartmentModel;
use Employee\Logic\FillEmployeeLogic;
use OCommon\Controller\BaseController;
/**
 * 员工填写自己详细信息
 */
class FillEmployeeController extends BaseController {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 显示填写员工信息界面
     */
    public function addEmployee() {
        $employee_id = I('session.employee_id', '', 'intval');
        $Dept = M('Department');
        $res = $Dept->select();
        $this->assign('list', $res);
        $this->display();
    }

    /**
     * 填写员工信息
     */
    public function addEmployeeMsg() {
        $name = I('post.name', ''. 'strip_tags');
        $employee_id = I('session.employee_id', '', 'intval');
        $gender = I('post.gender', '', 'strip_tags');
        $birthday = I('post.birthday', '', 'strip_tags');
        $phone = I('post.phone', '', 'strip_tags');
        $department_id = I('post.department_id', '', 'intval');
        $entry_time = I('post.entry_time', '', 'strip_tags');
        $data = [
            'name' => $name,
            'gender' => $gender,
            'birthday' => $birthday,
            'phone' => $phone,
            'department_id' => $department_id,
            'entry_time' => $entry_time,
        ];

        $FillEmployeeLogic = new FillEmployeeLogic();
        $res = $FillEmployeeLogic->addEmployee($employee_id, $data);

        if($res) {
            $auth = M('auth_group_access');
            $data2 = [
                'uid' => $employee_id,
                'group_id' => 4,
            ];
            $auth->data($data2)->add();
            session('name', $name);
            $this->success("信息修改成功",U("Employee/EmployeeList/showEmployeeList"),3);
        } else {
            $this->error("信息修改失败");
        }
    }




}





















