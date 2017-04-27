<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/22
 * Time: 14:18
 */
namespace Auth\Controller;

use Auth\Logic\AuthListLogic;
use OCommon\Controller\BaseController;

/**
 * 权限管理Controller
 */
class AuthListController extends BaseController {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }


    /**
     * 显示权限列表
     */
    public function showAuthList() {
        $AuthListLogic = new AuthListLogic();
        $res = $AuthListLogic->showAuthList();
        $show = $res['show'];
        $list = $res['list'];
        $this->assign("page", $show);
        $this->assign("list", $list);
        $this->display();
    }

    /**
     * 显示权限修改界面
     */
    public function showEditAuth() {
        $id = I('get.id');
        $AuthListLogic = new AuthListLogic();
        $res = $AuthListLogic->showEditAuth($id);
        if($res) {
            $this->assign('list', $res);
            $this->display();
        } else {
            $this->error("权限信息读取失败");
        }
    }

    /**
     * 修改权限
     */
    public function editAuth() {
        $id = I('post.id');
        $name = I('post.name');
        $title = I('post.title');
        $data = [
            'name' => $name,
            'title' => $title,
        ];
        $AuthListLogic = new AuthListLogic();
        $res = $AuthListLogic->editAuth($id, $data);
        if($res) {
            $this->success("权限信息修改成功", U('Auth/AuthList/showAuthList'), 3);
        } else {
            $this->error("权限修改失败");
        }
    }

    /**
     * 删除权限
     */
    public function deleteAuth() {
        $id = I('get.id');
        $AuthListLogic = new AuthListLogic();
        $res = $AuthListLogic->deleteAuth($id);
        if($res) {
            $this->success("权限删除成功", U("Auth/AuthList/showAuthList"), 3);
        } else {
            $this->error("权限删除失败");
        }
    }






}


















