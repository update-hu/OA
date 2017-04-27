<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/9
 * Time: 16:10
 */
namespace Department\Logic;

use Department\Model\DepartmentModel;
use OCommon\Logic\BaseLogic;

/**
 * 部门列表Logic
 */
class DepartmentListLogic extends BaseLogic {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 显示部门列表
     */
    public function showList() {
        $Department = M('Department');
        $count = $Department->count();
        $p = getPage($count,5);
        $show = $p->show();
        $list = $Department->limit($p->firstRow.','.$p->listRows)->select();

        $EmployeeModel = M('Employee');
        for($i = 0; $i < sizeof($list); $i++) {
            $department_id = $list[$i]['department_id'];
            $where = [
                'department_id' => $department_id,
            ];
            $num = $EmployeeModel->where($where)->count();
            $list[$i]['num'] = $num;
        }

//        var_dump($show);
//        var_dump($list);
//        exit();

        $array = [
            'show' => $show,
            'list' => $list,
        ];

        return $array;
    }

    /**
     * 根据部门名称搜索部门
     */
    public function findDepartmentByName($dept_name) {
        $DepartmentModel = new DepartmentModel();
        $where['dept_name'] = array('like', '%'.$dept_name.'%');
        $count = $DepartmentModel->where($where)->count();
        $p = getPage($count, 5);
        $show = urldecode($p->show());
        $list = $DepartmentModel->where($where)->limit($p->firstRow.','.$p->listRows)->select();

        $EmployeeModel = M('Employee');
        for($i = 0; $i < sizeof($list); $i++) {
            $department_id = $list[$i]['department_id'];
            $where = [
                'department_id' => $department_id,
            ];
            $num = $EmployeeModel->where($where)->count();
            $list[$i]['num'] = $num;
        }

        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;

    }

    /**
     * 根据部门ID搜索部门
     */
    public function findDepartmentById($department_id) {
        $DepartmentModel = new DepartmentModel();
        $where = [
            'department_id' => $department_id,
        ];
        $res = $DepartmentModel->findByWhere($where);
        return $res;
    }

    /**
     * 修改部门信息
     */
    public function editDepartment($department_id, $data) {
        $DepartmentModel = new DepartmentModel();
        $where = [
            'department_id' => $department_id,
        ];
        $res = $DepartmentModel->updateByWhere($where, $data, '');
        if($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除部门信息
     */
    public function deleteDepartment($department_id) {
        $DepartmentModel = new DepartmentModel();
        $where = [
            'department_id' => $department_id,
        ];
        $res = $DepartmentModel->deleteByWhere($where, '');

        if($res) {
            return true;
        } else {
            return false;
        }
    }

}





























