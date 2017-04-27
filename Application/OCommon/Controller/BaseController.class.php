<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/2
 * Time: 13:41
 */
namespace OCommon\Controller;


use Org\Util\Rbac;
use Think\Auth;
use Think\Controller;

/**
 * 全集基础控制器
 */
class BaseController extends Controller {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }
    public function _initialize() {
        //添加不需要验证是否登录的链接，全部小写
        $not_need_login = array(
            'login/login/login',
            'login/login/check',
            'register/register/register',
            'register/register/check',
            'login/getpwdback/checkemail',
            'login/getpwdback/resetpassword',
            'login/getpwdback/editpwd',
        );
        //转小写以兼容url大小统一
        $action = strtolower(trim(__ACTION__, '/'));
        if(!in_array($action, $not_need_login)) {
            if(empty($_SESSION['employee_id'])) {
                $this->success("请先登录", U('/Login/Login/login'), 3);
                exit();
            }
        }

        $auth = new Auth();
        $rule_name = MODULE_NAME."/".CONTROLLER_NAME."/".ACTION_NAME;
        $result = $auth->check($rule_name, $_SESSION['employee_id']);
        if($rule_name == "Employee/ChangeAcc/changeAccount" || $rule_name == "Employee/FillEmployee/addEmployee" || $rule_name == "Employee/FillEmployee/addEmployeeMsg") {
            $result = true;
        }
        if(!$result) {
            $this->error("你没有权限");
        }
    }



    /**
     * 初始化操作
     */
//    public function _initialize() {
//        if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
//            $this->success("请先登录", '/OA/Login/Login/login', 0);
//        }
//
//        //判断是否是不用检测的模块和方法
//        $notAuth = in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE'))) || in_array(ACTION_NAME, C('NOT_AUTH_ACTION'));
//
//        //权限验证
//        if(C('USER_AUTH_ON')  && !$notAuth) {
//            $rbac = new Rbac();
//            $rbac::AccessDecision() || $this->error("你没有权限");
//        }
//    }






















    /**
     * 初始化操作
     */
//    public function _initialize() {
//        if(!IS_POST) {
//            $this->error("你访问的页面不存在,请稍候再试");
//        }
//    }
//
//    /**
//     * 用户列表
//     */
//    public function index() {
//        $Employee = M('Employee');
//        $this->assign('user', $Employee);
//        $this->display();
//    }
//
//    /**
//     * 添加用户
//     */
//    public function addUser() {
//        //如果设置了uid，则为编辑用户，否则为增加用户
//        $this->role = M('Role')->where('status = 1')->field('id, name')->select();
//
//        if(isset($_GET['uid'])) {
//            $this->userinfo = M('Employee')->where('employee_id = $_GET[uid]')->find();
//        }
//        $this->display();
//    }
//
//    /**
//     * 添加用户处理
//     */
//    public function addUserHandler() {
//        $Employee = M('Employee');
//        if($_POST['employee_id']) {
//            //如果存在ID，即表示更新
//            $data = array(
//                'employee_id' => I('post.employee_id', '', 'int'),
//                'emp_name' => I('emp_name', '', 'string'),
//                'status2' => I('status2', '', 'int'),
//            );
//
//            if ($_POST['password']) {
//                $data['password'] = I('password', '', 'md5');
//            }
//            if ($Employee->save($data)) {
//                $roleuser = M('role_user');
//                $roleuser->where('id = $data[id]')->delete();
//
//                $roleuser->add(array(
//                    'role_id' => I('role', '', 'intval'),
//                    'user_id' => $data['id'],
//                ));
//
//                $this->ajaxReturn(array(
//                    'statusCode' => 200,
//                    'message' => '更新成功',
//                ));
//            } else {
//                $this->ajaxReturn(array(
//                    'statusCode' => 300,
//                    'message' => '操作失败',
//                ));
//            }
//            return;
//        }
//
//        /**
//         * 添加表单处理
//         */
//        $data = array(
//            'emp_name' => I('emp_name', '', 'string'),
//            'password' => I('password', '', 'md5'),
//            'status2' => I('status2', '', 'int'),
//        );
//        if($uid = M('Employee')->add($data)) {
//            $roleuser = M('role_user');
//            $roleuser->where('id = $uid')->delete();
//            $roleuser->add(array(
//                'role_id' => I('role', '', 'intval'),
//                'user_id' => $uid,
//            ));
//
//            $this->ajaxReturn(array(
//                'statusCode' => 200,
//                'message' => '操作成功',
//                'navTabId' => '',
//                'rel' => '',
//                'callbackType' => '',
//                'forwardUrl' => '',
//                'confirmMsg' => ''
//            ));
//        } else {
//            $this->ajaxReturn(array(
//                'statusCode' => 300,
//                'message' => '操作失败',
//            ));
//        }
//    }
//
//    /**
//     * 启用或禁用用户
//     */
//    public function resume() {
//        $employee_id = I('get.employee_id', '0', 'int');
//        $Employee = M('Employee');
//        $status = $Employee->where('employee_id = $employee_id')->getField('status');
//        $status = ($status == 1) ? 0 : 1;
//
//        if($Employee->where('employee_id = $employee_id')->setField('status', $status)) {
//            $this->ajaxReturn(array(
//                'statusCode' => 1,
//                'message' => '操作成功',
//                'navTabId' => $_GET['navTabId'],
//            ));
//        } else {
//            $this->ajaxReturn(array(
//                'statusCode' => 0,
//                'message' => '操作失败',
//            ));
//        }
//
//    }
//
//    /**
//     * 删除用户
//     */
//    public function deleteUserHandler() {
//        $id = I('get.uid', 0 , 'int');
//        if(M('Employee')->delete($id)) {
//            $this->ajaxReturn(array(
//                'statusCode' => 1,
//                'message' => '删除成功',
//                'navTabId' => $_GET['navTabId'],
//            ));
//        } else {
//            $this->ajaxReturn(array(
//                'statusCode' => 0,
//                'message' => '删除成功',
//                'navTabId' => $_GET['navTabId'],
//            ));
//        }
//    }
//
//    /**
//     * 节点列表
//     */
//    public function node() {
//        $node = M('Node')->where(array('status' => 1))->order('sort')->select();
//        $this->node = node_merge($node);
//        $this->display();
//    }
//
//    /**
//     *添加及编辑节点弹层表单
//     */
//    public function addNode() {
//        //添加表单默认情况
//        $this->info = array(
//            'level' => I('get.level', 1, 'int'),
//            'pid' => I('get.pid', 0, 'int'),
//            'status' => 1,
//            'sort' => 50,
//        );
//        switch ($this->info['level']) {
//            case 1: {
//                $this->label = '应用';
//                break;
//            }
//            case 2: {
//                $this->label = '控制器';
//                break;
//            }
//            case 3: {
//                $this->label = '方法';
//                break;
//            }
//        }
//        if($_GET['id']) {
//            //编辑模式
//            $this->info = M('Node')->where(array('id' => $_GET['id']))->find();
//        }
//        $this->display();
//    }
//
//    /**
//     * 添加及编辑节点表单处理
//     */
//    public function addNodeHandler() {
//        $id = $_POST['id'];
//        $Employee = M('node');
//        if($id) {
//            //更新
//            if($Employee->save($_POST)) {
//                $this->ajaxReturn(array(
//                    'statusCode' => 200,
//                    'message' => '添加成功',
//                    'navTabId' => $_GET['navTabId'],
//                ));
//            } else {
//                $this->ajaxReturn(array(
//                    'statusCode' => 300,
//                    'message' => '更新失败',
//                    'navTabId' => $_GET['navTabId'],
//                ));
//            }
//        } else {
//            //保存
//            if($Employee->add($_POST)) {
//                $this->ajaxReturn(array(
//                    'statusCode' => 200,
//                    'message' => '添加成功',
//                    'navTabId' => $_GET['navTabId'],
//                ));
//            } else {
//                $this->ajaxReturn(array(
//                    'statusCode' => 300,
//                    'message' => '添加失败',
//                    'navTabId' => $_GET['navTabId'],
//                ));
//            }
//        }
//    }
//
//    /**
//     * 删除节点
//     */
//    public function deleteNodeHandler() {
//        $id = I('get.id', '0', 'int');
//        $Node = M('Node');
//        $data = $Node->where('pid = $id')->field('id')->find();
//        if($data) {
//            $this->ajaxReturn(array(
//                'statusCode' => 0,
//                'message' => '你请求的节点存在子节点，不可直接删除',
//            ));
//        } else {
//            if($Node->delete($id)) {
//                $this->ajaxReturn(array(
//                    'statusCode' => 1,
//                    'message' => '删除成功',
//                ));
//            } else {
//                $this->ajaxReturn(array(
//                    'statusCode' => 0,
//                    'message' => '节点删除失败',
//                ));
//            }
//        }
//    }
//
//    /**
//     * 角色管理
//     */
//    public function role() {
//        $this->role = M('Role')->select();
//        $this->display();
//    }
//
//    /**
//     * 添加及编辑角色
//     */
//    public function addRole() {
//        if($_GET['rid']) {
//            $id = I('get.rid', 0, 'int');
//            $this->role = M('Role')->find($id);
//        }
//        $this->display();
//    }
//
//    /**
//     * 添加角色表单处理
//     */
//    public function addRoleHandler() {
//        $Role = M('Role');
//        if($_POST['id']) {
//            //更新
//            if($Role->save($_POST)) {
//                $this->ajaxReturn(array(
//                    'statusCode' => 200,
//                    'message' => '角色信息更新成功',
//                ));
//            } else {
//                $this->ajaxReturn(array(
//                    'ststuaCode' => 300,
//                    'message' => '角色信息更新失败',
//                ));
//            }
//        } else {
//            if($Role->add($_POST)) {
//                $this->ajaxReturn(array(
//                    'sttausCode' => 200,
//                    'message' => '角色添加成功',
//                ));
//            } else {
//                $this->ajaxReturn(array(
//                    'statusCode' => 300,
//                    'message' => '角色添加失败',
//                ));
//            }
//        }
//    }
//
//    /**
//     * 删除角色
//     */
//    public function deleteRole() {
//
//    }
//
//    /**
//     *快速启用或禁用用户
//     */
//    public function resumeRole() {
//        $id = I('get.rid', 0, 'int');
//        $Role = M('Role');
//        $status = $Role->where('id = $id')->getField('status');
//        $status = ($status == 1) ? 0 : 1;
//        if($Role->where('id = $id')->setField('status', $status)) {
//            $this->ajaxReturn(array(
//                'statusCode' => 1,
//                'message' => '操作成功',
//                'navTabId' => $_GET['navTabId'],
//            ));
//        } else {
//            $this->ajaxReturn(array(
//                'statusCode' => 0,
//                'message' => '操作失败',
//            ));
//        }
//    }
//
//    /**
//     * 给用户添加节点权限
//     */
//    public function access() {
//        $rid = I('rid', 0, 'intval');
//        $Node = M('Node')->where(array('status' => 1))->field(array('id', 'title', 'pid', 'name', 'level'))->order('sort')->select();
//
//        //获取原有权限
//        $access = M('Access')->where('role_id = $rid')->getField('node_id', true);
//        $this->node = node_merge($Node, $access);
//        $this->assign('rid', $rid)->display();
//    }
//
//    /**
//     * 添加节点权限表单处理
//     */
//    public function accessHandler() {
//        $rid = I('rid', '', 'intval');
//        $Access = M('Access');
//
//        //清空原有权限
//        $Access->where('role_id = $rid')->delete();
//
//        //插入新的权限
//        $data = array();
//
//        foreach($_POST['access'] as $v) {
//            $tmp = explode('_',$v);
//            $data[] = array(
//                'role_id' => $rid,
//                'node_id' => $tmp[0],
//                'level' => $tmp[1],
//            );
//        }
//        if($Access->addAll($data)) {
//            $this->ajaxReturn(array(
//                'statusCode' => 200,
//                'message' => '权限更新成功',
//            ));
//        } else {
//            $this->ajaxReturn(array(
//                'statusCode' => 300,
//                'message' => '权限更新失败',
//            ));
//        }
//    }

}





























