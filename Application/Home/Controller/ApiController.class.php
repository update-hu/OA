<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/23
 * Time: 15:09
 */
namespace Home\Controller;

class ApiController {


    public function registerPort() {

        $accArr = $arrAnnal = array();

        $accArr = I('get.');
        $chessID = trim(strip_tags($accArr['tokenID']));
        $annalID = trim(strip_tags($accArr['recordID']));
        $idCode = trim(strip_tags($accArr['accessCode']));
        $userName = trim(strip_tags($accArr['userName']));


        if($idCode == '') {
            $jArr = array('access_token' => 'ACCESS_FROBID', 'errcode' => '400002', 'errmsg' => 'accessCode is empty!');
            return $this->ajaxReturn($jArr, 'json');
        }
        if(!preg_match('/^-?[1-9]+[0-9]*$/', $annalID)) {
            $jArr = array('access_token' => 'ACCESS_FORBID', 'errcode' => '400002', 'errmsg' => 'recordID is error!');
            return $this->ajaxReturn($jArr, 'json');
        }
        if(!preg_match('/^-?[1-9]+[0-9]*$/', $chessID)) {
            $jArr = array('access_token' => 'ACCESS_FORBID', 'errcode' => '400002', 'errmsg' => 'tokenID is error!');
            return $this->ajaxReturn($jArr, 'json');
        }
        if($chessID) {
            $fie = 'chessID,chessKey,chessTitle';
            $arrAdInfo = M('ad_chess_hall')->field($fie)->where(array('chessID' => $chessID))->find();
        }

        //验证accessKey
        $doukey = strip_tags($_GET['accessKey']);
        if(md5($chessID.$annalID.$idCode.$arrAdInfo['accessKey']) != $doukey) {
            $jArr = array('access_token' => 'ACCESS_FORBID', 'errcode' => '400002', 'errmsg' => 'accessKey is error');
            return $this->ajaxReturn($jArr, 'json');
        }

        //获取用户数据
        $field = 'annalID,userID,playBind,idCode,chessID';
        $userSign = get_table_id($chessID);
        $arrAnnal = M('ad_chess_hall_annal_'.$userSign)->field($field)->where(array('chessID' => $chessID, 'annalID' => $annalID))->find();

        //验证改用户是否绑定
        if($arrAnnal['playBind'] != 1 && $arrAnnal ) {
            $jArr = array('access_token' => 'ACCESS_FORBID', 'errcode' => '400002', 'errmsg' => 'recordID is bind');
            return $this->ajaxReturn($jArr, 'json');
        }

        if(M('ad_chess_hall_annal_'.$userSign)->field($field)->where(array('chessID' => $chessID, 'idCode' => $idCode))->find()) {
            $jArr = array('access_token' => 'ACCESS_FORBID', 'errcode' => '400002', 'errmsg' => 'accessCode is bind');
            return $this->ajaxReturn($jArr, 'json');
        }

        if(!$arrAnnal) {
            $jArr = array('access_token' => 'ACCESS_FORBID', 'errcode' => '400002', 'errmsg' => 'It is failure!');
            return $this->ajaxReturn($jArr, 'json');
        }else {
            $upFie = array(
                'mDate' => time(),
                'bDate' => time(),
                'idCode' => $idCode,
                'playBind' => 1,
            );

            $where = array(
                'annalID' => $annalID
            );

            if(!M('ad_chess_hall_annal_'.$userSign)->where($where)->save($upFie)) {
                $jArr = array('access_token' => 'ACCESS_FORBID', 'errcode' => '400013', 'errmsg' => 'It is failure');
                return $this->ajaxReturn($jArr, 'json');
            }
        }

        //增加注册量
        $regUp = array(
            'todayRegs' => array('exp', 'todayRegs + 1'),
            'totalRegs' => array('exp', 'todayRegs + 1')
        );
        M('ad_chess_hall')->where(array('chessID' => $chessID))->save($regUp);

        $jArr = array('access_token' => 'ACCESS_TOKEN');
        return $this->ajaxReturn($jArr, 'json');


    }


}
