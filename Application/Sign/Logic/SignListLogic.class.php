<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/15
 * Time: 15:05
 */
namespace Sign\Logic;

use Employee\Model\EmployeeModel;
use OCommon\Logic\BaseLogic;
use Sign\Model\SignModel;

/**
 * 员工签到Logic
 */
class SignListLogic extends BaseLogic {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 显示所有员工签到列表
     */
    public function showSignList() {
        $SignModel = new SignModel();
        $count = $SignModel->count();
        $p = getPage($count, 5);
        $show = $p->show();
        $list = $SignModel->join('employee on sign.employee_id = employee.employee_id')->limit($p->firstRow.','.$p->listRows)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;
    }

    /**
     * 显示单个员工签到列表
     */
    public function showOneSignList($employee_id) {
        $SignModel = new SignModel();
        $where = [
            'sign.employee_id' => $employee_id,
        ];
        $count = $SignModel->where($where)->count();
        $p = getPage($count, 5);
        $show = $p->show();
        $list = $SignModel->join('employee on sign.employee_id = employee.employee_id ')->limit($p->firstRow.','.$p->listRows)->where($where)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;

    }

    /**
     * 员工上班签到
     */
    public function addSign($employee_id, $data) {
        $SignModel = new SignModel();
        $where = [
            'employee_id' => $employee_id,
        ];
        $result = $SignModel->selectByWhere($where);
        $arr = array();

        if(isset($data['start_time'])) {
            $start = substr($data['start_time'], 0, 10);
//            var_dump($result);
//            exit();
            for($i = 0; $i<sizeof($result); $i++) {
                $sqlstart = substr($result[$i]['start_time'], 0, 10);
                if($sqlstart == $start ) {
                    return "上班签到已经签完";
                }
            }
            $data = [
                'employee_id' => $employee_id,
                'start_time' => $data['start_time'],
            ];
            $res = $SignModel->addData($data);
            return isset($res) ? "完成" : false;
        }

        if(isset($data['end_time'])) {
            $end = substr($data['end_time'], 0, 10);
            for($i = 0; $i<sizeof($result); $i++) {
                $sqlstart = substr($result[$i]['start_time'], 0, 10);
                $sqlend = substr($result[$i]['end_time'], 0, 10);
                $sign_id = $result[$i]['sign_id'];
//                var_dump($end);
//                var_dump($sqlstart);
//                var_dump($sqlend);
//                var_dump($sign_id);
//                exit();
                if($end == $sqlstart) {
                    if($sqlend != '') {
                        return "下班签到已经签完";
                    } else {
                        $where = [
                            'sign_id' => $sign_id,
                        ];
                        $res = $SignModel->updateByWhere($where, $data);
                        return isset($res) ? "完成" : false;
                    }
                }
            }
            return "上班签到还未签";
        }



        for($i = 0; $i < sizeof($result); $i++) {
            $r = $result[$i]['start_time'];
            $arr[$i]['start_time'] = substr($r,-11, 2);
            $arr[$i]['sign_id'] = $result[$i]['sign_id'];
        }

        $time = substr($data['start_time'], -11, 2);
        $h = 0;
        for($k = 0; $k < sizeof($arr); $k++) {
            if($time == $arr['$k']) {
                $h++;
                break;
            }
        }

        if($h == 1) {
            $wh = [
                'sign' => $arr[$k]['sign_id'],
            ];
            $res = $SignModel->updateByWhere($wh, $data, '');
            return isset($res) ? true : false;
        } else {
            $data['employee_id'] = $employee_id;
            $res = $SignModel->addData($data);
            return isset($res) ? true : false;
        }

    }

    /**
     * 员工下班签到
     */
    public function addXiaSign($employee_id, $data) {

    }

    /**
     * 删除签到信息
     */
    public function deleteSign($sign_id) {
        $SignModel = new SignModel();
        $where = [
            'sign_id' => $sign_id,
        ];
        $res = $SignModel->deleteByWhere($where);
        return isset($res) ? true : false;
    }

    /**
     * 查询员工姓名
     */
    public function findSignByName($name) {
        $Employee = new EmployeeModel();
        $where = [
            'name' => array('like', '%'.$name.'%'),
        ];

        $res = $Employee->selectByWhere($where);

        $arr = array();
        for($i = 0; $i < sizeof($res); $i++) {
            $arr[$i] = $res[$i]['employee_id'];
        }

        $SignModel = new SignModel();
        $where2 = [
            'sign.employee_id' => array('in', $arr),
        ];
        $count = $SignModel->where($where2)->count();
        $p = getPage($count, 5);
        $show = urldecode($p->show());
        $list = $SignModel->join('employee on sign.employee_id = employee.employee_id')->limit($p->firstRow.','.$p->listRows)->where($where2)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;
    }



    /**
     * 根据时间查询单个员工签到
     */
    public function findOneSignByTime($employee_id, $time, $time2) {
        $time2 = date("Y-m-d", strtotime("$time2 +1 day"));
        $SignModel = new SignModel();
        $where = [
            'sign.employee_id' => $employee_id,
            'start_time' => array('between', array($time, $time2) ),
        ];
        $count = $SignModel->where($where)->count();
        $p = getPage($count, 5);
        $show = $p->show();
        $list = $SignModel->join('employee on sign.employee_id = employee.employee_id')->limit($p->firstRow.','.$p->listRows)->where($where)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;
    }

    /**
     * 根据时间查询
     */
    public function findSignByTime($time, $time2) {
        $time2 = date("Y-m-d", strtotime("$time2 +1 day"));
        $SignModel = new SignModel();
        $where = [
            'start_time' => array('between', array($time, $time2)),
//            'start_time' => array('like', '%'.$time.'%'),
        ];
        $count = $SignModel->where($where)->count();
        $p = getPage($count, 5);
        $show = $p->show();
        $list = $SignModel->join('employee on sign.employee_id = employee.employee_id')->limit($p->firstRow.','.$p->listRows)->where($where)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;


//        $res = $SignModel->select();
//        $arr = array();
//        $k = 0;
//        for($i = 0; $i < sizeof($res); $i++) {
//            $datetime = substr($res[$i]['start_time'], 0, 10);
//            if($time == $datetime) {
//                $EmployeeModel = new EmployeeModel();
//                $employee_id = $res[$i]['employee_id'];
//                $employee = $EmployeeModel->findByWhere(array('employee_id' => $employee_id));
//
//                $arr[$k] = $res[$i];
//                $arr[$k]['name'] = $employee['name'];
//                $k++;
//            }
//        }
//        return $arr;

    }

}




















































































