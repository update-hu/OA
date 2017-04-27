<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/2
 * Time: 17:49
 */
namespace Login\Model;
use OCommon\Model\BaseModel;


/**
 * 员工数据模型
 */
class EmployeeModel extends BaseModel {

    /**
     * 构造函数
     */
    public function __construct($name = '', $tableName = '', $connection = '')
    {
        parent::__construct($name, $tableName, $connection);
    }



}