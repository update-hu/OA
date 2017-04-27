<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/10
 * Time: 17:04
 */
namespace Log\Logic;

use Log\Model\LogModel;
use OCommon\Logic\BaseLogic;

/**
 * 填写日志Logic
 */
class FillLogLogic extends BaseLogic {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 填写新日志
     */
    public function addLog($data) {
        $LogModel = new LogModel();
        $res = $LogModel->addData($data);
        if($res) {
            return true;
        } else {
            return false;
        }
    }
}































