<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/17
 * Time: 16:01
 */
namespace Game\Logic;

use Game\Model\LockUserModel;

class UserLogic {

    public function __construct($userID = '')
    {
        $this->userID = $userID;
    }

    public function check_user_lock($userID) {

        $LockUserModel = new LockUserModel();
        $where = array('userID' => $userID);
        $field = array('userID', 'status', 'game');
        $lock_info = $LockUserModel->_select($where, $field, [], 1);
        if($lock_info) {
            if($lock_info['status'] == 0) {
                return true;
            }
            if($lock_info['game'] == 0) {
                return true;
            }
        }
        return false;












    }











 }