<?php
if($TPL->pageType == "edit"){	
	$id = $_GET["id"];	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE ".$MXPGINFO["PK"]."='$id'");
} else {
	$D = $_POST;	
}

$arrFrom = false;
if( $id && $id == 'CONTACT_US' || $id == 'ON_FEEDBACK' )
{
	$arrFrom = array(
	array("type"=>"text", "name"=>"ename", "value"=>$D["ename"], "title"=>"Email", "validate"=>"required", "prop"=>' class="text"'),
	array("type"=>"text", "name"=>"esubject", "value"=>$D["esubject"], "title"=>"Subject", "validate"=>"required", "prop"=>' class="text"'),
	array("type"=>"text", "name"=>"efromname", "value"=>$D["efromname"], "title"=>"To Name", "validate"=>"required", "prop"=>' class="text"'),
	array("type"=>"text", "name"=>"efromid", "value"=>$D["efromid"], "title"=>"To Id", "validate"=>"required", "prop"=>' class="text"'),
	array("type"=>"editor", "name"=>"ehtml", "value"=>$D["ehtml"], "title"=>"Content", "validate"=>"", "prop"=>'  style="height:400px;"'));
}
else
{
	$arrFrom = array(
	array("type"=>"text", "name"=>"ename", "value"=>$D["ename"], "title"=>"Email", "validate"=>"required", "prop"=>' class="text"'),
	array("type"=>"text", "name"=>"esubject", "value"=>$D["esubject"], "title"=>"Subject", "validate"=>"required", "prop"=>' class="text"'),
	array("type"=>"text", "name"=>"efromname", "value"=>$D["efromname"], "title"=>"From Name", "validate"=>"required", "prop"=>' class="text"'),
	array("type"=>"text", "name"=>"efrom", "value"=>$D["efromid"], "title"=>"From Id", "validate"=>"required", "prop"=>' class="text"'),
	array("type"=>"editor", "name"=>"ehtml", "value"=>$D["ehtml"], "title"=>"Content", "validate"=>"", "prop"=>'  style="height:400px;"'));
}	

$arrFromS = array();
?>

<form name="frmAddEdit" id="frmAddEdit" action="" method="post" enctype="multipart/form-data">
  <?php echo getPageNav(); ?>
  <div id="wrap-data">
    <div id="wrap-form">
      <table width="100%" border="0" cellpadding="7" cellspacing="0">
        <?php		 
		$MXFRM = new mxForm();			
		echo $MXFRM->getForm($arrFrom,true);
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
<?php echo getPrettyJs(); ?> 