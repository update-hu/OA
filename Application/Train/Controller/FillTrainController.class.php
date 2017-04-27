<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 10:48
 */
namespace Train\Controller;

use OCommon\Controller\BaseController;
use Train\Logic\FillTrainLogic;
use Train\Logic\TrainListLogic;

/**
 * 填写申请培训Controller
 */
class FillTrainController extends BaseController {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     *添加申请
     */
    public function addTrain() {
        $train_name = I('post.train_name', '', 'strip_tags');
        if($train_name == "") {
            $this->display();
            exit();
        }
        $employee_id = I('session.employee_id', '', 'intval');
        $content = I('post.content', '', 'htmlspecialchars');
        $purpose = I('post.purpose', '', 'strip_tags');
        $check = "未审核";
        $start_time = I('post.start_time', '', 'strip_tags');
        $end_time = I('post.end_time', '', 'strip_tags');
        $data = [
            'employee_id' => $employee_id,
            'train_name' => $train_name,
            'content' => $content,
            'purpose' => $purpose,
            'check' => $check,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ];

        $FillTrainLogic = new FillTrainLogic();
        $res = $FillTrainLogic->addTrain($data);
        if($res) {
            $this->success("培训申请添加成功",U('Train/TrainList/showOneTrainList'),3);
        } else {
            $this->error("培训申请添加失败");
        }
    }


}



























