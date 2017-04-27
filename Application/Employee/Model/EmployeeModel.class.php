<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/7
 * Time: 16:31
 */
namespace Employee\Model;


/**
 *员工填写信息Model
 */
class EmployeeModel extends EmployeeBaseModel {

    /**
     * 构造函数
     */
    public function __construct($name = '', $tableName = '', $connection = '')
    {
        parent::__construct($name, $tableName, $connection);
    }





}



