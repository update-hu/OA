<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/8
 * Time: 17:30
 */
namespace Employee\Logic;


use Employee\Model\EmployeeModel;
use OCommon\Logic\BaseLogic;
use Think\Page;

/**
 * 显示员工列表
 */
class EmployeeListLogic extends BaseLogic {

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
        $EmployeeModel = new EmployeeModel();
        $count = $EmployeeModel->table('employee as a')->join('department as b on a.department_id = b.department_id')->count();
        $p = getPage($count, 5);
        $show = $p->show();
        $list = $EmployeeModel->join('department on employee.department_id = department.department_id')->limit($p->firstRow.','.$p->listRows)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;
    }

    /**
     * 根据姓名查询员工信息
     */
    public function findEmployeeByName($name) {
        $EmployeeModel = new EmployeeModel();

        $where['name'] = array('like', '%'.$name.'%');
        $count = $EmployeeModel->join('department on employee.department_id = department.department_id')->where($where)->count();
        $p = getPage($count, 5);
        $show = urldecode($p->show());

        $list = $EmployeeModel->join('department on employee.department_id = department.department_id')->where($where)->limit($p->firstRow.','.$p->listRows)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;
    }

    /**
     * 根据部门查询员工信息
     */
    public function findEmployeeByDept($department) {
        $EmployeeModel = new EmployeeModel();
        $where = [
            'dept_name' => $department,
        ];
        $count = $EmployeeModel->join('department on employee.department_id = department.department_id')->where($where)->count();
        $p = getPage($count, 5);
        $show = $p->show();
        $list = $EmployeeModel->join('department on employee.department_id = department.department_id')->where($where)->limit($p->firstRow.','.$p->listRows)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;
    }

    /**
     * 根据入职时间查询员工信息
     */
    public function findEmployeeByTIme($entry_time, $entry_time2) {
        $EmployeeModel = new EmployeeModel();
        $where = [
            'entry_time' => array('between', array($entry_time, $entry_time2)),
        ];
        $count = $EmployeeModel->join('department on employee.department_id = department.department_id')->where($where)->count();
        $p = getPage($count, 5);
        $show = $p->show();
        $list = $EmployeeModel->join('department on employee.department_id = department.department_id')->where($where)->limit($p->firstRow.','.$p->listRows)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;
    }

    /**
     * 编辑员工信息
     */
    public function editEmployee($employee_id, $data) {
        $EmployeeModel = new EmployeeModel();
        $where = [
          'employee_id' => $employee_id,
        ];
        $res = $EmployeeModel->updateByWhere($where, $data, '');
        if($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除员工信息
     */
    public function deleteEmployee($employee_id) {
        $EmployeeModel = new EmployeeModel();
        $where = [
            'employee_id' => $employee_id,
        ];
        $res = $EmployeeModel->deleteByWhere($where, '');
        if($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 修改员工职位信息
     */
    public function editEmployeePosition($employee_id, $data) {
        $EmployeeModel = new EmployeeModel();
        $where = [
            'employee_id' => $employee_id,
        ];

        $res = $EmployeeModel->updateByWhere($where, $data, '');
        if($res) {
            if($data['position'] == '普通员工') {
                $group_id = 4;
            } elseif ($data['position'] == '部门经理') {
                $group_id = 3;
            } elseif ($data['position'] == '总经理') {
                $group_id = 2;
            }
            $data2 = [
                'group_id' => $group_id,
            ];
            $where2 = [
                'uid' => $employee_id,
            ];
            $Auth = M('auth_group_access');
            $result = $Auth->where($where2)->data($data2)->save();
            return true;
        } else {
            return false;
        }


    }

}






















