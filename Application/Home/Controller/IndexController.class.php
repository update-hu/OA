<?php
namespace Home\Controller;
use Think\Cache\Driver\Redis;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }

    public function test() {



        $tt = md5('1194613966969951332a941e97aa737dd8e');
        $t = md5('119611396723287687508a8e8d0705d191cbc');


        var_dump($t);




    }







}
