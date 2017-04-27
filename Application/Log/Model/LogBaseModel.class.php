<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/10
 * Time: 14:57
 */
namespace Log\Model;

use OCommon\Model\BaseModel;

/**
 * 模块基础Model
 */
class LogBaseModel extends BaseModel {
    /**
     * 构造函数
     */
    public function __construct($name = '', $tableName = '', $connection = '')
    {
        parent::__construct($name, $tableName, $connection);
    }
}