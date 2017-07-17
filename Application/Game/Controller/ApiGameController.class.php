<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/17
 * Time: 14:46
 */
namespace Game\Controller;


use Common\Controller\CommonController;
use Game\Logic\AdCpaCommonLogic;

class ApiGameController extends CommonController {

    public function game_info($args) {

        $userID = $this->userID ?: $args['userID'];
        $userIP = $this->userIP ?: $args['userIP'];
        $game_id = $args['adID'];

        $code = $args['code'] ?: '';

        $AdCpaCommonLogic = new AdCpaCommonLogic();

        $result = $AdCpaCommonLogic->game_jump($userID, $userIP, $game_id, $code);

        if($result['code'] == 10000) {
            return array('code' => 10000, 'result' => $result['result']);
        } elseif($result['code'] > 10000) {
            return $result;
        }


    }



}