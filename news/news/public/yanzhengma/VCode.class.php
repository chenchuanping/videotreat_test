<?php
class VCode{
	private $width;
	private $height;
	private $num;
	public $img;
	private $word;//验证码的值
	
	function __construct($width,$height,$num){
		$this->width=$width;
		$this->height=$height;
		$this->num=$num;
		$this->word = $this->getWord();//获取验证码值
	}
	function getCode(){
		return $this->word;
	}
	function showImg(){
		$this->bgimage();	//背景画布
		$this->ganrao();	//干扰
		$this->printWord();	//打印出验证码
		$this->printImg();  //将字符串画到画布上
	}
	//背景画布
	private function bgimage(){
		$this->img=imagecreatetruecolor($this->width,$this->height);
		$bg_color=imagecolorallocate($this->img, rand(200,255), rand(200,255), rand(200,255));
		//填充画布
		imagefill($this->img, 0,0, $bg_color);
	}
	//干扰
	private function ganrao(){
		for($i=0;$i<10;$i++){
			$line_color=imagecolorallocate($this->img, rand(110,150), rand(110,150),rand(110,150));
			imageline($this->img, rand(1,($this->width)-1), rand(1,($this->height)-1), rand(1,($this->width)-1), rand(1,($this->height)-1), $line_color);
		}
		for($i=0;$i<=99;$i++){
			$pixel_color=imagecolorallocate($this->img, rand(110,150), rand(110,150),rand(110,150));
			imagesetpixel($this->img, rand(1,($this->width)-1), rand(1,($this->height)-1), $pixel_color);
		}
	}
	//获取验证码值
	private function getWord(){
		$code='';
		$codes = "3456789abcdefghijkmnopqrstuvwsyz";
		for($i=0;$i<$this->num;$i++){
			$start=rand(0,strlen($codes)-1);
			$code.=substr($codes, $start,1);
		}
		return $code;
	}
	//将字符串画到画布上
	private function printWord(){
		for($i=0;$i<$this->num;$i++){
			$color = imagecolorallocate($this->img,rand(0,100),rand(0,100),rand(0,100));
			$font = 5;
			$x = ($this->width/$this->num)*$i+5;
			$y = rand(5,10);
			$word = substr($this->word,$i,1);
			imagestring($this->img,$font,$x,$y,$word,$color);
		}
	}
	//显示图片
	private function printImg(){
		header("Content-type:image/jpeg");
		imagejpeg($this->img);
	}
}













