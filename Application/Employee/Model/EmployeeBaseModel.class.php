<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/8
 * Time: 10:06
 */
namespace Employee\Model;


use OCommon\Model\BaseModel;

/**
 * 模块基础Model
 */
class EmployeeBaseModel extends BaseModel {

    /**
     * 构造函数
     */
    public function __construct($name = '', $tableName = '', $connection = '')
    {
        parent::__construct($name, $tableName, $connection);
    }
}






























