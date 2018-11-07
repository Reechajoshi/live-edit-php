<?php
$arrSearch = array(
array("type"=>"text", "name"=>"contactUsID", "value"=>"", "title"=>"#ID", "where"=>"AND U.contactUsID='SVAL'"),
array("type"=>"text", "name"=>"name", "value"=>$D["name"], "title"=>"First Name", "where"=>"AND U.name LIKE '%SVAL%'"),
array("type"=>"text", "name"=>"email", "value"=>$D["email"], "title"=>"Email", "where"=>"AND U.email LIKE '%SVAL%'"),
array("type"=>"text", "name"=>"reason", "value"=>$D["reason"], "title"=>"reason", "where"=>"AND U.reason LIKE '%SVAL%'"));				
$FRM = new mxForm();
$strSearch = $FRM->getSearch($arrSearch);

$sql = "SELECT U.".$MXPGINFO['PK']." FROM `".$DB->pre.$MXPGINFO["TBL"]."` AS U WHERE U.status='$STATUS' $FRM->where";
//echo $sql;
$DB->dbQuery($sql);
$MXTOTREC = $DB->numRows;

if(!$FRM->where && $MXTOTREC < 1)
	$strSearch = "";

echo getPageNav();
echo $strSearch;
if($MXTOTREC > 0) {	
	$sql = "SELECT U.* FROM `".$DB->pre.$MXPGINFO["TBL"]."` AS U WHERE U.status='$STATUS' $FRM->where LIMIT $MXOFFSET,$MXSHOWREC"; 
	$DB->dbRows($sql);
	$COLS = array(
	array("#ID","contactUsID",' width="1%" align="center"'),
	array("Name","name",' align="left"'),
	array("Email","email",' align="left"'),
	array("Reason","reason",' align="left"'),
	array("Message","message",' align="left"'),
	array("Date Added","dateAdded",' align="center"'));
?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($COLS); ?> </tr>
    <?php foreach($DB->rows as $d) { ?>
    <tr> <?php echo getMAction("mid",$d["contactUsID"]);?>
      <?php foreach ($COLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { echo getEditUrl("id=".$d["contactUsID"],$d[$v[1]]); } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php } ?>
  </table>
</div>
<?php } else { ?>
<div class="no-records">No records found</div>
<?php } ?>
