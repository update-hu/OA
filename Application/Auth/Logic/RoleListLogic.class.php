<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/22
 * Time: 14:22
 */
namespace Auth\Logic;

use Auth\Model\Auth_groupModel;
use OCommon\Logic\BaseLogic;

/**
 * 用户组（角色）Logic
 */
class RoleListLogic extends BaseLogic {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 显示角色列表
     */
    public function showRoleList() {
        $auth_group = new Auth_groupModel();
        $count = $auth_group->count();
        $p = getPage($count, 3);
        $show = $p->show();
        $list = $auth_group->limit(($p->firstRow.','.$p->listRows))->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;
    }


    /**
     * 显示角色修还界面
     */
    public function showEditRole($id) {
        $auth_group = new Auth_groupModel();
        $where = [
            'id' => $id,
        ];
        $res = $auth_group->findByWhere($where, '');
        return isset($res) ? $res : false;
    }

    /**
     * 修改角色信息
     */
    public function editRole($id, $data) {
        $auth_group = new Auth_groupModel();
        $where = [
            'id' => $id,
        ];
        $res = $auth_group->updateByWhere($where, $data, '');
        return isset($res) ? true : false;
    }



    /**
     * 删除角色
     */
    public function deleteRole($id) {
        $auth_group = new Auth_groupModel();
        $where = [
            'id' => $id,
        ];
        $res = $auth_group->deleteByWhere($where, '');
        return isset($res) ? true : false;
    }

    /**
     * 显示权限分配界面
     */
    public function showRoleAuth($id) {
        $auth_group = new Auth_groupModel();
        $where = [
            'id' => $id,
        ];
        $res = $auth_group->where($where)->find();
        return $res;
    }

    /**
     * 更新角色权限
     */
    public function roleAuth($id, $data) {
        $auth_group = new Auth_groupModel();
        $where = [
            'id' => $id,
        ];
        $res = $auth_group->updateByWhere($where, $data, '');
        return isset($res) ? true : false;
    }






















}