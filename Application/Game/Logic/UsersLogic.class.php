<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/17
 * Time: 16:44
 */
namespace Game\Logic;

class UsersLogic {

    public function get_user_info($userID) {

        $users = M('Users')->where(array('userID' => $userID))->find();
        return $users;

    }



}