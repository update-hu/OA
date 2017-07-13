<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/5
 * Time: 11:14
 */
namespace Home\Model;

class CommonModel extends Model {

    public function __construct()
    {
        $this->time = time();
        $this->day = date('Y-m-d', time());
        $this->tom = strtotime(date('Y-m-d', strtotime('+1 day')));
        $this->today = mktime(0,0,0,date('m',time()),date('d',time()),date('Y',time()));
        $this->month = mktime(0,0,0,date('m',time()),'01',date('Y',time()));

        $this->group = 0;
        $this->order = 0;
        $this->limit = 0;

        $config = C('REDIS');
        $this->redis = new RedisCom($config);

        $this->userIP = I('cookie.cookie_userip', 0);
        $this->realIP = ip2long($this->userIP);
    }

}