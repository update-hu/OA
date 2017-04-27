<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/22
 * Time: 14:40
 */
namespace Auth\Model;

use OCommon\Model\BaseModel;

/**
 * 权限基础Model
 */
class AuthBaseModel extends BaseModel {
    /**
     * 构造函数
     */
    public function __construct($name = '', $tableName = '', $connection = '')
    {
        parent::__construct($name, $tableName, $connection);
    }
}