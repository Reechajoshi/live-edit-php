<?php
require("../../connectdb.inc.php");
$error = "";
$filename = "";
$filesize = "";
$fileloc = "";
$fileElementName = 'userPhoto';	
$msg = "";
if(!empty($_FILES[$fileElementName]['error'])) {
	$msg .= "case1";
	switch($_FILES[$fileElementName]['error']){
		case '1':
			$error = 'You have exceeded the size limit!';
			break;
		case '2':
			$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
			break;
		case '3':
			$error = 'The uploaded file was only partially uploaded';
			break;
		case '4':
			$error = 'No file was uploaded.';
			break;
			
		case '6':
			$error = 'Missing a temporary folder';
			break;
		case '7':
			$error = 'Failed to write file to disk';
			break;
		case '8':
			$error = 'File upload stopped by extension';
			break;
		case '999':
		default:
			$error = 'No error code avaiable';
	}
}elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none'){
	$error = 'No file was uploaded..';
}else {
$msg .= "case3";
	define ("MAX_SIZE",(1024*2)); 

	function make_thumb($img_name,$filename,$new_w,$new_h) {
		$msg .= "case4";
		$ext = getExtension($img_name);
		if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
			$src_img=imagecreatefromjpeg($img_name);
		if(!strcmp("png",$ext))
			$src_img=imagecreatefrompng($img_name);
		if(!strcmp("png",$ext))
			$src_img=imagecreatefrompng($img_name);

		$old_x=imageSX($src_img);
		$old_y=imageSY($src_img);

        $ratio1=$old_x/$new_w;
        $ratio2=$old_y/$new_h;

        if($ratio1>$ratio2)	{
          $thumb_w=$new_w;
          $thumb_h=$old_y/$ratio1;
        }else{
          $thumb_h=$new_h;
          $thumb_w=$old_x/$ratio2;
        }

        $dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
        imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 

        if(!strcmp("png",$ext))
          imagepng($dst_img,$filename); 
        else
          imagejpeg($dst_img,$filename); 

        imagedestroy($dst_img); 
        imagedestroy($src_img); 
	}

	function getExtension($str) {
	$msg .= "case5";
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
       
	$image = $_FILES[$fileElementName]['name'];

 	if ($image) {
	$msg .= "case6";
 		$filename = stripslashes($_FILES[$fileElementName]['name']); 		
 	 	$extension = getExtension($filename);
 		$extension = strtolower($extension);
 		
		if (($extension != "jpg")  && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif") && ($extension != "bmp")) {
		$msg .= "case7";
 			$error .= 'Unknown extension!';
 			$errors = 1;
 		} else {
		$msg .= "case8";
 			$size = getimagesize($_FILES[$fileElementName]['tmp_name']);
 			$sizekb=filesize($_FILES[$fileElementName]['tmp_name']);

 			if ($sizekb > MAX_SIZE*1024) {
			$msg .= "case9";
 				$error .= 'You have exceeded the size limit!';
 				$errors=1;
 			} else {
			$msg .= "case10";
				$image_name = time().'.'.$extension;
				$newname = ABSPATH."/uploads/site_user/".$image_name;
				$copied  = copy($_FILES[$fileElementName]['tmp_name'], $newname);
				if (!$copied) {
				  $error .= 'Copy unsuccessfull!';
				  $errors=1;
				} 
			}
        }
 	} 			      

	$filename = $_FILES[$fileElementName]['name'];
	$filesize = round(($sizekb/1000), 0);
	$fileloc = SITEURL.'/uploads/site_user/'.$image_name;//$thumb_name;
	@unlink($_FILES[$fileElementName]);
}		

$_FILES;

$return_JSON = "";
$return_JSON .= "{";
$return_JSON .=	"error: '" . $error . "',\n";
$return_JSON .=	"name: '" . $image_name . "',\n";
$return_JSON .=	"size: '" . $filesize . "',\n";
$return_JSON .=	"loc: '" . $fileloc . "'\n";
$return_JSON .= "}";
echo $return_JSON;
?>