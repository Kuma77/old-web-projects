<?php

class Captcha{
	var $string;
	var $width;
	var $height;
	
	function __construct($length,$width,$height){
		$string=implode("",$this->randomString($length));
		$this->string=$string;
		$this->width=$width;
		$this->height=$height;
	}
	
	function randomColor(){
		return rand(0,255);
	}

	function randomString($length){
		$chars= array();
		
		$counter=0;
		while ($counter < $length){
			$chars[$counter]=chr(rand(65,90)+37*rand(0,1));
			$counter++;
		}
		
		return $chars;
	}
	
	function complexify($complexity, $image){
			$counter=0;		

			if ($complexity[3]==1){
				$emboss = array(array(0.0, 1.0, 0.0), array(1.0, -4.0, 1.0), array(0.0, 1.0, 0.0));  
				imageconvolution($image, $emboss, 1, 127); 

			}
			
			if ($complexity[4]==1){
				$gaussian = array(array(1.0, 1.0, 1.0), array(1.0, 1.0, 1.0), array(1.0, 1.0, 1.0));  
				imageconvolution($image, $gaussian, 10, 0);  
			}
			
			if ($complexity[0]==1){
				$top=rand(0,8);
				while ($counter<$top){
					ImageLine($image,rand(0,$this->width),rand(0,$this->height),rand(0,$this->width),rand(0,$this->height),ImageColorAllocate($image,$this->randomColor(),$this->randomColor(),$this->randomColor()));
					$counter++;
				}
			}

			if ($complexity[1]==1){
				$top=rand(0,($this->width*$this->height)/10);
				while ($counter<$top){
				ImageSetPixel($image,rand(0,$this->width),rand(0,$this->height),ImageColorAllocate($image,$this->randomColor(),$this->randomColor(),$this->randomColor()));
				$counter++;
				}
			}
			
			if ($complexity[2]==1){
				$top=rand(0,4);

				while ($counter<$top){
					$points=array(rand(0,8));
					foreach($points as $dot){
						$dot=array(rand(0,$this->width),rand(0,$this->height));
					}
					ImagePolygon($image,$points,count($points)/2,ImageColorAllocate($image,$this->randomColor(),$this->randomColor(),$this->randomColor()));
					$counter++;
				}
			}
		
		return $image;
	}

	function disp($complexity){ //displays a picture containing a captcha of length 'length' and complexity 'complexity' and returns the captcha's contents.

		$image=ImageCreate($this->width,$this->height);
		$black= ImageColorAllocate($image,0,0,0);

		putenv('GDFONTPATH=' . realpath('.'));
		ImageFilledRectangle($image,0,0,200,60,$black);

		$counter=0;
		while ($counter < strlen($this->string)){
			ImageTTFText($image,20,rand(-60,60),($this->width/strlen($this->string))*$counter+20,$this->height/2,ImageColorAllocate($image,$this->randomColor(),$this->randomColor(),$this->randomColor()),'arial.ttf',$this->string[$counter]);
			$counter++;
		}
		
		$image=$this->complexify($complexity, $image);
	
		header('Content-Type: image/png');
		ImagePNG($image);
		
	}
}

?>