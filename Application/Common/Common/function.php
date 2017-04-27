<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/29
 * Time: 13:56
 */

/**
 * 验证码检查
 */
function check_verify($code, $id = "") {
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}


/**
 * 发送邮件
 */
function send_email($content, $address) {

    require "ThinkPHP/Library/Vendor/phpmailer/class.phpmailer.php";
    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->IsHTML(true);
    $mail->CharSet = "UTF-8";
    $mail->Host = "smtp.163.com";
    $mail->SMTPAuth = true;
    $mail->Username = "iamhuzp@163.com";
    $mail->Password = "123654alan";
    $mail->From = "iamhuzp@163.com";
    $mail->FromName = "OA系统";
    $mail->Subject = "密码找回邮件";
    $mail->Body = $content;
    $mail->AddAddress($address);

    if(!$mail->Send()) {
        return false;
    } else {
        return true;
    }
}

/**
 * 基础封装的页面代码
 */
function getPage($count, $pagesize = 10) {
    $p = new \Think\Page($count, $pagesize);
    $p->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
    $p->setConfig('prev', '上一页');
    $p->setConfig('next', '下一页');
    $p->setConfig('last', '末页');
    $p->setConfig('first', '首页');
    $p->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
    $p->lastSuffix = false;
    return $p;
}