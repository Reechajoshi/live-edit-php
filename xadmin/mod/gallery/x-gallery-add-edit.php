<?php
$gallCats = array();
if($TPL->pageType == "edit"){	
	$id = sprintf("%d",$_GET["id"]);	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='1' AND ".$MXPGINFO["PK"]."='$id'");
	$gallCats = getGalCatId($id);
} else {
	$D = $_POST;	
}

$arrFrom = array(
array("type"=>"text", "name"=>"galleryTitle", "value"=>$D["galleryTitle"], "title"=>"Gallery Title", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"editor", "name"=>"synopsis", "value"=>$D["synopsis"], "title"=>"Synopsis", "validate"=>"", "prop"=>' class="text" rows="5"'),
array("type"=>"editor", "name"=>"galleryDesc", "value"=>$D["galleryDesc"], "title"=>"Description", "validate"=>"required", "prop"=>' rows="18" cols="60"'),
array("type"=>"text", "name"=>"galleryLinkName", "value"=>$D["galleryLinkName"], "title"=>"Link Name", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"galleryLink", "value"=>$D["galleryLink"], "title"=>"Link", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"text","title"=>"Image Dimensions" , "value"=>"Height: 350px Width: 698px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"imageName", "value"=>$D["imageName"], "title"=>"Image", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["imageName"],$MXPGINFO["TBL"],$D["galleryTitle"],100,100,"98%","auto")));
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
      <input type="hidden" name="gallCat" value="<?php  echo implode(",",$gallCats);?>" />
      <table width="100%" border="0" cellpadding="7" cellspacing="0">
        <tr>
          <td align="right"><?php echo '<ul class="tree-list">'.getCatTree(6,"checkbox",$gallCats,2).'</ul>';?></td>
        </tr>
      </table>
    </div>
  </div>
</form>
<?php echo getPrettyJs();?> 