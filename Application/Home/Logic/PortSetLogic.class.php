<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/5
 * Time: 10:45
 */
namespace Home\logic;


use Home\Model\CommonModel;

class PortSetLogic extends CommonModel {

    protected $arrReturn;
    protected $nameArr;
    protected $chessID;
    protected $userID;
    protected $ruleArr;
    protected $chessUserInfo;
    protected $chessCom;


    public function __construct()
    {
        parent::__construct();
        $this->chessCom = new ChessCommonLogic();
    }

    public function setArrReturn($arrReturn = array()) {
        $this->arrReturn = $arrReturn;
    }
    public function setNameArr($nameArr = array()) {
        $this->nameArr = $nameArr;
    }
    public function setChessID($chessID = 0) {
        $this->chessID = $chessID;
    }
    public function setUserID($userID = 0) {
        $this->userID = $userID;
    }
    public function setRuleArr($ruleArr = array()) {
        $this->ruleArr = $ruleArr;
    }
    public function setChessUserInfo($chessUserInfo = array()) {
        $this->chessUserInfo = $chessUserInfo;
    }

    public function port_610() {

        $chessUserUp = array();

        $arrReturn = $this->arrReturn;
        $nameArr = $this->nameArr;
        $chessID = $this->chessID;
        $userID = $this->userID;
        $ruleArr = $this->ruleArr;
        $chessUserInfo = $this->chessUserInfo;

        $arrReturn = $arrReturn['0'];

        if($arrReturn) {
            foreach ($nameArr as $v) {
                $arrReturn['UserLevel'] = 0;

                if($arrReturn['PlayTImeCount'] > 0 && $v == '试玩时间') {
                    $arrReturn['UserLevel'] = $arrReturn['PlayTImeCount'];
                }

                if($arrReturn['VIPLevel'] > 0 && $v == 'VIP等级') {
                    $arrReturn['UserLevel'] = $arrReturn['VIPLevel'];
                }


                if($arrReturn['ActivityScore'] > 0 && $v = '试玩山海经累计赢取') {
                    $arrReturn['UserLevel'] = $arrReturn['ActivityScore'];
                }

                if($arrReturn['ActivityScore2'] >0 && $v = '家家乐累计赢取') {
                    $arrReturn['UserLevel'] = $arrReturn['ActivityScore2'];
                }

                $playLevelArr = $this->get_user_award_info_by_chessid($chessID, $userID, $v);
                $playLevel = $playLevelArr['0']['playLevel'];

                $bArr['awardItem'] = $v;
                if($arrReturn['UserLevel']) {
                    $bArr['awardCount'] = $arrReturn['UserLevel'];
                } else {
                    if($playLevel) {
                        $bArr['awardCount'] = $playLevel;
                    } else {
                        $bArr['awardCount'] = '--';
                    }
                }
                $jArr[] = $bArr;

                //更新用户基本信息
                if(!$chessUserUp['idName']) {
                    $chessUserUp['idName'] = strip_tags(trim($arrReturn['UserName']));
                }

                //基于棋牌的用户领奖信息
                $chessUserAwardInfo = $this->get_user_award_info_by_chessid($chessID, $userID, $v);

                if(!$chessUserAwardInfo) {
                    if($chessUserAwardInfo['playLevel'] <= $arrReturn['UserLevel']) {
                        $fieldUpdate = array(
                            'mDate' => time(),
                            'playLevel' => $arrReturn['UserLevel']
                        );

                        //可领取步骤
                        foreach ($ruleArr[$v] as $m => $n) {
                            if($arrReturn['UserLevel'] >= $n['level']) {
                                $fieldUpdate['playLevel'] = $m + 1;
                            } else {
                                break;
                            }
                        }
                    }
                }
            }
        }


















    }




























}