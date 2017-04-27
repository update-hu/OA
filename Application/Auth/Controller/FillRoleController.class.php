<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/22
 * Time: 15:04
 */
namespace Auth\Controller;

use Auth\Logic\FillRoleLogic;
use OCommon\Controller\BaseController;

/**
 * 新增用户组（角色）Controller
 */
class FillRoleController extends BaseController {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 新增角色
     */
    public function addRole() {
        $title = I("post.title");
        if($title == "") {
            $this->display();
            exit();
        }
        $data = [
            'title' => $title,
        ];
        $FillRoleLogic = new FillRoleLogic();
        $res = $FillRoleLogic->addRole($data);
        if($res) {
            $this->success("角色添加成功", U('Auth/RoleList/showRoleList'), 3);
        } else {
            $this->error("角色添加失败");
        }
    }





}