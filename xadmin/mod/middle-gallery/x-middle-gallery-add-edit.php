<?php
if($TPL->pageType == "edit"){	
	$id = sprintf("%d",$_GET["id"]);	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='1' AND ".$MXPGINFO["PK"]."='$id'");
	$vPass = ""; 
	$vCPass = "";
} else {
	$D = $_POST;	
}

$arrFrom = array(
array("type"=>"text", "name"=>"middleGalTitle", "value"=>$D["middleGalTitle"], "title"=>"Title", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"text","title"=>"Image Dimensions" , "value"=>"Height: 190px Width: 294px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"imageName", "value"=>$D["imageName"], "title"=>"Image", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["imageName"],$MXPGINFO["TBL"],$D["imageName"],202,402,"98%","auto")),
array("type"=>"text","title"=>"Image Dimensions" , "value"=>"Height: 40px Width: 294px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"iconImage", "value"=>$D["iconImage"], "title"=>"Icon Image", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["iconImage"],$MXPGINFO["TBL"],$D["iconImage"],202,402,"98%","auto")),
array("type"=>"editor", "name"=>"middleGalDescription", "value"=>$D["middleGalDescription"], "title"=>"Description", "validate"=>"required", "prop"=>' class="text"'),
/* array("type"=>"text", "name"=>"btnLink", "value"=>$D['btnLink'], "title"=>"Link", "validate"=>"required", "prop"=>' class="text"'), */
/* array("type"=>"text", "name"=>"btnName", "value"=>$D['btnName'], "title"=>"Button Name", "validate"=>"required", "prop"=>' class="text"') */);
?>
<form name="frmAddEdit" id="frmAddEdit" action="" method="post" enctype="multipart/form-data">
  <?php echo getPageNav(); ?>
  <div id="wrap-data">
    <div id="wrap-form">
      <table width="100%" border="0" cellpadding="7" cellspacing="0">
        <?php		 
		$MXFRM = new mxForm();			
		echo $MXFRM->getForm($arrFrom);				
		?>
      </table>
    </div>
    <div id="wrap-sub-form">
    </div>
  </div>
</form>
<?php echo getPrettyJs();?> 