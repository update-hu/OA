<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 10:53
 */
namespace Train\Logic;

use OCommon\Logic\BaseLogic;
use Train\Model\TrainModel;

/**
 * 培训列表Logic
 */
class TrainListLogic extends BaseLogic {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 显示单个员工培训列表
     */
    public function showOneTrainList($employee_id) {
        $TrainModel = new TrainModel();
        $where = [
            'employee_id' => $employee_id,
        ];
        $count = $TrainModel->where($where)->count();
        $p =getPage($count, 5);
        $show = $p->show();
        $list = $TrainModel->where($where)->limit($p->firstRow.','.$p->listRows)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;
    }

    /**
     *显示培训列表
     */
    public function showTrainList() {
        $TrainModel = new TrainModel();
        $count = $TrainModel->count();
        $p = getPage($count, 5);
        $show = $p->show();
        $list = $TrainModel->join('employee on train.employee_id = employee.employee_id')->limit($p->firstRow.','.$p->listRows)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];

        return $array;
    }



    /**
     * 查看申请详情
     */
    public function showTrain($train_id) {
        $TrainModel = new TrainModel();
        $where = [
            'train_id' => $train_id,
        ];
        $res = $TrainModel->findByWhere($where, '');
        if($res) {
            return $res;
        } else {
            return false;
        }
    }

    /**
     * 显示修改信息界面
     */
    public function showEditTrain($train_id) {
        $TrainModel = new TrainModel();
        $where = [
            'train_id' => $train_id,
        ];
        $res = $TrainModel->findByWhere($where, '');
        if($res) {
            return $res;
        } else {
            return false;
        }
    }

    /**
     * 修改申请
     */
    public function editTrain($train_id, $data) {
        $TrainModel = new TrainModel();
        $where = [
            'train_id' => $train_id,
        ];
        $res = $TrainModel->updateByWhere($where, $data, '');
        if($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除申请
     */
    public function deleteTrain($train_id) {
        $TrainModel = new TrainModel();
        $where = [
            'train_id' => $train_id,
        ];
        $res = $TrainModel->deleteByWhere($where, '');
        if($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 培训审核
     */
    public function checkTrain($train_id, $data) {
        $TrainModel = new TrainModel();
        $where = [
            'train_id' => $train_id,
        ];
        $res = $TrainModel->updateByWhere($where, $data, '');
        return isset($res) ? true : false;
    }

    /**
     * 查找培训
     */
    public function findTrainByName($employee_id, $train_name) {
        $TrainModel = new TrainModel();
        $where = [
            'employee_id' => $employee_id,
            'train_name' => array('like', '%'.$train_name.'%'),
        ];
        $count = $TrainModel->where($where)->count();
        $p = getPage($count, 5);
        $show = urldecode($p->show());
        $list = $TrainModel->where($where)->limit($p->firstRow.','.$p->listRows)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;
    }

    /**
     * 查找培训
     */
    public function findTrainByNames($train_name) {
        $TrainModel = new TrainModel();
        $where = [
            'train_name' => array('like', '%'.$train_name.'%'),
        ];
        $count = $TrainModel->where($where)->count();
        $p = getPage($count, 5);
        $show = urldecode($p->show());
        $list = $TrainModel->join('employee on train.employee_id = employee.employee_id')->where($where)->limit($p->firstRow.','.$p->listRows)->select();
        $array = [
            'show' => $show,
            'list' => $list,
        ];
        return $array;
    }





}
























