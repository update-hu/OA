<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 10:56
 */
namespace Train\Logic;

use OCommon\Logic\BaseLogic;
use Train\Model\TrainModel;

/**
 * 添加申请培训Logic
 */
class FillTrainLogic extends BaseLogic {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     *添加申请
     */
    public function addTrain($data) {
        $TrainModel = new TrainModel();
        $res = $TrainModel->addData($data);
        if($res) {
            return true;
        } else {
            return false;
        }
    }

}



























