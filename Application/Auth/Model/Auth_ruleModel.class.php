<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/22
 * Time: 14:42
 */
namespace Auth\Model;

/**
 * 权限表Model
 */
class Auth_ruleModel extends AuthBaseModel {
    /**
     * 构造函数
     */
    public function __construct($name = '', $tableName = '', $connection = '')
    {
        parent::__construct($name, $tableName, $connection);
    }
}