<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/17
 * Time: 16:30
 */
namespace Game\Model;

use Think\Model;

class AdCpaannalModel extends Model {

    public function _select($where, $fields, $order, $limit, $offset) {

        $data = $this
            ->field($fields)
            ->where($where)
            ->order($order)
            ->limit($limit, $offset)
            ->select();

        if($data) {
            return $limit ? $data[0] : $data;
        } else {
            return false;
        }

    }

    public function count_by_search($where, $fields) {
        if($fields) {
            $result = $this->where($where)->count($fields);
        } else {
            $result = $this->where($where)->count();
        }
        return $result;
    }

}