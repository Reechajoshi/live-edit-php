<?php
$arrCats = $DB->dbRows("SELECT categoryID,categoryTitle,parentID FROM `".$DB->pre."category` WHERE categoryID IN(7,8)");
$strOpt = getTreeDD($arrCats,"categoryID","categoryTitle","parentID",$_REQUEST['categoryID']);
$arrSearch = array(
array("type"=>"text", "name"=>"galleryID", "value"=>"", "title"=>"#ID", "where"=>"AND galleryID='SVAL'"),
array("type"=>"text", "name"=>"galleryTitle", "value"=>$D["galleryTitle"], "title"=>"Gallery Title", "where"=>"AND  galleryTitle LIKE '%SVAL%'"),
array("type"=>"select", "name"=>"categoryID", "value"=>$strOpt, "title"=>"Category Title", "where"=>"AND galleryID IN(SELECT DISTINCT galleryID from `".$DB->pre."gallery_category` WHERE categoryID ='SVAL')"));
$FRM = new mxForm();
$strSearch = $FRM->getSearch($arrSearch);
//$sql = "SELECT G.*,GC.galleryID, C.categoryTitle FROM `".$DB->pre.$MXPGINFO["TBL"]."` AS G LEFT JOIN ".$DB->pre."gallery_category AS GC ON(G.galleryID=GC.galleryID) LEFT JOIN ".$DB->pre."category AS C ON(GC.categoryID=C.categoryID) WHERE G.status='$STATUS' $FRM->where";
$sql = "SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."`  WHERE status='$STATUS' $FRM->where";
//echo $sql;
$DB->dbQuery($sql);
$MXTOTREC = $DB->numRows;

if(!$FRM->where && $MXTOTREC < 1)
	$strSearch = "";
echo getPageNav();
echo $strSearch;
if($MXTOTREC > 0) {	
	$sql = "SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."`  WHERE status='$STATUS' $FRM->where LIMIT $MXOFFSET,$MXSHOWREC"; 
	$DB->dbRows($sql);
	$COLS = array(
	array("#ID","galleryID",' width="1%" align="center"',true),
	array("Image","imageName",' width="1%" align="center"'),
	array("Gallery Title","galleryTitle",' align="left"',true),
	array("Category Title","categoryTitle",' align="left"'),
	array("Date Added","dateAdded",' align="center"'));
?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($COLS); ?> </tr>
    <?php foreach($DB->rows as $d) { 
		$d["imageName"] = getImage($d["imageName"],$MXPGINFO["TBL"],$d["imageName"]);  
		$arrCatTitle = getGalCatName($d["galleryID"]); 
		$catTitle = "&nbsp;";	
		if($arrCatTitle) 
			$d['categoryTitle'] = implode(", ",$arrCatTitle);
	?>
    <tr> <?php echo getMAction("mid",$d["galleryID"]);?>
      <?php foreach ($COLS as $v) { ?>
      <td <?php echo $v[2];?>><?php if($v[3]) { echo getEditUrl("id=".$d["galleryID"],$d[$v[1]]); } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php } ?>
  </table>
</div>
<?php echo getPrettyJs();?>
<?php } else { ?>
<div class="no-records">No records found</div>
<?php } ?>

