<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/15
 * Time: 15:02
 */
namespace Sign\Controller;

use OCommon\Controller\BaseController;
use Sign\Logic\SignListLogic;

/**
 * 签到Controller
 */
class SignListController extends BaseController {
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
        $SignListLogic = new SignListLogic();
        $name = I('get.name', '', 'strip_tags');
        $employee_name = trim($name);
        $time = I('get.time', '', 'strip_tags');
        $time2 = I('get.time2', '', 'strip_tags');

        if($employee_name != '') {
            $res = $SignListLogic->findSignByName($employee_name);
            $show = $res['show'];
            $list = $res['list'];
            $array = [
                'name' => $name,
            ];
            $this->assign('sign', $array);
            $this->assign('page',$show);
            $this->assign('list', $list);
            $this->display();
            exit();
        }
        if($time != '' && $time2 != '') {
            $res = $SignListLogic->findSignByTime($time, $time2);
            $show = $res['show'];
            $list = $res['list'];
            $array = [
                'time' => $time,
                'time2' => $time2,
            ];
            $this->assign('sign', $array);
            $this->assign('page',$show);
            $this->assign('list', $list);
            $this->display();
            exit();
        }

        $res = $SignListLogic->showSignList();
        $show = $res['show'];
        $list = $res['list'];
        $this->assign('page', $show);
        $this->assign("list", $list);
        $this->display();
    }

    /**
     * 显示单个员工签到列表
     */
    public function showOneSignList() {
        $SignListLogic = new SignListLogic();
        $time = I('get.time', '', 'strip_tags');
        $time2 = I('get.time2', '', 'strip_tags');
        $employee_id = I('session.employee_id', '', 'intval');
        if($time != "" && $time2 != "") {
            $res = $SignListLogic->findOneSignByTime($employee_id, $time, $time2);
            $show = $res['show'];
            $list = $res['list'];
            $array = [
                'time' => $time,
                'time2' => $time2,
            ];
            $this->assign('page', $show);
            $this->assign('list', $list);
            $this->assign('sign', $array);
            $this->display();
            exit();

//            $arr = array();
//            $k = 0;
//            for($i = 0; $i < sizeof($res); $i++) {
//                if($employee_id == $res[$i]['employee_id']) {
//                    $arr[$k] = $res[$i];
//                    $k++;
//                }
//            }
//            $arr[0]['name'] = I('session.name', '', 'strip_tags');
//            $this->assign('list', $arr);
//            $this->display();
//            exit();
        }

        $res = $SignListLogic->showOneSignList($employee_id);
        $show = $res['show'];
        $list = $res['list'];
        $this->assign('page', $show);
        $this->assign("list", $list);
        $this->display();
    }

    /**
     * 员工签到
     */
    public function addSign() {
        $start_time = I('post.start_time', '', 'strip_tags');
        $end_time = I('post.end_time', '', 'strip_tags');
        if($start_time == '' && $end_time == '') {
            $this->display();
            exit();
        }

        $employee_id = I('session.employee_id', '', 'intval');
        if($start_time != '') {
            $data = [
                'start_time' => $start_time,
            ];
        } else {
            $data = [
                'end_time' => $end_time,
            ];
        }
        $SignListLogic = new SignListLogic();
        $res = $SignListLogic->addSign($employee_id, $data);

        if($res == "上班签到已经签完") {
            $this->error("今天上班签到已经签完");
        } else if($res == "下班签到已经签完") {
            $this->error("今天下班签到已经签完");
        } else if($res =="上班签到还未签") {
            $this->error("今天上班签到还未签");
        } else if( $res == "完成") {
            $this->success("签到成功",U('Sign/SignList/showOneSignList'),3);
        } else {
            $this->error("签到失败");
        }

    }

    /**
     * 删除签到信息
     */
    public function deleteSign() {
        $sign_id = I('get.sign_id', '', 'intval');
        $SignListLogic = new SignListLogic();
        $res = $SignListLogic->deleteSign($sign_id);
        if($res) {
            $this->success("签到删除成功", U('Sign/SignList/showOneSignList'), 3);
        } else {
            $this->error("签到删除失败");
        }
    }


}
































