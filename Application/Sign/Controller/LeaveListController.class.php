<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/15
 * Time: 16:05
 */
namespace Sign\Controller;

use OCommon\Controller\BaseController;
use Sign\Logic\LeaveListLogic;
use Sign\Model\LeaveModel;

/**
 * 请假Controller
 */
class LeaveListController extends BaseController {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 显示所有请假列表
     */
    public function showLeaveList() {
        $LeaveListLogic = new LeaveListLogic();
        $name = I('get.leave_name', '', 'strip_tags');
        $leave_name = trim($name);

        if($leave_name != '') {
            $res = $LeaveListLogic->findLeaveByName($leave_name);
            $show = $res['show'];
            $list = $res['list'];
            $array = [
                'name' => $name,
            ];
            $this->assign('page', $show);
            $this->assign('leave', $array);
            $this->assign("list", $list);
            $this->display();
            exit();
        }
        $res = $LeaveListLogic->showLeaveList();
        $show = $res['show'];
        $list = $res['list'];
        $this->assign('page', $show);
        $this->assign("list", $list);
        $this->display();
    }

    /**
     * 显示单个员工请假列表
     */
    public function showOneLeaveList() {
        $LeaveListLogic = new LeaveListLogic();
        $name = I('get.leave_name', '', 'strip_tags');
        $leave_name = trim($name);
        $employee_id = I('session.employee_id', '', 'intval');
        if($leave_name != '') {
            $res = $LeaveListLogic->findLeaveByTitle($employee_id, $leave_name);
            $show = $res['show'];
            $list = $res['list'];
            $array = [
                'name' => $name,
            ];

            $this->assign('page', $show);
            $this->assign('leave', $array);
            $this->assign("list", $list);
            $this->display();
            exit();
        }


        $res = $LeaveListLogic->showOneLeaveList($employee_id);
        $show = $res['show'];
        $list = $res['list'];
        $this->assign('page', $show);
        $this->assign("list", $list);
        $this->display();
    }

    /**
     * 查看请假详细信息
     */
    public function showLeave() {
        $LeaveListList = new LeaveListLogic();
        $leave_id = I('get.leave_id', '', 'intval');
        $res = $LeaveListList->showLeave($leave_id);
        if($res) {
            $this->assign('list', $res);
            $this->display();
        } else {
            $this->error("请假信息读取失败");
        }
    }


    /**
     * 修改请假信息
     */
    public function editLeave() {
        $leave_name = I('post.leave_name', '', 'strip_tags');
        $leave_id = I("get.leave_id", '', 'intval');
        $LeaveListLogic = new LeaveListLogic();
        if($leave_name == "") {
            $result = $LeaveListLogic->showLeave($leave_id);
            $this->assign("leave", $result);
            $this->display();
            exit();
        }
        $leave_id = I('post.leave_id', '', 'intval');
        $employee_id = I('session.employee_id', '', 'intval');
        $content = I('post.content' ,'', 'htmlspecialchars');
        $check = "未审核";
        $start_time = I('post.start_time', '', 'strip_tags');
        $end_time = I('post.end_time', '', 'strip_tags');
        $data = [
            'leave_name' => $leave_name,
            'employee_id' => $employee_id,
            'content' => $content,
            'check' => $check,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ];
        $res = $LeaveListLogic->editLeave($leave_id, $data);
        if($res) {
            $this->success("请假信息修改成功", U('Sign/LeaveList/showOneLeaveList'), 3);
        } else {
            $this->error("请假信息修改失败");
        }
    }

    /**
     * 删除请假信息
     */
    public function deleteLeave() {
        $leave_id = I('get.leave_id', '', 'intval');
        $LeaveListLogic = new LeaveListLogic();
        $res = $LeaveListLogic->deleteLeave($leave_id);
        if($res) {
            $this->success("请假删除成功", U('Sign/LeaveList/showOneLeaveList'), 3);
        } else {
            $this->error("请假删除失败");
        }
    }


    /**
     * 请假审批
     */
    public function checkLeave() {

        $check = I('post.check', '', 'strip_tags');
        $leave_id = I('get.leave_id', '', 'intval');
        $position = I('session.position', '', 'strip_tags');
        $LeaveListLogic = new LeaveListLogic();
        $result = $LeaveListLogic->showLeave($leave_id);
        $log_check = $result['check'];

        if($position == "") {
            $this->error("需要部门经理和总经理才可以修改");
        }

        if ($log_check == "部门经理审核通过") {
            if ($position == '部门经理') {
                $this->error("部门经理已经审批完成");
            } else if ($position == '总经理') {
                $this->redirect('Sign/LeaveList/checkLeaveManager', array('leave_id' => $leave_id), 1 ,'总经理进行审核');
            }
        } else if ($log_check == "审批完成") {
            $this->error("审批已经完成");
        } else {
            if ( $log_check == '未审核' && $position == '部门经理') {
                $this->redirect('Sign/LeaveList/checkLeaveDeptManager', array('leave_id' => $leave_id), 1, '部门经理进行审核');
            } else if ($log_check == '未审核' && $position == '总经理') {
                $this->error("部门经理还未审核");
            } else if($log_check == '审核不通过') {
                $this->success("审核不通过，需要重新修改", U('Sign/LeaveList/showLeaveList'), 3);
                exit();
            }
        }

        $data = [
            'check' => $check,
        ];

        $leave_id = I('post.leave_id', '', 'intval');
        $res = $LeaveListLogic->checkLeave($leave_id, $data);
        if($res) {
            $this->success("培训审批成功", U('Sign/LeaveList/showLeaveList'), 3);
        } else {
            $this->error("培训审批失败");
        }
    }

    /**
     * 部门经理审核请假
     */
    public function checkLeaveDeptManager () {
        $train_id = I('train_id', '', 'intval');
        $res = [
            'train_id' => $train_id,
        ];
        $this->assign('list', $res);
        $this->display();
    }

    /**
     * 总经理审核请假
     */
    public function checkLeaveManager() {
        $train_id = I('train_id', '', 'intval');
        $res = [
            'train_id' => $train_id,
        ];
        $this->assign('list', $res);
        $this->display();
    }


}































