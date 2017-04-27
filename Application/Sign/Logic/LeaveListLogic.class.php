<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/15
 * Time: 16:05
 */
namespace Sign\Logic;

use Employee\Model\EmployeeModel;
use OCommon\Logic\BaseLogic;
use Sign\Model\LeaveModel;

/**
 * 请假Logic
 */
class LeaveListLogic extends BaseLogic {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     *显示所有员工请假列表
     */
    public function showLeaveList() {
        $LeaveModel = new LeaveModel();
        $count = $LeaveModel->count();
        $p = getPage($count, 5);
        $show = $p->show();
        $list = $LeaveModel->join('LEFT JOIN employee on leave.employee_id = employee.employee_id')->limit($p->firstRow.','.$p->listRows)->select();
        for($i = 0; $i < sizeof($list); $i++) {
            $start_time = strtotime($list[$i]['start_time']);
            $end_time = strtotime($list[$i]['end_time']);
            $timeoff = $end_time - $start_time;

            $days = intval($timeoff / 86400);
            $remain = $timeoff % 86400;
            $hours = intval($remain / 3600);
            $remain = $remain % 3600;
            $mins = intval($remain / 60);
            $secs = $remain % 60;
            $res = $days."天".$hours."小时".$mins."分钟".$secs."秒";
            $list[$i]['long'] = $res;
        }
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;
    }

    /**
     * 显示单个员工请假信息
     */
    public function showOneLeaveList($employee_id) {
        $LeaveModel = new LeaveModel();
        $where = [
            'leave.employee_id' => $employee_id,
        ];
        $count = $LeaveModel->where($where)->count();
        $p = getPage($count, 5);
        $show = $p->show();
        $list = $LeaveModel->join('LEFT JOIN employee on leave.employee_id = employee.employee_id')->where($where)->limit($p->firstRow.','.$p->listRows)->select();

        for($i = 0; $i < sizeof($list); $i++) {
            $start_time = strtotime($list[$i]['start_time']);
            $end_time = strtotime($list[$i]['end_time']);
            $timeoff = $end_time - $start_time;
            $days = intval($timeoff / 86400);
            $remain = $timeoff % 86400;
            $hours = intval($remain / 3600);
            $remain = $remain % 3600;
            $mins = intval($remain / 60);
            $secs = $remain % 60;
            $res = $days."天".$hours."小时".$mins."分钟".$secs."秒";
            $list[$i]['long'] = $res;
        }

        $array = [
            'show' => $show,
            'list' =>$list,
        ];
        return $array;

    }

    /**
     * 查看员工请假信息
     */
    public function showLeave($leave_id) {
        $LeaveMoel = new LeaveModel();
        $result = $LeaveMoel->join('LEFT JOIN employee on leave.employee_id = employee.employee_id')->select();
        $res = array();
        for($i = 0; $i <= sizeof($result); $i++) {
            if($result[$i]['leave_id'] == $leave_id) {
                $res = $result[$i];
            }
        }
        return isset($res) ? $res : false;
    }

    /**
     * 修改员工请假信息
     */
    public function editLeave($leave_id, $data) {
        $LeaveModel = new LeaveModel();
        $where = [
            'leave_id' => $leave_id,
        ];
        $res = $LeaveModel->updateByWhere($where, $data, '');
        return isset($res) ? true : false;
    }

    /**
     * 删除员工请假信息
     */
    public function deleteLeave($leave_id) {
        $LeaveModel = M('Leave');
        $where = [
            'leave_id' => $leave_id,
        ];
        $res = $LeaveModel->where($where)->delete();
        return isset($res) ? true : false;
    }

    /**
     * 请假审核
     */
    public function checkLeave($leave_id, $data) {
        $LeaveModel = new LeaveModel();
        $where = [
            'leave_id' => $leave_id,
        ];
        $res = $LeaveModel->updateByWhere($where, $data, '');
        return isset($res) ? true : false;
    }

    /**
     * 查找请假信息
     */
    public function findLeaveByName($leave_name) {
        $LeaveModel = new LeaveModel();
        $where = [
            'leave_name' => array('like', '%'.$leave_name.'%'),
        ];
        $count = $LeaveModel->where($where)->count();
        $p = getPage($count, 5);
        $show = urldecode($p->show());
        $list = $LeaveModel->join('employee on leave.employee_id = employee.employee_id')->where($where)->limit($p->firstRow.','.$p->listRows)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;

//        $res = $LeaveModel->selectByWhere($where);
//        $EmployeeModel = new EmployeeModel();
//        for($i = 0; $i < sizeof($res); $i++) {
//            $employee_id = $res[$i]['employee_id'];
//            $result = $EmployeeModel->findByWhere(array('employee_id' => $employee_id));
//            $res[$i]['name'] = $result['name'];
//        }
//        return $res;
    }

    /**
     * 查找个人请假信息
     */
    public function findLeaveByTitle($employee_id, $leave_name) {
        $LeaveModel = new LeaveModel();
        $where = [
            'leave.employee_id' => $employee_id,
            'leave.leave_name' => array('like', '%'.$leave_name.'%'),
        ];
        $count = $LeaveModel->where($where)->count();
        $p = getPage($count, 5);
        $show = urldecode($p->show());
        $list = $LeaveModel->join('employee on leave.employee_id = employee.employee_id')->where($where)->limit($p->firstRow.','.$p->listRows)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;

    }


























}