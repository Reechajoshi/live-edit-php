<?php
if($TPL->pageType == "edit"){	
	$id = sprintf("%d",$_GET["id"]);	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='1' AND ".$MXPGINFO["PK"]."='$id'");
} else {
	$D = $_POST;	
}
$arrFrom = array(
array("type"=>"text", "name"=>"vipMemberTitle", "value"=>$D["vipMemberTitle"], "title"=>"Title", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"editor", "name"=>"vipMemberDesc", "value"=>$D["vipMemberDesc"], "title"=>"Description", "validate"=>"", "prop"=>'  style="height:400px;"'),
array("type"=>"editor", "name"=>"freePack", "value"=>$D["freePack"], "title"=>"Free Pack Description", "validate"=>"", "prop"=>'  style="height:400px;"'),
array("type"=>"text", "name"=>"vipMemberAmt", "value"=>$D["vipMemberAmt"], "title"=>"Amount", "validate"=>"required", "prop"=>' class="text"'));
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
<?php echo getPrettyJs(); ?> 