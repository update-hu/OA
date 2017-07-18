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
                $jumpURL = '//www.juxiangyou.com/personal/Attest';
                return array('code' => 10010, 'msg' => '请先完成手机绑定', 'detailUrl' => $jumpURL);
            }
        }

        $where = array(
            'adID' => $adID,
            'userID' => $userID
        );
        $arrIsCode = $AdCpaannalModel->_select($where, '', '', 1);

        if($arrIsCode['playBind'] == 1) {
            $annalID = $arrIsCode['annalID'];
        } else {
            if($_GET['act']) {
                return array('code' => 10011, 'msg' => '您已成功注册，请开始体验游戏');
            }
        }

        $where = array('adID' => $adID);
        $arrData = array('todayHits' => array('exp', 'todayHits+1'), 'totalHits' => array('exp', 'totalHits+1'));
        $rs = $AdCpaModel->_update($where, $arrData);

        if($arrIsAd['dayMaxHits'] > 0) {
            if($arrIsAd['todatHits'] >= $arrIsAd['dayMaxHits']) {
                return array('code' => 10012, 'msg' => '对不起，广告今天已到量，请明天再体验');
            }
        }


        if($arrIsAd['dayMaxRegs'] > 0) {
            if($arrIsAd['todayRegs'] >= $arrIsAd['dayMaxRegs'] && $arrIsAd['isFull'] == 1) {
                $where = array('adID' => $adID);
                $arrData = array('mTime' => time(), 'isFull' => 0);
                if($rs = $AdCpaModel->_update($where, $arrData)) {
                    return array('code' => 10013, 'msg' => '广告注册今天已到量，请明天再体验');
                }
            }
        }

        if($arrIsAd['userMaxRegs'] > 0) {
            if($arrIsAd['totalRegs'] >= $arrIsAd['userMaxRegs'] && $arrIsAd['isFull'] == 1) {
                $where = array('adID' => $adID);
                $arrData = array('mTime' => time(), 'isFull' => 0);
                if($rs = $AdCpaModel->_update($where, $arrData)) {
                    return array('code' => 10014, 'msg' => '广告注册已到量，请体验其他广告');
                }
            }
        }

        $IPArr = $this->limit_IP($arrIsAd, $userIP, $adID, $userID);
        if($IPArr['code'] != 10000) {
            return $IPArr;
        }





























    }

    public function reg_control($userID) {
        if(empty($userID)) {
            return false;
        }

        $table = M('users');
        $data = $table->where(array('userID' => $userID,))->find();

        if(!$data) {
            return false;
        }
        return $data;

    }

    public function limit_IP($arrIsAd, $userIP, $adID, $userID) {

        $flg = array(
            'code' => 1000,
            'mssg' => ''
        );

        $AdCpaannalModel = new AdCpaannalModel();
        if($arrIsAd['dayIPMaxHits'] > 0 && $userIP != '218.108.191.87' && $userIP != '218.108.89.26') {
            $where = array(
                'cDate' => ['gt', strtotime(date('Y-m-d', time()))],
                'playBind' => 1,
                'adID' => $adID,
                'annalIP' => ip2long($userID)
            );
            $count = $AdCpaannalModel->count_by_search($where);
            if($count >= $arrIsAd['dayIPMaxHits'] && !in_array($userID, $this->adminIDsArr)) {
                return array('code' => 10015, 'msg' => '对不起，一个IP一天只能体验'.$arrIsAd['dayIPMaxHits'].'次');
            }
        }

        if($arrIsAd['IPMaxHits'] > 0 && $userIP != '218.108.191.87') {
            $where = array(
                'playBind' => 1,
                'adID' => $adID,
                'annalIP' => ip2long($userID)
            );
            $count = $AdCpaannalModel->count_by_search($where);
            if($count >= $arrIsAd['IPMaxHits'] && !in_array($userIP, $this->adminIDsArr)) {
                return array('code' => 10016, 'msg' => '此IP点击已到量，');
            }
        }

        return $flg;

    }














}