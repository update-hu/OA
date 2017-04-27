<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/8
 * Time: 16:40
 */
namespace Employee\Logic;


use Employee\Model\EmployeeModel;
use OCommon\Logic\BaseLogic;

/**
 * 修改账号信息Logic
 */
class ChangeAccLogic extends BaseLogic {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 修改账号信息
     */
    public function changeAccount($employee_id, $data) {
        $Employee = new EmployeeModel();
        $where = [
            'employee_id' => $employee_id,
        ];
        $res = $Employee->updateByWhere($where, $data, '');
        if($res) {
            return true;
        } else {
            return false;
        }
    }
}