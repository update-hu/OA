<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/2
 * Time: 13:56
 */
namespace OCommon\Model;


use Think\Model;

/**
 * 全局基础Model
 */
class BaseModel extends Model {

    /**
     * 构造函数
     */
    public function __construct($name='', $tableName='', $connection = '') {
        parent::__construct($name='', $tableName='', $connection='');
    }

    /**
     * 数据操作
     * 1：添加一组数据
     * 2：更具条件删除
     * 3：根据条件更新数据
     * 4：根据条件查找一条数据
     * 5：根据条件查找一组数据
     * 6：根据条件统计条数
     * 7：根据条件求和
     */

    /**
     * 添加一组数据
     */
    public function addData($data) {
        $result = $this->data($data)->add();
        return $result;
    }

    /**
     *根据条件删除数据
     */
    public  function deleteByWhere($where, $limit = null) {
        $result = $this->where($where)->limit($limit)->delete();
        return $result;
    }

    /**
     * 根据条件更新数据
     */
    public function updateByWhere($where, $data, $limit = null) {
        $result = $this->where($where)->data($data)->limit($limit)->save();
        return $result;
    }

    /**
     * 根据条件查找一条数据
     */
    public function findByWhere($where, $field = []) {
        if($field) {
            $t = $this->where($where)->field($field);
        } else {
            $t = $this->where($where);
        }

        $result = $t->find();
        return $result;
    }

    /**
     * 根据条件查询一组数据
     */
    public function selectByWhere($where, $order = [], $offset = 0, $limit = 0, $field = [] ) {
        if($field) {
            $t = $this->where($where)->field($field);
        } else {
            $t = $this->where($where);
        }

        if($order) {
            $t->order($order);
        }

        if($offset && $limit) {
            $t->limit($offset, $limit);
        } elseif ($limit) {
            $t->limit($limit);
        }
        $result = $t->select();
        return $result;
    }

    /**
     * 根据条件统计条数
     */
    public function countByWhere($where, $field = '') {
        if($field) {
            $result = $this->where($where)->count($field);
        } else {
            $result = $this->where($where)->count();
        }
        return $result;
    }

    /**
     * 根据条件求和
     */
    public function sumByWhere($where, $field = '') {
        $result = $this->where($where)->sum($field);
        return $result;
    }



}







































