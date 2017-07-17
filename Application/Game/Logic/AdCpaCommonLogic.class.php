<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/17
 * Time: 15:44
 */
namespace Game\Logic;

use Game\Model\AdCpaannalModel;
use Game\Model\AdCpaModel;
use Game\Model\CommonModel;

class AdCpaCommonLogic extends CommonModel {

    protected $adminIDsArr = array(
        '10001',
        '500002',
        '500003'
    );

    public function game_jump($userID, $userIP, $adID, $code = '') {

        $lockLogic = new UserLogic($userID);
        if($lockLogic->check_user_lock($userID)) {
            return array('code' => 10001, 'msg' => '帐号已锁定');
        }

        $adminIDsArr = $this->adminIDsArr;
        $AdCpaModel = new AdCpaModel();
        $VipLogic = new VipLogic();
        $AdCpaannalModel = new AdCpaannalModel();
        $vip = $VipLogic->get_user_vip($userID);
        $UsersLogic = new UsersLogic();
        $sessionArr = $UsersLogic->get_user_info($userID);

        if(!$userID) {
            return array('code' => 10002, 'msg' => '用户ID为空');
        } elseif($sessionArr['userState'] == 3) {
            return array('code' => 10003, 'msg' => '帐号已被锁定');
        }

        if(!$adID) {
            return array('code' => 10004, 'msg' => '广告ID为空');
        }
        $where = array(
            'adID' => $adID
        );

        $arrIsAd = $AdCpaModel->_select($where,[] ,[], [], 1);

        if(empty($arrIsAd)) {
            return array('code' => 10004, 'msg' => '广告不存在');
        }

        if($userIP != '218.108.191.87') {
            if($arrIsAd['isFull'] == 0) {
                return array('cdoe' => 10005, 'msg' => '广告已满，请体验其他广告');
            }
            if($arrIsAd['adState'] == 1 && $arrIsAd['isWait'] == 1) {
                $uDate = date('Y-m-d', $arrIsAd['uDate']);
                return array('code' => 10006, 'msg' => '此广告将于'.$uDate.'上线，敬请期待');
            }
            if($arrIsAd['adState'] == 3 && !in_array($userID, $adminIDsArr)) {
                return array('code' => 10007, 'msg' => '广告还在测试中，请体验其他广告');
            }
            if($arrIsAd['adState'] == 0) {
                return array('code' => 10008, 'msg' => '广告已锁定，请体验其他广告');
            }
            if($arrIsAd['vipLimit'] >0 && $vip['myVip'] < $arrIsAd['vipLimit'] && (!$vip['vipType'] || $vip['svipType'])) {
                return array('code' => 10009, 'msg' => '此广告只能由'.$arrIsAd['vipLimit'].'以上等级的玩家试玩');
            }

            if(!$this->reg_control($userID) && !in_array($userID, $adminIDsArr)) {

            }
        }






















    }

    public function reg_control($userID) {
        if(empty($userID)) {
            return false;
        }

        $table = M('users');
        $date = $table->where(array('userID' => $userID,))->find();

        if(!$date) {
            return false;
        }
        return $data;

    }














}