<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/17
 * Time: 14:49
 */
namespace Common\Controller;

use Think\Controller;

class CommonController extends Controller {

    public $userID = 0;
    public $userIP = 0;
    public $redis;

    public function _initalize() {

        $this->time = time();
        $this->yesterday = strtotime('-1 day');
        $this->day = date('y_m-d', time());
        $this->today = mktime();

        $this->group = 0;
        $this->order = 0;
        $this->limit = 0;

        $config = C('REDIS');
        $this->redis = new RedisCom($config);

        $this->userID = intval(I('cookie.cookie_userid', 0));
        $this->userIP = I('cookie.cookie_userip', 0);
        $this->realIP = ip2long($this->userIP);


    }


}