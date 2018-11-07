<?php
$arrSearch = array(
array("type"=>"text", "name"=>"vipMemberID", "value"=>"", "title"=>"#ID", "where"=>"AND vipMemberID='SVAL'",),
array("type"=>"text", "name"=>"vipMemberTitle", "value"=>$D["vipMemberTitle"], "title"=>"Title", "where"=>"AND vipMemberTitle LIKE '%SVAL%'"));				
$MXFRM = new mxForm();
$strSearch = $MXFRM->getSearch($arrSearch);

$sql = "SELECT ".$MXPGINFO['PK']." FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='$STATUS' $MXFRM->where";
//echo $sql;
$DB->dbQuery($sql);
$MXTOTREC = $DB->numRows;

if(!$MXFRM->where && $MXTOTREC < 1)
	$strSearch = "";

echo getPageNav();
echo $strSearch;
if($MXTOTREC > 0) {
	$sql = "SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='$STATUS' $MXFRM->where LIMIT $MXOFFSET,$MXSHOWREC"; 
	$DB->dbRows($sql);
	$MXCOLS = array(
	array("#ID","vipMemberID",' width="1%" align="center"'),
	array("Title","vipMemberTitle",' align="left"',true),
	array("Desciption","vipMemberDesc",' align="left"'),
	array("Amount","vipMemberAmt",' align="left"'),
	array("Date Added","dateAdded",' align="center"'),
	array("Last Modified","dateModified",' align="center"'));

?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($MXCOLS); ?> </tr>
    <?php foreach($DB->rows as $d) { ?>
    <tr> <?php echo getMAction("mid",$d["vipMemberID"]);?>
      <?php foreach ($MXCOLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { echo getEditUrl("id=".$d["vipMemberID"],$d[$v[1]]); } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php } ?>
  </table>
</div>
<?php } else { ?>
<div class="no-records">No records found</div>
<?php } ?>
