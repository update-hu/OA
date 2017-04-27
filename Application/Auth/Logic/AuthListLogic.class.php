<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/22
 * Time: 14:21
 */
namespace Auth\Logic;

use Auth\Model\Auth_ruleModel;
use OCommon\Logic\BaseLogic;

/**
 * 权限管理Logic
 */
class AuthListLogic extends BaseLogic {
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
        $auth_rule = new Auth_ruleModel();
        $count = $auth_rule->count();
        $p = getPage($count, 20);
        $show = $p->show();
        $list = $auth_rule->limit(($p->firstRow.','.$p->listRows))->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;
    }

    /**
     * 显示权限修改界面
     */
    public function showEditAuth($id) {
        $auth_rule = new Auth_ruleModel();
        $where = [
            'id' => $id,
        ];
        $res = $auth_rule->findByWhere($where);
        return isset($res) ? $res : false;
    }

    /**
     * 修改权限
     */
    public function editAuth($id, $data) {
        $auth_rule = new Auth_ruleModel();
        $where = [
            'id' => $id,
        ];
        $res = $auth_rule->updateByWhere($where, $data, '');
        return isset($res) ? true : false;
    }


    /**
     * 删除权限
     */
    public function deleteAuth($id) {
        $auth_rule = new Auth_ruleModel();
        $where = [
            'id' => $id,
        ];
        $res = $auth_rule->deleteByWhere($where, '');
        return isset($res) ? true : false;
    }


}




















