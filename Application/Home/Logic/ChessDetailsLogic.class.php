<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/27
 * Time: 15:43
 */
namespace Home\Logic;
use Home\Logic\ChessCommonLogic;
use Home\Logic\UserLogic;

class ChessDetailsLogic extends ChessCommonLogic {

    public function con_update($args = array()) {

        $ruleArr = $nameArr = $jArr = $chessUserInfo = $chessUserUp = array();

        if(!$args['chessID']) {
            return array('code' => 10001, 'msg' => '广告ID不能为空');
        }

        $chessID = $args['chessID'];
        $userID = $args['userID'];

        if(!$userID) {
            return array('code' => 20000);
        }

        //获取棋牌方案
        $data = $this->get_chess_rule_award_info($chessID);
        if(!$data) {
            return array('code' => 10002, 'msg' => '棋牌活动还未开始!');
        }

        $ruleArr = $this->get_chess_port_rule($data['awardRule']);

        //查询接口
        $portInfo = $this->get_chess_port_info($data['awardRule']);

        //获取棋牌广告基本信息
        $chessInfoArr =$this->get_chess_info($chessID);

        if(!in_array($userID, $this->adminArr)) {
            if($chessUserInfo['isFull'] == 0 && time() >= $chessUserInfo['dDate']){
                return array('code' => 20003, 'msg' => '棋牌广告已到量，请体验其他棋牌');
            }elseif($chessUserInfo['chessState'] == 1 && $chessInfoArr['isWait'] == 1) {
                $udate = date('Y-m-d h:i:s', $chessInfoArr['uDate']);
                return array('code' => 10002, 'msg' => '棋牌广告将于'.$udate.'开启');
            }elseif($chessInfoArr['chessState'] == 3 && time() <= $chessInfoArr['uDate']) {
                return array('code' => 10003, 'msg' => '棋牌广告还未上线，请等待');
            }elseif($chessInfoArr['chessState'] == 2) {
                return array('code' => 20003, 'msg' => '广告已暂停，请体验其他广告');
            }elseif($chessInfoArr['chessState'] == 0 && time() >= $chessInfoArr['dDate']) {
                return array('code' => 100003, 'msg' => '此广告已下线，请体验其他广告');
            }
        }

        //给予棋牌的用户信息
        $chessUserInfo = $this->get_chess_info_by_chessid($chessID, $userID);

        if(!$chessUserInfo) {
            return array('code' => 10003, 'msg' => '请先注册并绑定用户信息');
        }

        $nameArr = array_column($data['awardRule'], 'ruleName');

        //试玩详情页信息更新
        $requestDataKeys = md5(CHESS_REDIS_DETAIL_UPDATE.$userID.$chessID);
        $limitRedis = $this->redis->exists($requestDataKeys);
        if(!$limitRedis) {
            $arrReturn = $this->process_access($portInfo, $chessUserInfo, 1);
            if($arrReturn) {
                $this->redis->setex($requestDataKeys, 60, serialize($arrReturn));
            }
        } else {
            $arrReturn = unserialize($this->redis->get($requestDataKeys));
        }


        $portLogic = new PortSetLogic();
        $portLogic->setChessID($chessID);
        $portLogic->setChessUserInfo($chessUserInfo);
        $portLogic->setNameArr($nameArr);
        $portLogic->setUserID($userID);
        $portLogic->setRuleArr($ruleArr);
        $portLogic->setArrReturn($arrReturn);

        if($chessInfoArr['chessBusiness'] == '610游戏') {
            $jArr = $portLogic->port_610();
        }




        $chessUserUp  = $jArr['chessUserUp'];
        unset($jArr['chessUserUp']);

        //异步数据
        $userAwardArr = $this->get_user_award_info_by_chessid($chessID, $userID);
        if($userAwardArr) {
            $userAwardArr = array();
            foreach ($userAwardArr as $j) {
                $userAwardInfo[$j['awardType']] = $j;
            }
        }
        $dataPageInfo = $this->get_user_award_status_for_asyn($ruleArr, $userAwardInfo);

        unset($chessInfoArr);
        unset($whereUpadte);
        unset($fieldUpdate);
        unset($arrReturn);
        unset($fieldUpdate);
        unset($nameArr);
        unset($ruleArr);
        unset($data);
        unset($portInfo);
        unset($userAwardInfo);
        unset($userAwardArr);

        //更新缓存
        $reKeys = md5(CHESS_USER_GAME_INFO.$chessID.$userID);
        $this->redis->del($reKeys);


        return array(
            'code' => 10000,
            'bindArrs' => $chessUserInfo['idCode'],
            'userAccount' => $chessUserUp['idAccount'] ?: '',
            'userName' => $chessUserUp['idName'] ?: '',
            'recordList' => $jArr,
            'awardInfo' => $dataPageInfo
        );

    }


    public function process_access($url, $arrValues, $type) {

        $type = intval($type);
        $url = str_replace('{recordID}', $arrValues['annalID'], html_entity_decode($url));
        $url = str_replace('{accessCode}', $arrValues['idCode'], $url);
        $url = str_replace('{tokenID}', $arrValues['chessID'], $url);

        $url = str_replace('{time}', $arrValues['time'], $url);
        $url = str_replace('{date}', date('Ymd'), $url);
        $url = str_replace('{Date}', date('Y-m-d'), $url);
        if(strstr('{md5}', $url)) {
            $arrURL = explode('{md5}', $url);
            $url = $arrURL[0].md5($arrURL[1]);
        }

        if($type < 1) {
            return $url;
        }
        trim($url);

        $contents = $this->get_access_content_data($url);
        $arrReturn = array();
        if($type == 2 || strstr(contents, '<?xml')) {
            preg_match_all("/<UserName>(.*)<\/UserName>/isU", $contents, $arrList, PREG_PATTERN_ORDER);
            $arrReturn['UserName'] = $arrList[1][0];
            preg_match_all("/<UserRole>(.*)<\/UserRole>/isU", $contents, $arrList, PREG_PATTERN_ORDER);
            $arrReturn['UserRole'] = $arrList[1][0];
            preg_match_all("/<UserRole>(.*)<\/UserRole>/isU", $contents, $arrList, PREG_PATTERN_ORDER);
            $arrReturn['UserLevel'] = $arrList[1][0];
            preg_match_all("/<UserRole>(.*)<\/UserRole>/isU", $contents, $arrList, PREG_PATTERN_ORDER);
            $arrReturn['Status'] = $arrList[1][0];
            preg_match_all("/<UserRole>(.*)<\/UserRole>/isU", $contents, $arrList, PREG_PATTERN_ORDER);
            $arrReturn['ServerName'] = $arrList[1][0];
            preg_match_all("/<UserRole>(.*)<\/UserRole>/isU", $contents, $arrList, PREG_PATTERN_ORDER);
            $arrReturn['UserServer'] = $arrList[1][0];
            preg_match_all("/<UserRole>(.*)<\/UserRole>/isU", $contents, $arrList, PREG_PATTERN_ORDER);
            $arrReturn['reCharge'] = $arrList[1][0];
            preg_match_all("/<UserRole>(.*)<\/UserRole>/isU", $contents, $arrList, PREG_PATTERN_ORDER);
            $arrReturn['Account'] = $arrList[1][0];
        } else {
            if(substr($contents, 0, 3) == pack('CCC', 0xef, 0xbb, 0xbf)) {
                $contents = substr($contents, 3);
            }
            $arrReturns = json_decode($contents, true);

            if(!$arrReturns) {
                $contents = file_get_contents($url);
                if(substr($contents, 0, 3) == pack('CCC', 0xef, 0xbb, 0xbf)) {
                    $contents = substr($contents, 3);
                }
                $arrReturns = json_decode($contents, true);
            }
            $arrReturn = $arrReturns;
            unset($arrReturns);
        }
        return $arrReturn;

    }


    public function get_access_content_data($url, $timeout=8, $connectTimeout=1, $fileType=0, $data='') {

        switch ($fileType) {
            case 1:
                $file_contents = file_get_contents($url);
                break;
            case 2:
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_USERAGENT, 'MISE 6.0');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,$connectTimeout);
                curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
                $file_contents = curl_exec($ch);
                curl_close($ch);
                break;
            case 0:
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_USERAGENT, 'MISE 6.0');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,  1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connectTimeout);
                curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
                $file_contents = curl_exec($ch);
                curl_close($ch);
        }
        return $file_contents;

    }

    public function get_rule_info_arr($data) {

        foreach ($data as $k => $v) {
            foreach ($v as $m => $n) {

                //规则方案
                foreach ($this->process_rule($n['ruleInfo']) as $j => $row) {
                    $arrRow = explode('=', $row);
                    $ruleInfoArr[$k][$n['ruleName']][$j]['step'] = $j + 1;
                    $arrRow['0'] ? $ruleInfoArr[$k][$n['ruleName']][$j]['level'] = $arrRow['0'] : NULL;
                    $arrRow['1'] ? $ruleInfoArr[$k][$n['ruleName']][$j]['award'] = $arrRow['1'] : NULL;
                    $arrRow['2'] ? $ruleInfoArr[$k][$n['ruleName']][$j]['awardS'] = $arrRow['2'] : NULL;
                    $arrRow['3'] ? $ruleInfoArr[$k][$n['ruleName']][$j]['detail'] = $arrRow['3'] : NULL;
                    $arrRow['4'] ? $ruleInfoArr[$k][$n['ruleName']][$j]['type'] = $arrRow['4'] : NULL;

                    //接口信息提取
                    $port = html_entity_decode($n['rulePort']);
                    if($port && !isset($ruleInfoArr[$k][$n['ruleName']]['port'])) {
                        $rowStr = end($ruleInfoArr[$k][$n['ruleName']][$j]);

                        if(strpos($rowStr, '至')) {
                            $rowArr = explode('至', $rowStr);

                            foreach ($rowArr as $o => $p) {
                                $port = str_replace('{'.$o.'}', $p, $port);
                            }
                            $ruleInfoArr[$k][$n['ruleName']][$j]['port'] = $port;
                        }
                    }
                }
            }
        }
        return $ruleInfoArr;



    }

    //领奖
    public function con_set_award($args = array()) {

        $step = '';
        $step = $args['step'] ?: '一键领奖';

        $userID = $args['userID'];
        if(!$userID) {
            return array('code' => 2000);
        }

        $lockLogic = new UserLogic();
        if($lockLogic->check_user_chess_lock($userID)) {
            return array(
                'code' => 3000,
                'msg' => '棋牌领奖锁定'
            );
        }

        $chessID = $args['chessID'];
        if(!$chessID) {
            return array('code' => 2000, 'msg' => '棋牌广告不能为空');
        }

        if(!$args['matchKey']) {
            return array('code' => 3000, 'msg' => '请指定领奖位置');
        }

        $awardName = html_entity_decode(trim($args['matchKey']));

        //领奖控制
        $key = md5(CHESS_REDIS_AWARD_CONTROL.$chessID);
        $control = $this->redis->exists($key);
        if($control) {
            return array('code' => 1001, 'msg' => '棋牌领奖维护中');
        }

        //并发控制
        $limitOnceKey = md5(LIMIT_ONCE_CHESS_.$awardName.$userID);
        if(!$this->redis->setnx($limitOnceKey, '1')) {
            return array('code' => 10001, 'msg' => '领取中');
        }
        $this->redis->setTimeOut($limitOnceKey, 2);

        //获取多领奖方案
        $data = $this->get_chess_rule_award_info($chessID);

        $ruleInfoArr = $this->get_rule_info_arr($data);

        if(!in_array($awardName, array_keys($ruleInfoArr['ruleName']))) {
            return array('code' => 10002, 'msg' => '请求领奖出错');
        }

        $awardPLan = $ruleInfoArr['awardRule'][$awardName];

        //获取用户数据











    }































}