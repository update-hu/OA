<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/6
 * Time: 11:04
 */
namespace Home\Logic;


class UserLogic {

    public function check_user_chess_lock($userID) {
        if(!$userID) {
            return array('code' => 1000);
        }
        $info = M('lock_user')->where(array('userID' => $userID))->find();
        if(!$info) {
            return false;
        }
        if($info['status'] == 0) {
            return true;
        }
        if($info['chess'] == 0) {
            return true;
        }



    }

}