<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/13
 * Time: 10:30
 */
namespace Home\Controller;


class DemoController extends Controller {

  protected $arrVipLevel = array(
    0 => 0,
    1 => 1000,
    2 => 5000,
    3 => 30000,
    4 => 60000,
    5 => 120000,
    6 => 240000
  );

  protected $account = array(
    'UserS',
    'UserG',
    'UserF',
    'UserC'
  );

  protected $mission = array(
      'all',
      'group',
      'task'
  );

  protected $user_accout_key = 'user_account_info';
  protected $get_user_vip_now = 'user_vip_now';
//  protected $today = date('Y-m-d', time());
  protected $user_info_key = 'user_info_key';

  public function get_user_info2($userID) {
    if(empty($userID)) {
      return false;
    }

    $arrUserVip = array();
    $usersLogic = D('Jxy://Member/Useers', 'Logic');

    $userS = $usersLogic->get_user_value($userID, 'userS');
    $myVipLevel = 0;
    $needUses = 0;
    foreach ($this-arrVipLevel as $k => $udian) {
      if($userS >= $udian) {
        $myVipLevel = $k;
      } else {
        $needUses = $udian - $userS;
      }
    }
    $arrUserVip['userID'] = $userID;
    $arrUserVip['myLevel'] = $myVipLevel;
    $arrUserVip['needUses'] = $needUses;

    $myVipRow = $this->is_open_vip($userID, true);
    if(empty($myVipRow)) {
      $arrUserVip['vipType'] = 0;
      $arrUserVip['svipType'] = 0;
    } else {
      $arrUserVip['ID'] = $myVipRow['ID'];
      $arrUserVip['cardID'] = $myVipRow['cardID'];
      $arrUserVip['vipType'] = $myVipRow['vipType'];
      $arrUserVip['svipType'] = $myVipRow['svipType'];
      $arrUserVip['beginDate'] = $myVipRow['beginDate'];
      $arrUserVip['endDate'] = $myVipRow['endDate'];
    }

    return $arrUserVip;

  }

  public function get_user_value($userID, $accountType = '') {
    if(empty($userID)) {
      return false;
    }
    if(!$accountType || !in_array($accountType, $this->account)) {
      return false;
    }

    $userAccount_key = $userID.$this->uer_account_key;
    $userAccount_value = $this->redis->exits($userAccount_key);
    if($userAccount_value) {

        $userAccountModel = D('Member\UserAccount');
        $userAccount = $userAccountModel->_select($userID);

        $usercDetailModel = D('Member\UsercDetail');
        $usercDetail = $usercDetailModel->_select($userID);

        $userAccount['cashUserC'] = $usercDetail['cashUserC'];
        $userAccount['freezeUserC'] = $userAccount['freezeUserC'];
        $userAccount['depositUserC'] = $userAccount['depositUserC'];

        $this->redis->setex($userAccount_key, 86400 * 24, serialize($userAccount));
    } else {
        $userAccount = unserialize($this->redis->get($userAccount_key));
    }

    return $accountType ? $userAccount[$accountType] : $userAccount;

    


  }

  public function is_open_vip($userID, $sign = false) {

      if(empty($userID)) {
          return false;
      }

      $time = time();
      $myVipRowKey = $userID.$this->get_user_vip_now;
      $myVipRow = unserialize($this->redis->get($myVipRowKey));
      if(empty($myVipRow) || ($myVipRow && ($myVipRow['endDate'] <= $time || $myVipRow['beginDate'] > $time)) || $sign == true) {
          $myVipRow = array();
          $vipUserModel = D('Jxy://Www/VipUser');

          $where = array(
              'userID' => $userID,
              'beginDate' => array(
                  'elt',
                  $time
              ),
              'endDate' => array(
                  'egt',
                  $time
              ),
              'svipType' => array(
                  'neq',
                  0
              ),
              'state' => 1
          );
          $order = array(
              'svipType' => 'DESC',
              'beginDate' => 'ASC'
          );
          $limit = 1;
          $svipRow = $vipUserModel->_select($where, $order, $limit);
          if(!$svipRow) {
              $where = array(
                  'userID' => $userID,
                  'beginDate' => array(
                      'elt',
                      $time
                  ),
                  'endDate' => array(
                      'egt',
                      $time
                  ),
                  'vipType' =>array(
                      'neq',
                      0
                  ),
                  'state' => 1
              );
              $order = array(
                  'ID' => 'DESC'
              );
              $limit = 1;
              $vipRow = $vipUserModel->_select($where, $order, $limit);

              if($vipRow) {
                  $myVipRow = $vipRow;

                  $where = array(
                      'userID' => $userID,
                      'state' => 1,
                      'vipType' => array(
                          'neq',
                          0
                      )
                  );
                  $order = array(
                      'endDate' => 'DESC'
                  );
                  $limit = 1;
                  $arrRow = $vipUserModel->_select($where, $order, $limit);
                  $myVipRow['cardEndDate'] = intval($arrRow['endDate']);
              }
          } else {
              $myVipRow = $svipRow;

              $where = array(
                  'userID' => $userID,
                  'state' => 1,
                  'svipType' => array(
                      'neq',
                      0
                  )
              );
              $order = array(
                  'endDate' => 'DESC'
              );
              $limit = 1;
              $arrRow = $vipUserModel->_select($where, $order, $limit);
              $myVipRow['cardEndDate'] = intval($arrRow['endDate']);

              $where = array(
                  'ID' => array('lt', $svipRow['ID']),
                  'userID' => $userID,
                  'svipType' => $svipRow['sviptype'],
                  'endDate' => array('between', array($this->today, $svipRow['beginDate']))
              );
              $order = array(
                  'endDate' => 'DESC'
              );
              $limit = 1;
              $arrRow = $vipUserModel->_select($where, $order, $limit);
              if($arrRow) {
                  $myVipRow['beginDate'] = intval($arrRow['beginDate']);
              }
          }
          if($myVipRow) {
              $leftTime = (($myVipRow['cardEndDate'] - $time) > 86400) ? 86400 : ($myVipRow['cardEndDate'] - $time);
          } else {
              $leftTime = 86400;
          }
          $this->redis->setex($myVipRowKey, $leftTime, serialize($myVipRow));
      }
      return $myVipRow;

  }

  public function get_user_info($userID, $value= '') {

      if(empty($usrID)) {
          return false;
      }

      $userInfo_key = $userID.$this->user_info_key;
      $userInfo = unserialize($this->redis->get($userInfo_key));

      if(!$userInfo || $userInfo['userState'] == 4) {
          $usersModel = D('Jxy://Member/Users');
          $userInfo = $usersModel->_select('userID', $userID);

          $this->redis->setex($userInfo_key, 86400 * 15, serialize($userInfo));
      }
      $newTaskV2Logic = D('Member/NewTaskV2', 'Logic');
      $userInfo['isNewBorn'] = $newTaskV2Logic->check_user_new_born($userID, $userInfo['cDate']);

      return ($value) ? $userInfo['value'] : $userInfo;

  }

  public function check_user_new_born($userID, $userCdate) {

      if($userCdate > (time() - 15 * 24 * 3600)) {
          if(!$this->check_task($userID, 'all')) {
              return 1;
          } else {
              return 0;
          }
      }
      return 0;
  }

  public function check_task($userID, $obj, $value = false) {
      $result = 0;
      if($userID && $obj) {
          if(!in_array($obj, $this->mission))
              return result;
          if($obj == 'task') {
              $result = $this->get_user_account($userID, $value);
          }
          if($obj == 'group') {
              $reuslt = $this->get_user_group($userID, $value);
          }
          if($obj = 'all') {
              $group = $this->get_task_group();
              $successCount = 0;
              foreach((array)$group as $g) {
                  $check  = $this->check_user_group($userID, $g['id']);
                  if($check == 3) {
                      $successCount++;
                  }
              }
              if(count($group) == $successCount) {
                  $result = 1;
              }
          }
      }
      return $result ? $result : 0;
  }

  public function get_task_user_count($userID, $taskID = false, $groupID = false) {
      $result = [];
      if($userID) {
          $where['status'] = 0;
          $where['userID'] = $userID;
          $taskID and $where['tID'] = $taskID;
          $groupID and $where['gID'] = $groupID;
          $result = $this->newTaskUserModel->_select('COUNT(*) as count', $where, 0, 0, 1);
      }
      return isset($result['count']) ? $result['count'] : 0;

  }

  public function check_user_group($userID, $groupID) {
      $result = 0;
      if($userID and $groupID) {
          $userGroupCount = $groupCount = 0;
          $userGroupStepSum = $groupStepSum = 0;

          $group = $this->get_task_group($groupID);
          if(!$group) {
              return $result;
          }
          $groupStepSum = $this->get_group_num($group['stepCount']);
          $groupCount = $group['stepCount'];
          $userTask = $this->get_user_task_list($userID, $groupID);

          if(!$userTask) {
              return $result;
          }
          foreach ((array) $userTask as $task) {
              $userGroupStepSum += $task['step'];
          }
          $userGroupCount = count($userTask);
          if($userGroupStepSum < $groupStepSum) {
              $result = 1;
              return $result;
          }
          if($this->get_group_receive($userID, $groupID)) {
              $result = 3;
              return $result;
          }
          if($userGroupCount == $groupCount and $userGroupStepSum ==$groupStepSum) {
              $result = 2;
              return $result;
          }
      }
      return $result;
  }

  public function get_task_group($groupID = false) {

      $where['status'] = 0;
      if($groupID) {
          $where['id'] = $groupID;
          return $this->newTaskGroupModel->_select([
              'id',
              'title',
              'reward',
              'rewardType',
              'stepCount'
          ], $where, [], [], 1);
      } else {
          return $this->newTaskGroupModel->_select([
              'id',
              'title',
              'reward',
              'rewardType',
              'stepCount'
          ], $where, [], [
              'sort' => 'ASC'
          ]);
      }

  }
























}
