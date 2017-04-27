<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 10:44
 */
namespace Train\Model;

use OCommon\Model\BaseModel;

/**
 * 模块基础Model
 */
class TrainBaseModel extends BaseModel {
    /**
     * 构造函数
     */
    public function __construct($name = '', $tableName = '', $connection = '')
    {
        parent::__construct($name, $tableName, $connection);
    }


}































