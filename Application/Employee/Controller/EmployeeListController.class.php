<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/8
 * Time: 17:33
 */
namespace Employee\Controller;

use Employee\Logic\EmployeeListLogic;
use OCommon\Controller\BaseController;
use Think\Page;

/**
 * 显示员工列表Controller
 */
class EmployeeListController extends BaseController {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 显示员工列表
     */
    public function showEmployeeList() {
        $EmployeeListLogic = new EmployeeListLogic();
        $emp_name = I('get.name', '', 'strip_tags');
        $name = trim($emp_name);
        $department = I('get.department', '', 'strip_tags');
        $entry_time = I('get.entry_time', '', 'strip_tags');
        $entry_time2 = I('get.entry_time2', '', 'strip_tags');
        $Dept = M('Department');
        $dept = $Dept->select();

        if($name != "") {
            $arr = [
                'name' => $emp_name,
            ];
            $res = $EmployeeListLogic->findEmployeeByName($name);

            $this->assign("list", $res['list']);
            $this->assign('page', $res['show']);
            $this->assign('name', $arr);
            $this->assign('de', $dept);
            $this->display();
            exit();
        }
        if($department != "") {
            $arr = [
                'department' => $department,
            ];
            $res = $EmployeeListLogic->findEmployeeByDept($department);
            $this->assign("list", $res['list']);
            $this->assign('page', $res['show']);
            $this->assign('department' ,$arr);
            $this->assign('de', $dept);
            $this->display();
            exit();
        }

        if($entry_time != "" && $entry_time2 != "") {
            $arr = [
                'entry_time' => $entry_time,
                'entry_time2' => $entry_time2,
            ];
            $res = $EmployeeListLogic->findEmployeeByTime($entry_time, $entry_time2);
            $this->assign("list", $res['list']);
            $this->assign('page', $res['show']);
            $this->assign('date', $arr);
            $this->assign('de', $dept);
            $this->display();
            exit();
        }

        $res = $EmployeeListLogic->showEmployeeList();

        if($res) {
            $this->assign("list", $res['list']);
            $this->assign('page', $res['show']);
            $this->assign('de', $dept);
            $this->display();
        } else {
            $this->error("员工数据读取失败");
        }
    }

    /**
     * 编辑员工信息
     */
    public function editEmployee() {
        $employee_id = I('get.employee_id', '', 'intval');
        if($employee_id != '') {
            $this->display();
            exit();
        }

        $employee_id = I('post.employee_id', '', 'intval');
        $condition = I('post.condition', '', 'strip_tags');
        $leave_time = I('post.leave_time', '', 'strip_tags');

        $data = [
            'condition' => $condition,
            'leave_time' => $leave_time,
        ];
        $EmployeeListLogic = new EmployeeListLogic();
        $res = $EmployeeListLogic->editEmployee($employee_id, $data);
        if($res) {
            $this->success("员工信息修改成功",U('/Employee/EmployeeList/showEmployeeList'),3);
        } else {
            $this->error("员工信息修改失败");
        }
    }

    /**
     * 删除员工信息
     */
    public function deleteEmployee() {
        $employee_id = I('get.employee_id', '', 'intval');
        $EmployeeListLogic = new EmployeeListLogic();
        $res = $EmployeeListLogic->deleteEmployee($employee_id);
        if($res) {
            $this->success("员工删除成功",U('/Employee/EmployeeList/showEmployeeList'),3);
        } else {
            $this->error("员工删除失败");
        }
    }

    /**
     * 修改员工职位信息
     */
    public function editEmployeePosition() {
        $position = I('post.position', '', 'strip_tags');
        if($position == '') {
            $auth_group = M('Auth_group');
            $result = $auth_group->select();
            unset($result[0]);
            $this->assign('group', $result);
            $this->display();
            exit();
        }
        $employee_id = I('post.employee_id', '', 'intval');
        $data = [
            'position' => $position,
        ];
        $EmployeeListLogic = new EmployeeListLogic();
        $res = $EmployeeListLogic->editEmployeePosition($employee_id, $data);
        if($res) {
            $this->success("职位修改成功", U('/Employee/EmployeeList/showEmployeeList'), 3);
        } else {
            $this->error("职位修改失败");
        }

    }



}




















