<?php

if($TPL->pageType == "edit"){	
	$id = $_GET["id"];	
	$category = $_GET["cat"];
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` where buttonId='$id' and category = '$category';");
} else {
	$D = $_POST;	
}

$arrFrom = array();
$button_type_val = array( "submit" => "Submit", "link" => "Link" );
$button_type_DD = getArrayDD( $button_type_val, $D["btn_type"] );
/* $color_val = array( "gray" => "Gray", "red" => "Red", "blue" => "Blue", "yelow" => "Yellow", "green" => "Green", "purple" => "Purple", "light_yellow" => "Light Yellow", "light_blue" => "Light Blue" ); */
$color_val = array( 
	"dark_yellow_shading" => "Dark Yellow With Shading", 
	"light_yellow_shading" => "Light Yellow With Shading", 
	"green_shading" => "Green With Shading", 
	"purple_shading" => "Purple With Shading", 
	"blue_shading" => "Blue With Shading", 
	"red_shading_black_border" => "Red Shading With Black Border",
	"red_shading_white_border" => "Red Shading With White Border",	
	"red_shading_no_border" => "Red Shading With No Border",
	"gray_shading" => "Gray With Shading", 
	"light_yellow" => "Light Yellow", 
	"light_blue" => "Light Blue", 
	"light_gray" => "Light Gray",
	"light_red" => "Light Red"
);
$color_DD = getArrayDD( $color_val, $D["color"] );

$arrFrom = array(
array("type"=>"text", "name"=>"btnId", "value"=>$D["buttonId"], "title"=>"Button ID", "validate"=>"", "prop"=>"disabled"),
array("type"=>"hidden", "name"=>"button_category", "value"=>$D["category"]),
array("type"=>"text", "name"=>"category", "value"=>$D["category"], "title"=>"Button Category", "validate"=>"", "prop"=>"disabled"),
array("type"=>"select", "name"=>"btn_type", "value"=>$button_type_DD, "title"=>"Button Type", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"button_txt", "value"=>$D["button_txt"], "title"=>"Button Text", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"link", "value"=>$D["link"], "title"=>"Link", "validate"=>"", "prop"=>' class="text"'),
/* array("type"=>"text", "name"=>"onclick", "value"=>$D["onclick"], "title"=>"OnClick", "validate"=>"", "prop"=>' class="text"'), */
array("type"=>"select", "name"=>"color", "value"=>$color_DD, "title"=>"Button Color", "validate"=>"", "prop"=>' class="text"')
);


// print_r( $arrFrom );

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