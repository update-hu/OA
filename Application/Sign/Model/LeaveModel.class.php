<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/15
 * Time: 14:48
 */
namespace Sign\Model;

/**
 * 请假Model
 */
class LeaveModel extends SignBaseModel {
    /**
     * 构造函数
     */
    public function __construct($name = '', $tableName = '', $connection = '')
    {
        parent::__construct($name, $tableName, $connection);
    }
}