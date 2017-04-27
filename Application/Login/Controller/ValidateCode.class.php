<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/6
 * Time: 10:36
 */
namespace Login\Controller;

/**
 * 生成验证码
 */
class  createValidateCode {
    private $charset = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789';//生成验证码的
    private $code;//验证码
    private $codelen = 4;//验证码长度
    private $width = 130;//宽度
    private $height = 50;//高度
    private $img;//背景图片
    private $font;//字体
    private $fontsize;//字体大小
    private $fontcolor;//字体颜色

    /**
     * 构造方法
     */
    public function __construct() {
        $this->font = dirname(__FILE__).'Public/font/elephant.ttf';//字体路径
    }

    /**
     * 生成随机验证码
     */
    public function createCode() {
        $len = strlen($this->charset) - 1;
        for($i = 0; $i < $this->codelen; $i++) {
            $this->code .= $this->charset[mt_rand(0,$len)];
        }
    }

    /**
     * 生成背景
     */
    public function createBg() {
        $this->img = imagecreatetruecolor($this->width,$this->height);
        $color = imagecolorallocate($this->img,mt_rand(157,255),mt_rand(157,255),mt_rand(157,255));
        imagefilledrectangle($this->img,0,$this->height,$this->width,0,$color);
    }

    /**
     * 生成文字
     */
    public function createFont() {
        $x = $this->width / $this->codelen;
        for($i = 0; $i < $this->codelen; $i++) {
            $this->fontcolor = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
            imagettftext($this->img,$this->fontsize,mt_rand(-30,30),$x * $i + mt_rand(1,5),$this->height / 1.4,$this->fontcolor,$this->font,$this->code[$i]);
        }
    }

    /**
     * 生成线条、雪花
     */
    public function createLine() {
        //线条
        for($i = 0; $i < 6; $i++) {
            $color = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
            imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$color);
        }

        //雪花
        for($i = 0; $i < 100; $i++) {
            $color = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
            imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand($this->height,'*',$color));
        }
    }

    /**
     * 输出
     */
    public function outPrint() {
        header('Content-type:image/png');
        imagepng($this->img);
        imagedestroy($this->img);
    }

    /**
     * 对外生成
     */
    public function doimg() {
        $this->createBg();
        $this->createCode();
        $this->createLine();
        $this->createFont();
        $this->outPrint();
    }

    /**
     * 获取验证码
     */
    public function getCode() {
        return strtolower($this->code);
    }


}


































