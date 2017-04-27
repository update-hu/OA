<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/10
 * Time: 15:07
 */
namespace Log\Controller;

use Log\Logic\LogListLogic;
use OCommon\Controller\BaseController;

/**
 * 显示列表Controler
 */
class LogListController extends BaseController
{

    /**
     * 构造函数
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 显示单个员工日志列表
     */
    public function showOneLogList()
    {
        $LogListLogic = new LogListLogic();
        $employee_id = I('session.employee_id', '', 'intval');
        $name = I('get.log_name', '', 'strip_tags');
        $log_name = trim($name);
        $time = I('get.time', '', 'strip_tags');
        $time2 = I('get.time2', '','strip_tags');

        if($log_name != '') {
            $res = $LogListLogic->findLogByName($employee_id, $log_name);
            $show = $res['show'];
            $list = $res['list'];
            $array = [
                'name' => $name,
            ];
            $this->assign('log', $array);
            $this->assign('page',$show);
            $this->assign('list', $list);
            $this->display();
            exit();
        } else if($time != "" && $time2 != "") {
            $res = $LogListLogic->findLogByTime($employee_id, $time, $time2);
            $show = $res['show'];
            $list = $res['list'];
            $array = [
                'time' => $time,
                'time2' => $time2,
            ];
            $this->assign('log', $array);
            $this->assign('page',$show);
            $this->assign('list', $list);
            $this->display();
            exit();
        }

        $res = $LogListLogic->showOneLogList($employee_id);
        $show = $res['show'];
        $list = $res['list'];
        $this->assign('page', $show);
        $this->assign("list", $list);
        $this->display();
    }

    /**
     * 显示所有员工日志列表
     */
    public function showLogList()
    {
        $LogListLogic = new LogListLogic();
        $name = I('get.log_name', '', 'strip_tags');
        $log_name = trim($name);
        $time = I('get.time', '', 'strip_tags');
        $time2 = I('get.time2', '', 'strip_tags');

        if($log_name != '') {
            $res = $LogListLogic->findLogByNames($log_name);
            $show = $res['show'];
            $list = $res['list'];
            $array = [
                'name' => $name,
            ];
            $this->assign('page', $show);
            $this->assign('log', $array);
            $this->assign('list', $list);
            $this->display();
            exit();
        } else if($time != "" && $time2 != "") {
            $res = $LogListLogic->findLogByTimes($time, $time2);
            $show = $res['show'];
            $list = $res['list'];
            $array = [
                'time' => $time,
                'time2' => $time2,
            ];
            $this->assign('page', $show);
            $this->assign('log', $array);
            $this->assign('list', $list);
            $this->display();
            exit();
        }

        $res = $LogListLogic->showLogList();
        $show = $res['show'];
        $list = $res['list'];
        $this->assign("page", $show);
        $this->assign("list", $list);
        $this->display();
    }

    /**
     * 查看日志全文
     */
    public function showLog()
    {
        $LogListLogic = new LogListLogic();
        $log_id = I('get.log_id', '', 'intval');
        $res = $LogListLogic->showLog($log_id);
        if ($res) {
            $this->assign('list', $res);
            $this->display();
        } else {
            $this->error("日志读取失败");
        }
    }

    /**
     * 显示日志修改界面
     */
    public function showEditLog()
    {
        $LogListLogic = new LogListLogic();
        $log_id = I('get.log_id' , '', 'intval');
        $res = $LogListLogic->showEditLog($log_id);
        if ($res) {
            $this->assign("log", $res);
            $this->display();
        } else {
            $this->error("日志读取失败");
        }
    }

    /**
     * 修改日志
     */
    public function editLog()
    {
        $log_name = I("post.log_name" , '', 'strip_tags');
        $content = I('post.content', '', 'htmlspecialchars');
        $log_id = I('post.log_id', '', 'intval');
        $check = "未审核";
        $grade = "null";
        $data = [
            'log_name' => $log_name,
            'content' => $content,
            'check' => $check,
            'grade' => $grade,
        ];

        $LogListLogic = new LogListLogic();
        $res = $LogListLogic->editLog($log_id, $data);
        if ($res) {
            $this->success("日志修改成功", U('Log/LogList/showOneLogList'), 3);
        } else {
            $this->error("日志修改失败");
        }
    }

    /**
     * 删除日志
     */
    public function deleteLog()
    {
        $LogListLogic = new LogListLogic();
        $log_id = I('get.log_id' ,'', 'intval');
        $res = $LogListLogic->deleteLog($log_id);
        if ($res) {
            $this->success("日志删除成功", U('Log/LogList/showOneLogList'), 3);
        } else {
            $this->error("日志删除失败");
        }
    }

    /**
     * 审核日志
     */
    public function checkLog()
    {
        $check = I('post.check' , '', 'strip_tags');
        $grade = I('post.grade', '', 'strip_tags');
        $log_id = I('get.log_id', '', 'intval');
        $position = I('session.position', '', 'strip_tags');
        $LogListLogic = new LogListLogic();
        $result = $LogListLogic->showLog($log_id);
        $log_check = $result['check'];

        if($position == "") {
            $this->error("需要部门经理和总经理才可以修改");
        }

        if ($log_check == "部门经理审核通过") {
            if ($position == '部门经理') {
                $this->error("部门经理已经审批完成");
            } else if ($position == '总经理') {
                $this->redirect('Log/LogList/checkLogManager', array('log_id' => $log_id), 1 ,'总经理进行审核');
            }
        } else if ($log_check == "审批完成") {
            $this->error("审批已经完成");
        } else {
            if ( $log_check == '未审核' && $position == '部门经理') {
                $this->redirect('Log/LogList/checkLogDeptManager', array('log_id' => $log_id), 1, '部门经理进行审核');
            } else if ($log_check == '未审核' && $position == '总经理') {
                $this->error("部门经理还未审核");
            } else if($log_check == '审核不通过') {
                $this->success("审核不通过，需要重新修改", U('Log/LogList/showLogList'), 3);
                exit();
            }
        }
        if($grade == "差") {
            $data = [
                'check' => "审核不通过",
                'grade' => $grade,
            ];
        } else {
            $data = [
                'check' => $check,
                'grade' => $grade,
            ];
        }

//        $data = [
//            'check' => $check,
//            'grade' => $grade,
//        ];

        $log_id = I("post.log_id", '', 'intval');

        $res = $LogListLogic->checkLog($log_id, $data);
        if ($res) {
            $this->success("日志审批成功", U('Log/LogList/showLogList'), 3);
        } else {
            $this->error("日志审批失败");
        }
    }

    /**
     * 部门经理审核日志
     */
    public function checkLogDeptManager() {

        $log_id = I('log_id' , '', 'intval');
        $res = [
            'log_id' => $log_id,
        ];
        $this->assign('list', $res);
        $this->display();
    }

    /**
     * 总经理审核日志
     */
    public function checkLogManager() {

        $log_id = I('log_id', '', 'intval');
        $res = [
            'log_id' => $log_id,
        ];
        $this->assign('list', $res);
        $this->display();

    }
}



















