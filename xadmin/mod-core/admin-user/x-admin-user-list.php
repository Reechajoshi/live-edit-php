<?php
$strOpt = getTableDD($DB->pre."admin_role","roleAID","roleName",$_REQUEST["roleAID"]);

$arrSearch = array(
array("type"=>"text", "name"=>"userID", "value"=>"", "title"=>"#ID", "where"=>"AND U.userID='SVAL'"),
array("type"=>"text", "name"=>"displayName", "value"=>$D["displayName"], "title"=>"Full Name", "where"=>"AND U.displayName LIKE '%SVAL%'"),
array("type"=>"text", "name"=>"userName", "value"=>"", "title"=>"Login Name", "where"=>"AND U.userName='SVAL'"),
array("type"=>"text", "name"=>"userEmail", "value"=>$D["userEmail"], "title"=>"Email", "where"=>"AND U.userEmail LIKE '%SVAL%'"),
array("type"=>"select", "name"=>"roleAID", "value"=>$strOpt, "title"=>"User Type", "where"=>"AND U.roleAID='SVAL'"));				
$MXFRM = new mxForm(false,true);
$strSearch = $MXFRM->getSearch($arrSearch);

$sql = "SELECT U.".$MXPGINFO['PK']." FROM `".$DB->pre.$MXPGINFO["TBL"]."` AS U LEFT JOIN `".$DB->pre."admin_role` AS T ON U.roleAID = T.roleAID WHERE U.status='$STATUS' $MXFRM->where";
//echo $sql;
$DB->dbQuery($sql);
$MXTOTREC = $DB->numRows;

if(!$MXFRM->where && $MXTOTREC < 1)
	$strSearch = "";

echo getPageNav();
echo $strSearch;

if($MXTOTREC > 0) {  			
	$sql = "SELECT U.*,T.roleName FROM `".$DB->pre.$MXPGINFO["TBL"]."` AS U LEFT JOIN `".$DB->pre."admin_role` AS T ON U.roleAID=T.roleAID WHERE U.status='$STATUS' $MXFRM->where LIMIT $MXOFFSET,$MXSHOWREC"; 
	$DB->dbRows($sql);
	$MXCOLS = array(
	array("#ID","userID",' width="1%" align="center"'),
	array("Image","imageName",' width="1%" align="center"'),
	array("Name","displayName",' align="left"',true),
	array("Login Name","userName",' align="left"'),
	array("Email","userEmail",' align="left"'),
	array("Type","roleName",' align="left"'),
	array("Date Added","dateAdded",' align="center"'),
	array("Last Modified","dateModified",' align="center"'),
	array("Last Login","dateLogin",' align="center"'));
?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($MXCOLS); ?> </tr>
    <?php foreach($DB->rows as $d) { $d["imageName"] = getImage($d["imageName"],$MXPGINFO["TBL"],$d["displayName"]); ?>
    <tr> <?php echo getMAction("mid",$d["userID"]);?>
      <?php foreach ($MXCOLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { echo getEditUrl("id=".$d["userID"],$d[$v[1]]); } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php } ?>
  </table>
</div>
<?php echo getPrettyJs();?>
<?php } else { ?>
<div class="no-records">No records found</div>
<?php } ?>
