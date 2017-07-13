<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/23
 * Time: 10:39
 */

namespace Home\Logic;

class ChessCommonLogic {

    public $adminArr = '500002';
    public $redis;


    public function chess_jump($userID,$chessID,$realIP) {
        $lockLogic = new UserLogic($userID);
        if(!$lockLogic->check_user_chess_lock()) {
            $arrResult = array(
                'code' => 10001,
                'msg' => '抱歉，棋牌注册锁定!'
            );
            return $arrResult;
        }

        if(!$userID) {
            return array('code' => 20000, 'msg' => '未登录或登录超时，请重新登录!');
        }

        if(!$chessID < 0) {
            return array('code' => 10001, 'msg' => '棋牌广告不存在!');
        }

        $adminArr = $this->adminArr;
        $usersLogic = D('Member/Users', 'Logic');
        $sessionArr = $usersLogic->get_user_info($userID);

        $chessInfoArr = $this->get_chess_info($chessID);

        if(empty($chessInfoArr)) {
            return array('code' => 10001, 'msg' => '棋牌广告不存在!');
        }

        if($realIP != '218.108.89.26') {
            if($chessInfoArr['isFull'] == 0) {
                return array('code' => 10002, 'msg' => '棋牌广告已到量，请体验其他棋牌广告!');
            }elseif ($chessInfoArr['chessState'] == 1 && $chessInfoArr['isWait'] == 1) {
                $_Date = date('Y-m-d H:i:s', $chessInfoArr['uDate']);
                return array('code' => 10002, 'msg' => '棋牌广告将于'.$_Date.'开放注册，请过会再来');
            }elseif($chessInfoArr['chessState'] == 3 && !in_array($userID, $adminArr)) {
                return array('code' => 10002, 'msg' => '此棋牌广告还未上线，请体验其他棋牌广告!');
            }elseif ($chessInfoArr['chessState'] ==2) {
                return array('code' => 10002, 'msg' => '此棋牌广告暂停中，请体验其他广告!');
            }elseif ($chessInfoArr['chessState'] == 0 || $chessInfoArr['dDate'] <= time()) {
                return array('code' => 10002, 'msg' => '此棋牌广告下线，请体验其他棋牌广告!');
            }
        }

        $userInfoArr = $this->get_user_info_by_chessid($chessID, $userID);

        if($userInfoArr['playBind'] != 1) {
            $annalID = $userInfoArr['annalID'];
        } else {
            return array('code' => 10002, 'msg' => '对不起，您已成功注册!');
        }

        $this->add_chess_hits($chessID);

        if($chessInfoArr['dayMaxHits'] > 0) {
            if($chessInfoArr['todayHits'] >= $chessInfoArr['dayMaxHits']) {
                return array('code' => 10002, 'msg' => '对不起，棋牌广告今天已到量，请明天再体验!');
            }
        }

        if($chessInfoArr['dayMaxRegs'] > 0) {
            if($chessInfoArr['todayRegs'] >= $chessInfoArr['dayMaxRegs'] && $chessInfoArr['idFull'] == 1) {
                $arrData = array('mDate' => time(), 'isFull' => 0);
                M('ad_chess_hall')->where(array('chessID' > $chessID))->save($arrData);

                return array('code' => 10002, 'msg' => '对不起，棋牌广告今天已到量，请明天再体验!');
            }
        }

        if($chessInfoArr['userMaxRegs'] > 0) {
            if($chessInfoArr['totalRegs'] >= $chessInfoArr['userMaxRegs'] && $chessInfoArr['isFull'] == 1) {
                $arrData = array('mDate' => time(), 'isFull' => 0);
                M('ad_chess_hall')->where(array('chessID' => $chessID))->save($arrData);

                return array('code' => 10002, 'msg' => '对不起，棋牌广告已到量，请明天再体验!');
            }
        }

        if($chessInfoArr['dayIPMaxHits'] > 0 && ($realIP == '218.108.89.26' || $realIP == '218.108.191.87')) {
            $today = strtotime(date('Y-m-d', time()));
            $where = array(
                'chessID' => $chessID,
                'playBind' => 1,
                'annalIP' => ip2long($realIP),
                'cDate' => array('gt', $today)
            );
            $count = M('ad_chess_hall_annal_'.get_table_id($chessID))->field('COUNT(annalID) as ct')->where($where)->find();
            if($count['ct'] >= $chessInfoArr['dayIPMaxHits'] && $userID != '500618') {
                return array('code' => 10002,' msg' =>'对不起，一个IP一天只能体验'.$chessInfoArr['dayIPMaxHits'].'此，请体验其他广告!');
            }
         }

         if(!$annalID) {
            $arrData = array(
                'cDate' => time(),
                'chessID' => $chessID,
                'userID' => $userID,
                'userAccount' => $sessionArr['userNick'],
                'userGroup' => $sessionArr['userGroup'],
                'gainG' => 0,
                'gainS' => 0,
                'annalIP' => ip2long($realIP),
                'ipAddr' => $this->getIPCity($realIP),
                'annalState' => 0
            );
            $userSign = get_table_id($chessID);
            $annalID = M('ad_chess_hall_annal_'.$userSign)->add($arrData);

            if(!$annalID) {
                return array('code' => 10002, 'msg' => '对不起，记录数据失败!!');
            }
         }

        $jumpUrl = str_replace('{recordID}', $annalID, html_entity_decode($chessInfoArr['chessLink']));
        $jumpUrl = str_replace('{tokenID}', $chessID, $jumpUrl);
        $jumpUrl = str_replace('{userID}', $userID, $jumpUrl);
        if(strstr($jumpUrl, 'threegames')) {
            $key = 'f8f0321958e6ebba';
            $sign = md5($key.$chessID.$userID.$annalID.$key);
            $jumpUrl .= $sign;
            $arrJ = explode('threegames/', $jumpUrl);
            header('referer:http://www.juxiangyou.com/jump.php?adID='.intval($arrJ[1]));
        } else if (strstr($jumpUrl,'{md5}')) {
            $arrURL = explode('{md5}', $jumpUrl);
            $jumpUrl = $arrURL[0].md5($arrURL[1]);
        }
        if(empty($jumpUrl)) {
            return array('code' => 10002, 'msg' => '对不起，链接地址失效!');
        }

        $chessImg = '//img.juxiangyou.com/upload/advert/chess'.$chessID.'/chessImg'.$chessInfoArr['chessImg'].'?'.$chessInfoArr['mDate'];

        $k = md5(CHESS_USER_GAME_INFO.$chessID.$userID);
        $this->redis->del($k);

        return array('code' => 10000, 'result' => array('chessID' => $chessInfoArr['chessID'], 'chessTitle' => $chessInfoArr)['chessTitle'], 'chessImg' => $chessImg, 'chessUrl' => $jumpUrl);
    }

    function getIPCity($ip) {
        $url = 'http://int.dool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.$ip;
        $strIPAddr = file_get_contents($url);
        $arrIPAddr = json_decode($strIPAddr, true);

        $ipStr = $arrIPAddr['country'].$arrIPAddr['province'].$arrIPAddr['city'];

        return $ipStr;
    }

    public function get_chess_rule_award_info($chessID = 0) {
        $infoData = $data = array();
        if(!$chessID) {
            return array('code' => '100002', 'msg' => '棋牌广告ID不能为空');
        }

        $k = md5(CHESS_RULE_AWARD_INFO.$chessID);

        $limitRedis = $this->redis->exits($k);
        $limitRedis = false;
        if(!$limitRedis) {
            $sign = get_table_id($chessID);

            $where = array(
                'chessID' => $chessID,
                'status' => 1
            );

            $order = 'sort ASC';

            $data = M('ad_chess_hall_rule_'.$sign)->where($where)->order($order)->select();

            if($data) {
                foreach ($data as $v) {
                    $infoData[$data['type']][] = $v;
                }
            }
            $this->redis->setex($k, 3600*7, serialize($infoData));
        } else {
            $infoData = unserialize($this->redis->get($k));
        }

        return $infoData;
    }


    public function get_table_id($value, $num = 10) {

        if(empty($value)) {
            return 0;
        }
        $_val = intval($num%10);
        return $_val;

    }


    public function get_chess_port_rule($data = array()) {

        $dataArr = $arr = array();
        if(!$data) {
            return false;
        }

        foreach ($dataArr as $k => $v) {
            foreach ($this->process_rule($v['ruleInfo']) as $i => $j) {
                $arr = explode('=', $j);
                $dataArr[$v['ruleName']][$i]['step'] = $i + 1;
                $dataArr[$v['ruleName']][$i]['level'] = $arr['0'];
                $dataArr[$v['ruleName']][$i]['awardG'] = $arr['1'];
                $dataArr[$v['ruleName']][$i]['awardS'] = $arr['2'];
                $dataArr[$v['ruleName']][$i]['desc'] = $arr['3'];
            }
        }
        return $dataArr;
    }

    public function get_chess_port_info($data = array()) {

        if(!$data) {
            return false;
        }
        foreach ($data as $v) {
            $rulePort = html_entity_decode($v['rulePort']);
            if($rulePort) {
                break;
            }
        }
        return $rulePort;

    }

    public function get_chess_info($chessID) {

        $data = array();

        if(!$chessID) {
            return array('code' => 10005, 'msg' => '棋牌广告不能为空');
        }

        $k = md5(CHESS_INFO.$chessID);
        $limitRedis = $this->redis->exits($k);
        if(!$limitRedis) {
            $data = M('ad_chess_hall')->where(array('chessID' => $chessID, 'chessState' => array('neq', '-')))->find();
            if($data) {
                $this->redis->setex($k, 3600 * 24, serialize($data));
            }

        } else {
            $data = unserialize($this->redis_get($k));
        }

        return $data;
    }

    public function get_chess_info_by_chessid($chessID = 0, $userID = 0, $fie = 0) {
        $data = array();
        if(!$chessID){
            return array('code' => 10003, 'msg' => '棋牌广告不能为空');
        }
        if(!$userID) {
            return array('code' => 2000);
        }

        $k = md5(USER_INFO.$chessID.$userID);
        $limitRedis = $this->redis->exists($k);
        if(!$limitRedis) {
            $sign = $this->get_table_id($chessID);

            $data = M('chess_hall_annal')->where(array('chessID' => $chessID, 'userID' => $userID))->find();
            if($data) {
                $this->redis->setex($k, 3600 * 24, serialize($data));
            }
        } else {
            $data = unserialize($this->redis->get($k));
        }

        if($fie && $data) {
            return $data[$fie];
        }
        return $data;
    }

    public function get_user_award_info_by_chessid($chessID = 0, $userID = 0, $awardType = '') {
        $data = array();

        if(!$chessID) {
            return array('code' => 10001, 'msg' => '棋牌广告不能为空');
        }
        if(!$userID) {
            return array('code' => 20000);
        }

        $k = md5(CHESS_USER_AWARD_INFO.$chessID.$userID.$awardType);
        $limitRedis = $this->redis->exists($k);

        if(!$limitRedis) {
            $sign = $this->get_table_id($chessID, 100);

            $data = M('chess_hall_award')->where(array('chessID' => $chessID, 'userID' => $userID))->find();

            if($data) {
                $this->redis->setex($k, 60, serialize($data));
            }
        } else {
            $data = unserialize($this->redis->get($k));
        }
        return $data;
    }


































}