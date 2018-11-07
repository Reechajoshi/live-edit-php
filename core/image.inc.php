<?php
define("HAR_AUTO_NAME",1);
class resizeImage {
	var $imgFile    = "";
	var $imgWidth   = 0;
	var $imgHeight  = 0;
	var $reqWidth   = 0;
	var $reqHeight  = 0;
	var $propWidth  = 0;
	var $propHeight = 0;	
	var $imgType    = "";
	var $mimeType   = "";
	var $fCallback  = "";
	var $imgError   = "";
	var $fileName   = "";
	var $folderPath = "";
	var $resizeType = "";
	var $quality    = 0;
	var $posX = 0;
	var $posY = 0;
									
	function resizeImage($width,$height,$file,$resizeType="ratio",$quality=100){ // Constructer
		if(!$resizeType) $resizeType = "ratio";
		if(!$quality) $quality = 100;
		$this->imgFile = $file;		
		$this->quality = $quality;
		$this->resizeType = $resizeType;
		
		$arrPath = explode("/", $file); 
		$this->fileName = end($arrPath);
		$this->folderPath = ABSPATH."/uploads/".str_replace($this->fileName,"",$this->imgFile);
		$this->thumbPath = $this->folderPath.'tmp/'.$width."_".$height."_".$this->resizeType."_".$this->fileName;
		
		if(!file_exists($this->thumbPath) || !is_file($this->thumbPath)){
			if(empty($this->imgFile)) {
				$this->imgError = "Error loading ".$this->imgFile;
				return false;
			} else {
				$arrImage = @getimagesize($this->folderPath.$this->fileName);
				
				$this->imgWidth  = $arrImage[0]; 
				$this->imgHeight = $arrImage[1];
				
				if($this->imgWidth <= 0 || $this->imgHeight <= 0) {
					$this->imgError = "Could not resize given image"; return false;				
				} else {			
					if($width <= 0)
						$this->reqWidth = $this->imgWidth;
					if($height <= 0)
						$this->reqHeight = $this->imgHeight;
					else
						$this->reqWidth  = $width;
						$this->reqHeight = $height;
																	
					$this->imgType   = $arrImage[2];
					$this->mimeType  = $arrImage[6];						
				}								
			}	
		}
	}
		
	function __getTheFunction(){
		switch($this->imgType){
			case 1: //jpeg gif					
				$this->fCallback["start"] = "imagecreatefromgif";
				$this->fCallback["end"] = "imagegif";
			break;
			
			case 2: //jpeg funciton					
				$this->fCallback["start"] = "imagecreatefromjpeg";
				$this->fCallback["end"] = "imagejpeg";
			break;
						
			case 3: //jpeg png					
				$this->fCallback["start"] = "imagecreatefrompng";
				$this->fCallback["end"] = "imagepng";
				$scaleQuality = round($this->quality/100)*9;
				$this->quality = 9 - $scaleQuality;
			break;
		} // end of the swicth condition
	} // end of the function
		
	function ratio(){ // Rsizes image ti fit inside given dimentions
			
		if($this->imgWidth >= $this->imgHeight) {
			$this->propWidth  = $this->reqWidth;
			$this->propHeight = ($this->imgHeight*$this->reqWidth)/$this->imgWidth;									
		} else {
			$this->propHeight = $this->reqHeight;
			$this->propWidth  = ($this->imgWidth*$this->reqHeight)/$this->imgHeight;
		}
		
		if($this->propWidth > $this->reqWidth) {
			$this->propWidth  = $this->reqWidth;
			$this->propHeight = ($this->imgHeight*$this->reqWidth)/$this->imgWidth;		
		} else if($this->propHeight > $this->reqHeight) {			
			$this->propHeight = $this->reqHeight;
			$this->propWidth  = ($this->imgWidth*$this->reqHeight)/$this->imgHeight;						
		}

		$this->reqHeight = $this->propHeight;	
		$this->reqWidth  = $this->propWidth;	
	}
	
	function crop() { // crops the image after resizing to the min possible size
		$perWidth  = ($this->reqWidth/$this->imgWidth)*100;
		$perHeight = ($this->reqHeight/$this->imgHeight)*100;
		
		if($perWidth > $perHeight) {
			$this->propHeight  = ($perWidth*$this->imgHeight)/100;
			$this->propWidth = $this->reqWidth;
		} else {
			$this->propWidth  = ($perHeight*$this->imgWidth)/100;
			$this->propHeight = $this->reqHeight;			
		}		
		$this->posX = ($this->reqWidth-$this->propWidth)/2;
		$this->posY = ($this->reqHeight-$this->propHeight)/2;		
		if($_GET["x"]>=0) $this->posX = intval($_GET["x"]);
		if($_GET["y"]>=0) $this->posY = intval($_GET["y"]);
	}
		
	function __resize() {		
		$resizeFunction = $this->resizeType;	
		$tmpPath = $this->folderPath."tmp/";

		if(file_exists($this->folderPath.$this->fileName) && is_file($this->folderPath.$this->fileName)) {
			if((!file_exists($this->thumbPath) || !is_file($this->thumbPath))){
				if(!file_exists($tmpPath)){ mkdir($tmpPath,0777);	}	

				$this->$resizeFunction();		
				$this->__getTheFunction();
				
				$tmpImg = $this->fCallback["start"]($this->folderPath.$this->fileName);		
				$newimg = @imagecreatetruecolor($this->reqWidth,$this->reqHeight);
				
				if($this->imgType == 1 || $this->imgType == 3) { // Code to keep transparency of image 		
					$colorcount = imagecolorstotal($tmpImg);
					if ($colorcount == 0) $colorcount = 256;
					imagetruecolortopalette($newimg,true,$colorcount);
					imagepalettecopy($newimg,$tmpImg);
					$transparentcolor = imagecolortransparent($tmpImg);
					imagefill($newimg,0,0,$transparentcolor);
					imagecolortransparent($newimg,$transparentcolor); 
				}
				
				@imagecopyresampled ($newimg, $tmpImg,$this->posX,$this->posY,0,0, $this->propWidth, $this->propHeight, $this->imgWidth,$this->imgHeight);
				@imagedestroy($tmpImg);	
					
				if($this->imgType == 1 ){
					$this->fCallback["end"]($newimg,$this->thumbPath);
				} else {
					$this->fCallback["end"]($newimg,$this->thumbPath,$this->quality);
				}			
				@imagedestroy($newimg);
			}
				
			@header("Content-type: ".$this->mimeType);
			$content = @file_get_contents ($this->thumbPath);
			if ($content != FALSE){
				echo $content;			
			}
		}
	}										
}
include("../config.inc.php");
$obj = new resizeImage($_GET["w"],$_GET["h"],$_GET["path"],$_GET["type"],$_GET["quality"]);
$obj->__resize();
//How to call
//http://localhost/cms2.0/core/image.inc.php?path=product/0012666001339326116.jpg&w=180&h=150&type=crop
?>