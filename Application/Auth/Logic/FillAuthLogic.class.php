<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/22
 * Time: 15:06
 */
namespace Auth\Logic;

use Auth\Model\Auth_ruleModel;
use OCommon\Logic\BaseLogic;

/**
 * 新增权限Logic
 */
class FillAuthLogic extends BaseLogic {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 新增权限
     */
    public function addAuth($data) {
        $auth_rule = new Auth_ruleModel();
        $res = $auth_rule->addData($data);
        return isset($res) ? true : false;
    }










}











