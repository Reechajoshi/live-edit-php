<?php
if($TPL->pageType == "edit"){	
	$id = sprintf("%d",$_GET["id"]);	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='1' AND ".$MXPGINFO["PK"]."='$id'");
} else {
	$D = $_POST;	
}

$arrFrom = array(
array("type"=>"text", "name"=>"HTPGameTitle", "value"=>$D["HTPGameTitle"], "title"=>"Game Title", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"editor", "name"=>"HTPDesc", "value"=>$D["HTPDesc"], "title"=>"Description", "validate"=>"", "prop"=>'  style="height:400px;"'),
array("type"=>"text", "name"=>"HTPVideoUrl", "value"=>$D["HTPVideoUrl"], "title"=>"Video URL", "validate"=>"required", "prop"=>' class="text"'),
/* array("type"=>"text", "name"=>"HTPLink", "value"=>$D["HTPLink"], "title"=>"Link", "validate"=>"required", "prop"=>' class="text"') */
);
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
    <div id="wrap-sub-form"> </div>
  </div>
</form>