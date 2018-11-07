<?php
if($TPL->pageType == "edit"){	
	$id = sprintf("%d",$_GET["id"]);	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='1' AND ".$MXPGINFO["PK"]."='$id'");
} else {
	$D = $_POST;	
}
$arrFrom = array(
array("type"=>"text", "name"=>"pageTitle", "value"=>$D["pageTitle"], "title"=>"Page Title", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"editor", "name"=>"pageContent", "value"=>$D["pageContent"], "title"=>"Content", "validate"=>"", "prop"=>'  style="height:400px;"'));

if( $_GET[ 'id' ] == '2' )
{
	$arrFrom[] = array("type"=>"text", "name"=>"videoLink", "value"=>$D["videoLink"], "title"=>"Video", "validate"=>"", "prop"=>'  class="text"');
}

$arrFromS = array(
array("type"=>"editor", "name"=>"synopsis", "value"=>$D["synopsis"], "title"=>"Synopsis", "validate"=>"", "prop"=>' class="text" rows="8"'),
array("type"=>"text","title"=>"Image Dimensions" , "value"=>"Height: 0px Width: 0px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"pageImage", "value"=>$D["pageImage"], "title"=>"Image", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["pageImage"],$MXPGINFO["TBL"],$D["pageTitle"],250,180,"98%","auto")));

if($_SESSION["MXID"] == "SUPER")
	array_push($arrFromS,array("type"=>"text", "name"=>"templateFile", "value"=>$D["templateFile"], "title"=>"Template File", "validate"=>"", "prop"=>' class="text"'));
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
<?php echo getPrettyJs(); ?> 