<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/7
 * Time: 16:37
 */
namespace Employee\Logic;

use Employee\Model\EmployeeModel;
use OCommon\Logic\BaseLogic;

session_start();
/**
 *员工填写自己详细信息业务逻辑
 */
class FillEmployeeLogic extends BaseLogic {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     *添加自己详细信息
     */
    public function addEmployee( $employee_id ,$arr = array()) {



        $Employee = new EmployeeModel();
        $where['employee_id'] = $employee_id;

        $res = $Employee->updateByWhere($where, $arr, '');
        if($res) {
            return true;
        } else {
            return false;
        }



    }

}




















