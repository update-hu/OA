<?php
namespace Home\Controller;
use Think\Cache\Driver\Redis;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }

    public function test() {


        echo phpinfo();




    }








}
