<?php
$arrSearch = array(
array("type"=>"text", "name"=>"pageID", "value"=>"", "title"=>"#ID", "where"=>"AND pageID='SVAL'",),
array("type"=>"text", "name"=>"pageTitle", "value"=>$D["pageTitle"], "title"=>"Page Title", "where"=>"AND pageTitle LIKE '%SVAL%'"));				
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
	array("#ID","pageID",' width="1%" align="center"'),
	array("Image","pageImage",' width="1%" align="center"'),	
	array("Name","pageTitle",' align="left"',true),
	array("Template File","templateFile",' align="left"'),
	array("Date Added","dateAdded",' align="center"'),
	array("Last Modified","dateModified",' align="center"'));

?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($MXCOLS); ?> </tr>
    <?php foreach($DB->rows as $d) { $d["pageImage"] = getImage($d["pageImage"],$MXPGINFO["TBL"],$d["pageTitle"]); ?>
    <tr> <?php echo getMAction("mid",$d["pageID"]);?>
      <?php foreach ($MXCOLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { echo getEditUrl("id=".$d["pageID"],$d[$v[1]]); } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php } ?>
  </table>
</div>
<?php } else { ?>
<div class="no-records">No records found</div>
<?php } ?>
