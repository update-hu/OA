<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/15
 * Time: 17:30
 */
namespace Sign\Logic;

use OCommon\Logic\BaseLogic;
use Sign\Model\LeaveModel;

/**
 * 新增请假Logic
 */
class FillLeaveLogic extends BaseLogic {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 新增请假
     */
    public function addLeave($data) {
        $LeaveModel = new LeaveModel();
        $res = $LeaveModel->data($data)->add();
        return isset($res) ? true : false;
    }
}






















