<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/15
 * Time: 17:29
 */
namespace Sign\Controller;

use OCommon\Controller\BaseController;
use Sign\Logic\FillLeaveLogic;

/**
 * 新增请假Controller
 */
class FillLeaveController extends BaseController {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 新增请假
     */
    public function addLeave() {
        $leave_name = I('post.leave_name', '', 'strip_tags');
        if($leave_name == '') {
            $this->display();
            exit();
        }
        $employee_id = I('session.employee_id', '', 'intval');
        $content = I('post.content', '', 'htmlspecialchars');
        $check = '未审核';
        $start_time = I('post.start_time', '','strip_tags');
        $end_time = I('post.end_time', '', 'strip_tags');
        $data = [
            'employee_id' => $employee_id,
            'leave_name' => $leave_name,
            'content' => $content,
            'check' => $check,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ];

        $FillLeaveLogic = new FillLeaveLogic();
        $res = $FillLeaveLogic->addLeave($data);
        if($res) {
            $this->success("请假信息添加成功", U('Sign/LeaveList/showOneLeaveList'), 3);
        } else {
            $this->error("请假信息添加失败");
        }
    }
}






















