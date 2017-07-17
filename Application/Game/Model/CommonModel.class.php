<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/17
 * Time: 15:45
 */
namespace Game\Model;

use Think\Model;

class CommonModel extends Model {

    public function __construct()
    {
        $this->time = time();
        $this->day = date('Y-m-d', time());

        $this->group = 0;
        $this->order = 0;
        $this->limit = 0;

        $config = C('REDIS');
        $this->redis = new RedisCom($config);

        $this->userIP = I('cookie.cookie_userip', 0);
        $this->realIP = ip2long($this->userIP);

    }

}