<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/22
 * Time: 15:06
 */
namespace Auth\Logic;

use Auth\Model\Auth_groupModel;
use OCommon\Logic\BaseLogic;

/**
 * 新增用户组（角色）Logic
 */
class FillRoleLogic extends BaseLogic {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 新增角色
     */
    public function addRole($data) {
        $auth_group = new Auth_groupModel();
        $res = $auth_group->addData($data);
        return isset($res) ? true : false;
    }
}