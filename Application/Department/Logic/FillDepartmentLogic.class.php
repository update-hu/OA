<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/9
 * Time: 16:11
 */
namespace Department\Logic;


use Department\Model\DepartmentModel;
use OCommon\Logic\BaseLogic;

/**
 * 修改部门信息Logic
 */
class FillDepartmentLogic extends BaseLogic {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 添加部门
     */
    public function addDepartment($data) {
        $DepartmentModel = new DepartmentModel();
        $res = $DepartmentModel->addData($data);
        if($res) {
            return true;
        } else {
            return false;
        }
    }



}




















