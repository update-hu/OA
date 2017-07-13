<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/27
 * Time: 15:40
 */
namespace Home\Controller;

use Think\Controller;
use Home\Logic\ChessDetailsLogic;

class ApiChessDetailsController extends Controller {

    public function refresh_chess($args = array()) {

        $userID = $this->userID ?: $args['userID'];
        $args['userID'] = $userID;
        $chesslogic = new ChessDetailsLogic();
        return $chesslogic->con_update($args);

    }

    public function award($args = array()) {
        $args['userID'] = $this->userID ?: $args['userID'];
        $chessLogic = new ChessDetailsLogic();
        return $chessLogic->con_set_award($args);
    }


}