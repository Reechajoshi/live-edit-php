<?php
$postCats = array();
if($TPL->pageType == "edit"){	
	$id = sprintf("%d",$_GET["id"]);	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='1' AND ".$MXPGINFO["PK"]."='$id'");	
	} else {
	$D = $_POST;
	$D["datePublish"] = date("Y-m-d H:i:s");	
}

$chkd = "";
if($D["featuredPost"]) $chkd = ' checked="checked"';

$arrFrom = array(
array("type"=>"text", "name"=>"postTitle", "value"=>$D["postTitle"], "title"=>"Post Title", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"textarea", "name"=>"synopsis", "value"=>$D["synopsis"], "title"=>"Synopsis", "validate"=>"", "prop"=>' class="text" rows="8"'),
array("type"=>"editor", "name"=>"postDesc", "value"=>$D["postDesc"], "title"=>"Decription", "validate"=>"", "prop"=>''),
array("type"=>"datetime", "name"=>"datePublish", "value"=>$D["datePublish"], "title"=>"Publish Date", "validate"=>"required,date", "prop"=>' class="calendar"'),
array("type"=>"checkbox", "name"=>"featuredPost", "value"=>"1", "title"=>"Featured post", "validate"=>"", "prop"=>' class="checkbox"'.$chkd));

$arrFromS = array(
array("type"=>"text","title"=>"Image Dimensions" , "value"=>"Height: 0px Width: 0px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"postThumb", "value"=>$D["postThumb"], "title"=>"Thumb Image", "validate"=>"image", "prop"=>' class="text"', "info"=>'<span class="info"> Dimention: 140 x 150</span>'),
array("type"=>"string", "value"=>getImage($D["postThumb"],$MXPGINFO["TBL"],$D["postTitle"],140,150,"98%","auto")),
array("type"=>"text","title"=>"Image Dimensions" , "value"=>"Height: 0px Width: 0px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"postImage", "value"=>$D["postImage"], "title"=>"Big Image ", "validate"=>"image", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["postImage"],$MXPGINFO["TBL"],$D["postTitle"],250,180,"98%","auto")),
array("type"=>"textarea", "name"=>"metaTitle", "value"=>$D["metaTitle"], "title"=>"Meta Title", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"textarea", "name"=>"metaDesc", "value"=>$D["metaDesc"], "title"=>"Meta Description", "validate"=>"", "prop"=>' class="text" rows="4"'),
array("type"=>"textarea", "name"=>"metaKeyword", "value"=>$D["metaKeyword"], "title"=>"Meta Keyword", "validate"=>"", "prop"=>' class="text" rows="4"'));
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
