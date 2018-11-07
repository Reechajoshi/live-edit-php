<?php
$arrSearch = array(
array("type"=>"text", "name"=>"postID", "value"=>"", "title"=>"#ID", "where"=>"AND postID='SVAL'",),
array("type"=>"text", "name"=>"postTitle", "value"=>$D["postTitle"], "title"=>"Post Title", "where"=>"AND postTitle LIKE '%SVAL%'"));				
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
	$sql =  "SELECT U.* FROM `".$DB->pre.$MXPGINFO["TBL"]."` AS U  WHERE U.status='$STATUS' $MXFRM->where ORDER BY datePublish DESC LIMIT $MXOFFSET,$MXSHOWREC";
	$DB->dbRows($sql);
	$MXCOLS = array(
	array("#ID","postID",' width="1%" align="center"'),	
	array("Image","postThumb",' width="1%" align="center"'),
	array("Post Title","postTitle",' align="left"',true),
	array("Publish Date","datePublish",' align="center"'),
	array("Date Added","dateAdded",' align="center"'),
	array("Last Modified","dateModified",' align="center"'));
?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($MXCOLS); ?> </tr>
    <?php foreach($DB->rows as $d) { $d["postThumb"] = getImage($d["postThumb"],$MXPGINFO["TBL"],$d["postTitle"]); ?>
    <tr> <?php echo getMAction("mid",$d["postID"]);?>
      <?php foreach ($MXCOLS as $v) { ?>
       <td<?php echo $v[2];?>><?php if($v[3]) { echo getEditUrl("id=".$d["postID"],$d[$v[1]]); } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php } ?>
  </table>
</div>
<?php } else { ?>
<div class="no-records">No records found</div>
<?php } ?>
