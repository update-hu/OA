<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/15
 * Time: 14:42
 */
namespace Sign\Model;

use OCommon\Model\BaseModel;

/**
 * 模块基础Model
 */
class SignBaseModel extends BaseModel {
    /**
     * 构造函数
     */
    public function __construct($name = '', $tableName = '', $connection = '')
    {
        parent::__construct($name, $tableName, $connection);
    }
}