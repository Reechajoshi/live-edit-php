<?php
$arrSearch = array(
array("type"=>"text", "name"=>"HTPID", "value"=>"", "title"=>"#ID", "where"=>"AND HTPID='SVAL'"),
array("type"=>"text", "name"=>"HTPGameTitle", "value"=>$D["HTPGameTitle"], "title"=>"Game Title", "where"=>"AND HTPGameTitle LIKE '%SVAL%'"),
array("type"=>"text", "name"=>"HTPVideoUrl", "value"=>$D["HTPVideoUrl"], "title"=>"Video Url", "where"=>"AND  HTPVideoUrl LIKE '%SVAL%'"),
array("type"=>"text", "name"=>"HTPLink", "value"=>$d['HTPLink'], "title"=>"Link", "where"=>"AND HTPLink LIKE '%SVAL%'"));				
$FRM = new mxForm();
$strSearch = $FRM->getSearch($arrSearch);

$sql = "SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='$STATUS' $FRM->where";
$DB->dbQuery($sql);
$MXTOTREC = $DB->numRows;

if(!$FRM->where && $MXTOTREC < 1)
	$strSearch = "";
echo getPageNav();
echo $strSearch;
if($MXTOTREC > 0) {	
	$sql = "SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='$STATUS' $FRM->where LIMIT $MXOFFSET,$MXSHOWREC"; 
	$DB->dbRows($sql);
	$COLS = array(
	array("#ID","HTPID",' width="1%" align="center"'),
	array("Game Title","HTPGameTitle",' width="10%" align="center"',true),
	array("Video Url","HTPVideoUrl",' align="center"'),
	array("Link","HTPLink",' align="left"'),
	array("Date Added","dateAdded",' align="center"'));
?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($COLS); ?> </tr>
    <?php foreach($DB->rows as $d) { ?>
    <tr> <?php echo getMAction("mid",$d["HTPIID"]);?>
      <?php foreach ($COLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { echo getEditUrl("id=".$d["HTPID"],$d[$v[1]]); } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php } ?>
  </table>
</div>
<?php } else { ?>
<div class="no-records">No records found</div>
<?php } ?>

