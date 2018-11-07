<?php
$D = $MXSETTINGS;
$arrTheme = array("maxdigi"=>"Maxdigi","foxy"=>"Foxy","default"=>"Default");
$optTheme = getArrayDD($arrTheme,$D["theme"]);
$arrEditor = array("Full"=>"Full","Medium"=>"Medium","Basic"=>"Basic");
$optEditor = getArrayDD($arrEditor,$D["editor"]);

$arrDefaultPage = getDataArray($DB->pre."admin_menu","seoUri","menuTitle"," menuType = '0'");
$arrDefaultPage["admin-user"] = "Admin Users";
$optDefaultPage = getArrayDD($arrDefaultPage,$D["default-page"]);

//print_r($D);

$arrFrom = array(
array("type"=>"file", "name"=>"logo", "value"=>$D["logo"], "title"=>"logo", "validate"=>"required,image", "prop"=>' class="text"', "info"=>'<img src="'.ASITEURL.'/images/settings/'.$D["logo"].'" height="40" class="img-logo" title="Logo" /><br /><span class="info">Max Dimention: 200x55</span>'),
array("type"=>"file", "name"=>"favicon", "value"=>$D["favicon"], "title"=>"Favicon", "validate"=>"required,image", "prop"=>' class="text"', "info"=>'<img src="'.ASITEURL.'/images/settings/'.$D["favicon"].'" height="20" class="img-favicon" title="Logo" /><br /><span class="info">Max Dimention: 20x20</span>'),
array("type"=>"text", "name"=>"page-title", "value"=>$D["page-title"], "title"=>"Page Title", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"select", "name"=>"theme", "value"=>$optTheme, "title"=>"Theme", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"select", "name"=>"default-page", "value"=>$optDefaultPage, "title"=>"Default Page", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"select", "name"=>"editor", "value"=>$optEditor, "title"=>"Editor Tools", "validate"=>"required", "prop"=>' class="text"'));
?>
<style>
.img-logo {
	margin: 0px 0px -7px 10px;
}
.img-favicon {
	margin: 0px 0px 0px 10px;
}
</style>
<form name="frmAddEdit" id="frmAddEdit" action="" method="post" enctype="multipart/form-data">
  <div id="page-nav">
    <div class="mandatory">Fields with (<em>* </em>) are mandatory</div>
    <div id="navigate">
      <input type="submit" name="btnSubmit" id="btnSubmit" class="btn-medium" value="UPDATE" />
      <input type="button" name="btnRestore" id="btnRestore" class="btn-medium" value="Restore Default" />
    </div>
  </div>
  <div id="wrap-data">
    <div id="wrap-form">
      <table width="100%" border="0" cellpadding="7" cellspacing="0">
        <?php 
		$MXFRM = new mxForm();					
		echo $MXFRM->getForm($arrFrom); ?>
      </table>
    </div>
    <div id="wrap-sub-form"> </div>
  </div>
</form>
<script language="javascript" type="text/javascript">
	$(document).ready(function(e) {		
		$("#btnRestore").click(function(){			
			showMxLoader();		
			$.ajax({
			  url: ASITEURL+"/mod-core/setting/x-setting.inc.php?xAction=restore",
			  success: function(data) {
				hideMxLoader();		
				window.location.reload();
			  }
			});				
			return false;	
		});
	});
	</script>
