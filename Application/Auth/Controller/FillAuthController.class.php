<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/22
 * Time: 15:03
 */
namespace Auth\Controller;

use Auth\Logic\FillAuthLogic;
use OCommon\Controller\BaseController;

/**
 * 新增权限Controller
 */
class FillAuthController extends BaseController {
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 新增权限
     */
    public function addAuth() {
        $name = I('post.name');
        $title = I('post.title');
        if($name == '') {
            $this->display();
            exit();
        }
        $data = [
            'title' => $title,
            'name' => $name,
        ];
        $FillAuthLogic = new FillAuthLogic();
        $res = $FillAuthLogic->addAuth($data);
        if($res) {
            $this->success('权限添加成功', U('Auth/AuthList/showAuthList'), 3);
        } else {
            $this->error("权限添加失败");
        }
    }









}
















