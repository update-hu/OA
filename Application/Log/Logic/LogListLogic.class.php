<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/10
 * Time: 15:31
 */
namespace Log\Logic;


use Log\Model\LogModel;
use OCommon\Logic\BaseLogic;

/**
 * 列表显示Logic
 */
class LogListLogic extends BaseLogic {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 显示单个员工日志列表
     */
    public function showOneLogList($employee_id) {
        $LogModel = new LogModel();
        $where = [
            'employee_id' => $employee_id,
        ];
        $count = $LogModel->where($where)->count();
        $p = getPage($count, 5);
        $show = urldecode($p->show());
        $list = $LogModel->selectByWhere($where ,'', 0, ($p->firstRow.','.$p->listRows), '');
        $array = [
            'show' => $show,
            'list' => $list,
        ];

        return $array;
    }

    /**
     * 显示所有员工日志列表
     */
    public function showLogList() {
        $LogModel = new LogModel();

        $count = $LogModel->count();
        $p = getPage($count, 5);
        $show = $p->show();
        $list = $LogModel->join('employee on log.employee_id = employee.employee_id')->limit($p->firstRow.','.$p->listRows)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;
    }

    /**
     * 显示日志全文
     */
    public function showLog($log_id) {
        $LogModel = new LogModel();
        $where = [
            'log_id' => $log_id,
        ];
        $res = $LogModel->findByWhere($where,'');
        if($res) {
            return $res;
        } else {
            return false;
        }
    }

    /**
     * 显示修改日志界面
     */
    public function showEditLog($log_id) {
        $LogModel = new LogModel();
        $where = [
            'log_id' => $log_id,
        ];
        $res = $LogModel->findByWhere($where, '');
        if($res) {
            return $res;
        } else {
            return false;
        }
    }

    /**
     * 修改日志
     */
    public function editLog($log_id, $data) {
        $LogModel = new LogModel();
        $where = [
            'log_id' => $log_id,
        ];
        $res = $LogModel->updateByWhere($where, $data, '');
        if($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除日志
     */
    public function deleteLog($log_id) {
        $LogModel = new LogModel();
        $where = [
            'log_id' => $log_id,
        ];
        $res = $LogModel->deleteByWhere($where, '');
        if($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 日志审核
     */
    public function checkLog($log_id, $data) {
        $LogModel = new LogModel();
        $where = [
            'log_id' => $log_id,
        ];
        $res = $LogModel->updateByWhere($where, $data, '');
        return isset($res) ? true : false;
    }

 /**
 * 根据名称查找个人日志
 */
    public function findLogByName($employee_id, $log_name) {
        $LogModel = new LogModel();

        $where = [
            'employee_id' => $employee_id,
            'log_name' =>array('like', '%'.$log_name.'%'),
        ];
        $count = $LogModel->where($where)->count();
        $p = getPage($count, 5);
        $show = urldecode($p->show());
        $list = $LogModel->selectByWhere($where, '', 0, ($p->firstRow.','.$p->listRows), '');
        $array = [
            'show' => $show,
            'list' =>$list,
        ];
        return $array;

    }

    /**
     *根据时间查询个人日志
     */
    public function findLogByTime($employee_id, $time, $time2) {
        $LogModel = new LogModel();
        $where = [
            'employee_id' => $employee_id,
            'create_time' => array('between', array($time, $time2)),
        ];
        $count = $LogModel->where($where)->count();
        $p = getPage($count, 5);
        $show = $p->show();
        $list = $LogModel->selectByWhere($where, '', 0, ($p->firstRow.','.$p->listRows), '');
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;
    }


    /**
     * 根据名称查找所有人日志
     */
    public function findLogByNames($log_name) {
        $LogModel = new LogModel();
        $where['log_name'] = array('like', '%'.$log_name.'%');
        $count = $LogModel->where($where)->count();
        $p = getPage($count, 5);
        $show = urldecode($p->show());
        $list = $LogModel->join('employee on log.employee_id = employee.employee_id')->limit($p->firstRow.','.$p->listRows)->where($where)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;
    }


    /**
     * 根据时间查找所有人日志
     */
    public function findLogByTimes($time, $time2) {
        $LogModel = new LogModel();
        $where = [
            'create_time' => array('between', array($time, $time2)),
        ];
        $count = $LogModel->where($where)->count();
        $p = getPage($count, 5);
        $show = $p->show();
        $list = $LogModel->join('employee on log.employee_id = employee.employee_id')->limit($p->firstRow.','.$p->listRows)->where($where)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;
    }
}























