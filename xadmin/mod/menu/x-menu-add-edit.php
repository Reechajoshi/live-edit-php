<?php	
$menuType = "module";	
if($TPL->pageType == "edit"){
	$id = sprintf("%d",$_GET["id"]);	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='1' AND ".$MXPGINFO["PK"]."='$id'");
} else {
	$D = $_POST;	
}
if(!$D['menuType'])	
	$D["menuType"] = "module";

$arrCats = $DB->dbRows("SELECT menuID,menuTitle,parentID FROM `mx_menu` WHERE 1 ORDER BY xOrder ASC"); 
$strOpt = getTreeDD($arrCats,"menuID","menuTitle","parentID",$D['parentID']);

$arrMenuType = array(); 
if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$DB->pre."category'"))==1)
	$arrMType["category"] =  "Category";

if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$DB->pre."page'"))==1) 
	$arrMType["page"] =  "Page";

$arrMenuType = array_merge($arrMType , array("module"=>"Module","exlink"=>"Ext. Link","other"=>"Other"));

$arrFrom = array(
array("type"=>"select", "name"=>"parentID", "value"=>$strOpt, "title"=>"Menu Parent", "validate"=>"", "prop"=>' class="select"'),
array("type"=>"text", "name"=>"menuTitle", "value"=>$D["menuTitle"], "title"=>"Menu Title", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"menuClass", "value"=>$D["menuClass"], "title"=>"Menu Class", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"xOrder", "value"=>$D["xOrder"], "title"=>"Menu Order", "validate"=>"", "prop"=>' class="text" class="text"'),
array("type"=>"editor", "name"=>"synopsis", "value"=>$D["synopsis"], "title"=>"Synopsis", "validate"=>"", "prop"=>' class="text" rows="3"'),
array("type"=>"textarea", "name"=>"metaTitle", "value"=>$D["metaTitle"], "title"=>"Meta Title", "validate"=>"", "prop"=>' class="text" rows="2"'),
array("type"=>"textarea", "name"=>"metaDesc", "value"=>$D["metaDesc"], "title"=>"Meta Description", "validate"=>"", "prop"=>' class="text" rows="3"'),
array("type"=>"textarea", "name"=>"metaKeyword", "value"=>$D["metaKeyword"], "title"=>"Meta Keyword", "validate"=>"", "prop"=>' class="text" rows="3"'));		
$FRM = new mxForm();


?>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/xadmin/mod/menu/x-menu.inc.js"></script>
<style>
table.tbl-grid td {
	background-color: #E5E5E5;
}
table.tbl-grid th {
	background-color: #DBDBDB;
	text-transform: uppercase;
}
input.allv {
	margin-top: 5px;
}
ul#type-items, ul#type-items li {
	float: left;
	width: 100%;
	margin: 0px;
	padding: 0px;
}
ul#type-items li {
	padding: 5px 0px 5px 0px;
	border-bottom: 1px solid #FFF;
}
ul#type-items li input {
	float: left;
	width: auto;
	margin-right: 5px;
}
</style>
<form name="frmAddEdit" id="frmAddEdit" action="" method="post" enctype="multipart/form-data">
  <?php echo getPageNav(); ?>
  <div id="wrap-data">
    <div id="wrap-form">
      <table width="100%" border="0" cellpadding="7" cellspacing="1" class="tbl-grid" id="tbl-access">
        <tr>
          <?php foreach($arrMenuType as $k=>$v) { 
		  			$chk = '';
					if($k==$D["menuType"]) $chk = ' checked="checked"'; ?>
          <th><?php echo $v; ?><br />
            <input type="radio" class="menu-type" name="menuType" value="<?php echo $k; ?>" class="radio"<?php echo $chk; ?> /></th>
          <?php } ?>
        </tr>
        
        <tr>
          <td colspan="<?php echo count($arrMenuType);?>">

          <ul id="type-items" class="mx-group" title="Type Item">
              <?php 
			  if($D["menuType"] != "other") { 
			  	echo call_user_func($D["menuType"]."DD",$D["seoUri"]); 
			  }
			  ?>
            </ul></td>
        </tr>
 
      </table>
    </div>
    <div id="wrap-sub-form">
      <table width="100%" border="0" cellpadding="7" cellspacing="0">
        <?php 
		$FRM->formType = "sub";
		//if($D["menuType"] != "other") 
			//$FRM->validate["type-items"] = array("func"=>"checked:1","msg"=>"Please select atleast one ".$D["menuType"]);	
		echo $FRM->getForm($arrFrom);?>
      </table>
    </div>
  </div>
</form>
<script>

</script>
