<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/17
 * Time: 16:27
 */
namespace Game\Model;

use Think\Model;

class AdCpaModel extends Model {

    public function _select($where, $fields, $order, $group, $limit, $offset) {
        $data = $this
            ->where($where)
            ->field($fields)
            ->group($group)
            ->order($order)
            ->limit($limit, $offset)
            ->select();

        return $data;
    }

}