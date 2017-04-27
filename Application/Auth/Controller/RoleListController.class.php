<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/22
 * Time: 14:20
 */
namespace Auth\Controller;
use Auth\Logic\RoleListLogic;
use OCommon\Controller\BaseController;

/**
 * 用户组（角色）Controller
 */
class RoleListController extends BaseController {
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
        $RoleListLogic = new RoleListLogic();
        $res = $RoleListLogic->showRoleList();
        $show = $res['show'];
        $list = $res['list'];
        $this->assign("page", $show);
        $this->assign("list", $list);
        $this->display();
    }

    /**
     * 显示修改角色界面
     */
    public function showEditRole() {
        $id = I('get.id', '', 'intval');
        $RoleListLogic = new RoleListLogic();
        $res = $RoleListLogic->showEditRole($id);
        if($res) {
            $this->assign("list", $res);
            $this->display();
        } else {
            $this->error("角色信息读取失败");
        }
    }

    /**
     * 修改角色信息
     */
    public function editRole() {
        $id = I('post.id');
        $title = I('post.title');
        $data = [
            'title' => $title,
        ];
        $RoleListLogic = new RoleListLogic();
        $res = $RoleListLogic->editRole($id, $data);
        if($res) {
            $this->success("角色信息修改成功", U('Auth/RoleList/showRoleList'), 3);
        } else {
            $this->error("角色信息修改失败");
        }
    }

    /**
     * 删除角色
     */
    public function deleteRole() {
        $id = I('get.id');
        $RoleListLogic = new RoleListLogic();
        $res = $RoleListLogic->deleteRole($id);
        if($res) {
            $this->success("角色删除成功", U('Auth/RoleList/showRoleList'), 3);
        } else {
            $this->error("角色删除失败");
        }
    }

    /**
     * 显示权限分配界面
     */
    public function showRoleAuth() {
        $id = I('get.id', '', 'intval');
        $RoleListLogic = new RoleListLogic();
        $res = $RoleListLogic->showRoleAuth($id);
        $this->assign('list', $res);
        $this->display();
    }

    /**
     * 更新角色权限
     */
    public function roleAuth() {
        $auth = I('post.roleauth');
        $id = I('post.id');
        $data = [
            'rules' => $auth,
        ];
        $RoleListLogic = new RoleListLogic();
        $res = $RoleListLogic->roleAuth($id, $data);
        if($res) {
            $this->success("权限分配成功", U('Auth/RoleList/showRoleList'), 3);
        } else {
            $this->error();
        }
    }


}








































