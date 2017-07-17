<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/17
 * Time: 16:04
 */
namespace Game\Model;

use Think\Model;

class LockUserModel extends Model {

    public function _select($where, $field, $order, $limit) {
        if($field) {
            $t = $this->where($where)->field($field);
        } else {
            $t = $this->where($where);
        }

        if($order) {
            $t->order($order);
        }

        $t = $this->limit($limit)->select();

        return $limit ? $t : $t['0'];
    }


}