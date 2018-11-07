<?php
$isVipArr = getArrayDD(array('isVip = 1'=>'Vip Member','isVip = 0'=>'Non Vip Member'),$_GET['isVip']);
$arrSearch = array(
array("type"=>"text", "name"=>"siteUserID", "value"=>"", "title"=>"#ID", "where"=>"AND siteUserID='SVAL'"),
array("type"=>"text", "name"=>"userName", "value"=>$D["userName"], "title"=>"Username", "where"=>"AND  userName LIKE '%SVAL%'"),
array("type"=>"text", "name"=>"userEmail", "value"=>$d['userEmail'], "title"=>"Email", "where"=>"AND userEmail='SVAL'"),
array("type"=>"text", "name"=>"userContact", "value"=>$d['userContact'], "title"=>"Contact No", "where"=>"AND userContact='SVAL'"),
array("type"=>"select", "name"=>"isVip", "value"=>$isVipArr, "title"=>"Member Type", "where"=>" AND SVAL"));				
$FRM = new mxForm();
$strSearch = $FRM->getSearch($arrSearch);

$sql = "SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='$STATUS' $FRM->where";
//echo $sql;
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
	array("#ID","siteUserID",' width="1%" align="center"',true),
	array("Image","imageName",' width="1%" align="center"'),
	array("Vip Member","isVip",' width="1%" align="center"'),
	array("Username","userName",' align="left"',true),
	array("Email","userEmail",' align="left"',true),
	array("DOB","userDob",' align="center"'),
	array("Contact No.","userContact",' align="left"'),
	array("Date Added","dateAdded",' align="center"'));
?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($COLS); ?> </tr>
    <?php foreach($DB->rows as $d) { 
		$d["imageName"] = getImage($d["imageName"],$MXPGINFO["TBL"],$d["imageName"]); 
		if($d['isVip'] == 1){ 
			$d['isVip'] = "YES";
		}else{
			$d['isVip'] = "NO";
		}
	?>
    <tr> <?php echo getMAction("mid",$d["siteUserID"]);?>
      <?php foreach ($COLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { 
	  	echo getEditUrl("id=".$d["siteUserID"],$d[$v[1]]); } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php } ?>
  </table>
</div>
<?php echo getPrettyJs();?>
<?php } else { ?>
<div class="no-records">No records found</div>
<?php } ?>

