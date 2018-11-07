<?php
if($TPL->pageType == "edit"){	
	$id = sprintf("%d",$_GET["id"]);	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='1' AND ".$MXPGINFO["PK"]."='$id'");
	$vPass = ""; 
	$vCPass = "";
} else {
	$D = $_POST;	
}

/* $arrFrom = array(
array("type"=>"text", "name"=>"gameTitle", "value"=>$D["gameTitle"], "title"=>"Game Title", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"textarea", "name"=>"synopsis", "value"=>$D["synopsis"], "title"=>"Synopsis", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"file", "name"=>"gameFile", "value"=>$D["gameFile"], "title"=>"Game File", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"file", "name"=>"xmlFile", "value"=>$D["xmlFile"], "title"=>"XML File", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"editor", "name"=>"gameDesc", "value"=>$D["gameDesc"], "title"=>"Game Description", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"file", "name"=>"gameTipImage", "value"=>$D["gameTipImage"], "title"=>"Game Tip Image", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["gameTipImage"],$MXPGINFO["TBL"],$D["gameTitle"],250,180,"98%","auto"))); */

$arrFrom = array(
array("type"=>"text", "name"=>"gameTitle", "value"=>$D["gameTitle"], "title"=>"Game Title", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"text","title"=>"Image Dimensions" , "value"=>"Height: 110px Width: 300px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"gameTitleImage", "value"=>$D["gameTitleImage"], "title"=>"Game Title Image", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["gameTitleImage"],$MXPGINFO["TBL"],$D["gameTitleImage"],250,180,"98%","auto")),
array("type"=>"editor", "name"=>"synopsis", "value"=>$D["synopsis"], "title"=>"Synopsis", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"file", "name"=>"gameFile", "value"=>$D["gameFile"], "title"=>"Game File", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"file", "name"=>"xmlFile", "value"=>$D["xmlFile"], "title"=>"XML File", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"editor", "name"=>"gameDesc", "value"=>$D["gameDesc"], "title"=>"Game Description", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"text","title"=>"Image Dimensions" , "value"=>"Height: 337px Width: 192px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"gameTipImage", "value"=>$D["gameTipImage"], "title"=>"Game Tip Image", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["gameTipImage"],$MXPGINFO["TBL"],$D["gameTitle"],250,180,"98%","auto")));

$arrFromS = array(
array("type"=>"text", "name"=>"gamePrice", "value"=>$D['gamePrice'], "title"=>"Game Price", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"discount", "value"=>$D['discount'], "title"=>"Discount %", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"text","title"=>"Image Dimensions" , "value"=>"Height: 390px Width: 574px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"imageName", "value"=>$D["imageName"], "title"=>"Image", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["imageName"],$MXPGINFO["TBL"],$D["gameTitle"],250,180,"98%","auto")),
array( "type"=>"text", "name"=>"video_url", "value"=> $D["video_url"], "title"=>"Video" ) );

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