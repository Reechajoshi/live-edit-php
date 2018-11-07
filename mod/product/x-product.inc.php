<?php
if($TPL->uriArr[0]=="product") {
	$sql = "SELECT productTitle, seoUri, synopsis, productImg1 FROM ".$DB->pre."product WHERE productID =  '".$TPL->modID."' AND status = 1";
	$D = $DB->dbRow($sql);
	if($D){
		$FBMETA = '<meta property="og:title" content="'.$D['productTitle'].'" />
		<meta property="og:description" content="'.$D['synopsis'].'" />
		<meta property="og:url" content="'.SITEURL.'/product/'.$D['seoUri'].'/'.$TPL->modID.'/" />
		<meta property="og:image" content="'.SITEURL.'/uploads/product/'.$D['productImg1'].'" />
		<meta property="og:site_name" content="NU" />';
	}
}
?>