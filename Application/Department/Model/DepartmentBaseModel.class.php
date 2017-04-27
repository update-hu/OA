<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/9
 * Time: 16:01
 */
namespace Department\Model;


use OCommon\Model\BaseModel;

/**
 * 部门基础Model
 */
class DepartmentBaseModel extends BaseModel {
    /**
     * 构造函数
     */
    public function __construct($name = '', $tableName = '', $connection = '')
    {
        parent::__construct($name, $tableName, $connection);
    }
}