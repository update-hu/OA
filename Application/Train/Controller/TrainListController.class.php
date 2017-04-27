<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 10:43
 */
namespace Train\Controller;

use OCommon\Controller\BaseController;
use Train\Logic\TrainListLogic;

/**
 * 培训列表Controller
 */
class TrainListController extends BaseController {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 显示单个员工培训列表
     */
    public function showOneTrainList() {
        $name = I('get.train_name', '', 'strip_tags');
        $train_name = trim($name);
        $employee_id = I('session.employee_id', '', 'intval');
        $TrainListLogic = new TrainListLogic();

        if($train_name != '') {
            $res = $TrainListLogic->findTrainByName($employee_id, $train_name);
            $show = $res['show'];
            $list = $res['list'];
            $array = [
                'name' => $name,
            ];
            $this->assign('page', $show);
            $this->assign('list', $list);
            $this->assign('train', $array);
            $this->display();
            exit();
        }

        $res = $TrainListLogic->showOneTrainList($employee_id);
        $show = $res['show'];
        $list = $res['list'];
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->display();
    }

    /**
     *显示培训列表
     */
    public function showTrainList() {
        $name = I('get.train_name', '', 'strip_tags');
        $train_name = trim($name);
        $TrainListLogic = new TrainListLogic();
        if($train_name != '') {
            $res = $TrainListLogic->findTrainByNames($train_name);
            $show = $res['show'];
            $list = $res['list'];
            $array = [
                'name' => $name,
            ];
            $this->assign('page', $show);
            $this->assign('train', $array);
            $this->assign('list', $list);
            $this->display();
            exit();
        }
        $res = $TrainListLogic->showTrainList();
        $show = $res['show'];
        $list = $res['list'];
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->display();
    }

    /**
     * 查看申请详情
     */
    public function showTrain() {
        $TrainListLogic = new TrainListLogic();
        $train_id = I('get.train_id', '', 'intval');
        $res = $TrainListLogic->showTrain($train_id);
        if($res) {
            $this->assign('list',$res);
            $this->display();
        } else {
            $this->error('员工培训信息读取失败');
        }
    }

    /**
     * 删除申请
     */
    public function deleteTrain() {
        $TrainListLogic = new TrainListLogic();
        $train_id = I('get.train_id', '', 'intval');
        $res = $TrainListLogic->deleteTrain($train_id);
        if($res) {
            $this->success("申请删除成功",U('Train/TrainList/showOneTrainList'),3);
        } else {
            $this->error("申请删除失败");
        }
    }

    /**
     * 显示修改信息界面
     */
    public function showEditTrain() {
        $TrainListLogic = new TrainListLogic();
        $train_id = I('get.train_id', '', 'intval');
        $res = $TrainListLogic->showEditTrain($train_id);
        if($res) {
            $this->assign('train', $res);
            $this->display();
        } else {
            $this->error("读取数据失败");
        }
     }

    /**
     * 修改培训申请
     */
    public function editTrain() {
        $TrainListLogic = new TrainListLogic();

        $train_id = I('post.train_id', '', 'intval');
        $train_name = I('post.train_name', '','strip_tags');
        $content = I('post.content', '', 'htmlspecialchars');
        $purpose = I('post.purpose', '', 'strip_tags');
        $check = "未审核";
        $start_time = I('post.start_time', '', 'strip_tags');
        $end_time = I('post.end_time', '', 'strip_tags');
        $employee_id = I('session.employee_id', '', 'intval');
        $data = [
            'train_id' => $train_id,
            'train_name' => $train_name,
            'content' => $content,
            'purpose' => $purpose,
            'check' => $check,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'employee_id' => $employee_id,
        ];
        $res = $TrainListLogic->editTrain($train_id, $data);
        if($res) {
            $this->success('申请修改成功', U('Train/TrainList/showOneTrainList'), 3);
        } else {
            $this->error("申请修改失败");
        }
    }

    /**
     * 培训审核
     */
    public function checkTrain() {
        $check = I('post.check', '', 'strip_tags');
        $train_id = I('get.train_id', '', 'intval');
        $position = I('session.position', '', 'strip_tags');
        $TrainListLogic = new TrainListLogic();


        //从数据库查询审核信息
        $result = $TrainListLogic->showTrain($train_id);
        $log_check = $result['check'];

        if($position == "") {
            $this->error("需要部门经理和总经理才可以修改");
        }

        if ($log_check == "部门经理审核通过") {
            if ($position == '部门经理') {
                $this->error("部门经理已经审批完成");
            } else if ($position == '总经理') {
                $this->redirect('Train/TrainList/checkTrainManager', array('train_id' => $train_id), 1 ,'总经理进行审核');
            }
        } else if ($log_check == "审批完成") {
            $this->error("审批已经完成");
        } else {
            if ( $log_check == '未审核' && $position == '部门经理') {
                $this->redirect('Train/TrainList/checkTrainDeptManager', array('train_id' => $train_id), 1, '部门经理进行审核');
            } else if ($log_check == '未审核' && $position == '总经理') {
                $this->error("部门经理还未审核");
            } else if($log_check == '审核不通过') {
                $this->success("审核不通过，需要重新修改", U('Train/TrainList/showTrainList'), 3);
                exit();
            }
        }

        $data = [
            'check' => $check,
        ];
        $train_id = I('post.train_id', '', 'intval');
        $res = $TrainListLogic->checkTrain($train_id, $data);
        if($res) {
            $this->success("培训审批成功", U('Train/TrainList/showTrainList'), 3);
        } else {
            $this->error("培训审批失败");
        }

    }

    /**
     * 部门经理审核培训
     */
    public function checkTrainDeptManager () {
        $train_id = I('train_id', '', 'intval');
        $res = [
            'train_id' => $train_id,
        ];
        $this->assign('list', $res);
        $this->display();
    }

    /**
     * 总经理审核培训
     */
    public function checkTrainManager() {
        $train_id = I('train_id', '', 'intval');
        $res = [
            'train_id' => $train_id,
        ];
        $this->assign('list', $res);
        $this->display();
    }

}
































