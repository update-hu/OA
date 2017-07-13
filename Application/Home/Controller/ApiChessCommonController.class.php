<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/22
 * Time: 17:23
 */
namespace Home\Controller;

class ApiChessCommonController {

    public $userID;
    public $userIP;

    public function chess_jump($args=array()) {

        $userID = $args['userID'] ?: $this->userID;
        $chessID = $args['chessID'];
        $realIP = $this->userIP;

        $comLogic = new \Chess\Logic\ChessCommonLogic();
        $data = $comLogic->$this->chess_jump($userID,$chessID,$realIP);

        return $data;

    }

}