<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/10
 * Time: 16:58
 */
namespace Log\Controller;

use OCommon\Controller\BaseController;
use Log\Logic\FillLogLogic;

/**
 * 填写日志Controller
 */
class FillLogController extends BaseController {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 填写新日志
     */
    public function addLog() {
        $log_name = I('post.log_name', '', 'strip_tags');
        if($log_name == "") {
            $this->display();
            exit();
        }
        $content = I('post.content', '', 'htmlspecialchars');
        $create_time = date("Y-m-d", time());
        $employee_id = I('session.employee_id', '', 'intval');
        $data = [
            'log_name' => $log_name,
            'content' => $content,
            'check' => "未审核",
            'grade' => 'null',
            'create_time' => $create_time,
            'employee_id' => $employee_id,
        ];
//        var_dump($data);
//        exit();
        $FillLogLogic = new FillLogLogic();
        $res = $FillLogLogic->addLog($data);
        if($res) {
            $this->success("日志添加成功",U('Log/LogList/showOneLogList'),3);
        } else {
            $this->error("日志添加失败");
        }
    }
}






























