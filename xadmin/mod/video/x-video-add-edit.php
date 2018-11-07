<?php
$vPass = "isPassword"; 
$vCPass = "isPassword,isEqual:userPass";

if($TPL->pageType == "edit"){	
	$id = sprintf("%d",$_GET["id"]);	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='1' AND ".$MXPGINFO["PK"]."='$id'");
	$vPass = ""; 
	$vCPass = "";
} else {
	$D = $_POST;	
}
$arrFrom = array(
array("type"=>"text", "name"=>"videoTitle", "value"=>$D["videoTitle"], "title"=>"Video Title", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"editor", "name"=>"synopsis", "value"=>$D["synopsis"], "title"=>"synopsis", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"videoLink", "value"=>$D["videoLink"], "title"=>"videoLink", "validate"=>"required,url", "prop"=>' class="text"'));

$arrFromS = array(
array("type"=>"text","title"=>"Image Dimensions" , "value"=>"Height: 208px Width: 390px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"videoImage", "value"=>$D["videoImage"], "title"=>"Image", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["videoImage"],$MXPGINFO["TBL"],$D["videoTitle"],250,180,"98%","auto")));

?>


<form name="frmAddEdit" id="frmAddEdit" action="" method="post" enctype="multipart/form-data">
  <?php echo getPageNav(); ?>
  <div id="wrap-data">
    <div id="wrap-form">
      <table width="100%" border="0" cellpadding="7" cellspacing="0">
        <?php		 
		$MXFRM = new mxForm();			
		echo $MXFRM->getForm($arrFrom,false);				
		?>
      </table>
    </div>
    <div id="wrap-sub-form">
      <table width="100%" border="0" cellpadding="7" cellspacing="0">
        <?php 
			$MXFRM->formType = "sub";					
			echo $MXFRM->getForm($arrFromS); ?>
      </table>
    </div>
  </div>
</form>
<?php echo getPrettyJs();?> 