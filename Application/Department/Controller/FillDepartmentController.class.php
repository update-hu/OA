<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/9
 * Time: 16:07
 */
namespace Department\Controller;


use Department\Logic\FillDepartmentLogic;
use OCommon\Controller\BaseController;

/**
 * 新增部门Controller
 */
class FillDepartmentController extends BaseController {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 新增部门
     */
    public function addDepartment() {
        $dept_name = I('post.dept_name', '', 'strip_tags');
        if($dept_name == '') {
            $this->display();
            exit();
        }
        $FillDepartmentLogic = new FillDepartmentLogic();
        $data = [
            'dept_name' => $dept_name,
        ];
        $res = $FillDepartmentLogic->addDepartment($data);
        if($res) {
            $this->success("部门添加成功",U("/Department/DepartmentList/showDepartmentList"),3);
        } else {
            $this->error("部门添加失败");
        }
    }

}





















