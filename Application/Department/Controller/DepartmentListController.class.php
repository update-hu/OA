<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/9
 * Time: 16:04
 */
namespace Department\Controller;

use Department\Logic\DepartmentListLogic;
use Employee\Model\EmployeeModel;
use OCommon\Controller\BaseController;

/**
 * 部门列表Controller
 */
class DepartmentListController extends BaseController {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 显示部门列表
     */
    public function showDepartmentList() {
        $DepartmentListLogic = new DepartmentListLogic();
        $name = I('get.dept_name' ,'', 'strip_tags');
        $dept_name = trim($name);

        //如果有部门名称，则进行查询操作
        if($dept_name != "") {
            $res = $DepartmentListLogic->findDepartmentByName($dept_name);
            $show = $res['show'];
            $list = $res['list'];
            $array = [
                'dept_name' => $name,
            ];
            $this->assign('dept', $array);
            $this->assign('page', $show);
            $this->assign('list', $list);
            $this->display();
            exit();
        }

        $res = $DepartmentListLogic->showList();


        if($res) {
            $this->assign('page', $res['show']);
            $this->assign("list",$res['list']);
            $this->display();
        } else {
            $this->error("部门列表读取失败");
        }
    }

    /**
     * 修改部门信息
     */
    public function editDepartment() {
        $department_id = I('get.department_id', '', 'intval');
        $DepartmentListLogic = new DepartmentListLogic();
        if($department_id != '') {
            $result = $DepartmentListLogic->findDepartmentById($department_id);
            $this->assign('list', $result);
            $this->display();
            exit();
        }
        $department_id = I('post.department_id', '', 'intval');
        $dept_name = I('post.dept_name', '', 'strip_tags');
        $data = [
            'dept_name' => $dept_name,
        ];

        $res = $DepartmentListLogic->editDepartment($department_id, $data);
        if($res) {
            $this->success("部门信息修改成功",U('/Department/DepartmentList/showDepartmentList'),3);
        } else {
            $this->error("部门信息修改失败");
        }
    }

    /**
     * 删除部门
     */
    public function deleteDepartment() {
        $department_id = I('get.department_id', '', 'intval');
        $DepartmentListLogic = new DepartmentListLogic();
        $res = $DepartmentListLogic->deleteDepartment($department_id);
        if($res) {
            $this->success("部门删除成功",U("/Department/DepartmentList/showDepartmentList"),3);
        } else {
            $this->error("部门删除失败");
        }
    }

}




























