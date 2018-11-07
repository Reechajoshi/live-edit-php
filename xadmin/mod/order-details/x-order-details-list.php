<script>
$(document).ready(function(){
	$("a.edit").click(function(){
		var orderID = $(this).attr('rel');
		var aUrl = ASITEURL+"/mod/order-details/x-order-details.inc.php?xAction=orderDetail&orderID="+orderID;
			$.ajax({
				type: 'post',
				url: aUrl,
				success: function(data){
					$("div.details-popup").html(data);
					$("div.details-popup").mxpopup();	
				}
			});	
		return false;	
	});
});
</script>
<?php
$arrSearch = array(
array("type"=>"text", "name"=>"orderID", "value"=>"", "title"=>"#ID", "where"=>"AND O.orderID='SVAL'"),
array("type"=>"text", "name"=>"token", "value"=>$D["token"], "title"=>"Token", "where"=>"AND O.token LIKE '%SVAL%'"),
array("type"=>"text", "name"=>"payerID", "value"=>$D["payerID"], "title"=>"Payer ID", "where"=>"AND O.payerID='SVAL'"),
array("type"=>"text", "name"=>"userName", "value"=>$D["userName"], "title"=>"Username", "where"=>"AND U.userName LIKE '%SVAL%'"),
array("type"=>"text", "name"=>"userContact", "value"=>$D["userContact"], "title"=>"User Contact", "where"=>"AND S.userContact LIKE '%SVAL%'"),
array("type"=>"text", "name"=>"totalAmount", "value"=>$D["totalAmount"], "title"=>"Total Amount", "where"=>"AND O.totalAmount LIKE '%SVAL%'"));				
$FRM = new mxForm();
$strSearch = $FRM->getSearch($arrSearch);

/*$sql = "SELECT O.*,P.productTitle,U.userName,S.userContact,S.shippingAddress FROM ".$DB->pre.$MXPGINFO["TBL"]." O LEFT JOIN ".$DB->pre."site_user AS U ON(U.siteUserID=O.siteUserID) LEFT JOIN ".$DB->pre."product AS P ON(P.productID=O.productID) LEFT JOIN ".$DB->pre."shipping_address AS S ON(s.shippingAddressID=O.shippingAddressID) LEFT JOIN ".$DB->pre."country AS C ON(C.countryID=S.countryID) WHERE O.status='$STATUS' $FRM->where";*/
$sql = "SELECT O.*,S.userContact,S.userState,S.userCity,S.userZip,S.shippingAddress,C.countryName,U.userName FROM ".$DB->pre.$MXPGINFO["TBL"]." O LEFT JOIN ".$DB->pre."site_user AS U ON(U.siteUserID=O.siteUserID) LEFT JOIN ".$DB->pre."shipping_address AS S ON(S.shippingAddressID=O.shippingAddressID) LEFT JOIN ".$DB->pre."country AS C ON(C.countryID=S.countryID) WHERE O.status='$STATUS' $FRM->where";
//echo $sql;
$DB->dbQuery($sql);
$MXTOTREC = $DB->numRows;

if(!$FRM->where && $MXTOTREC < 1)
	$strSearch = "";

echo getPageNav();
echo $strSearch;
if($MXTOTREC > 0) {	
	$sql = "SELECT O.*,S.userContact,S.userState,S.userCity,S.userZip,S.shippingAddress,C.countryName,U.userName FROM ".$DB->pre.$MXPGINFO["TBL"]." O LEFT JOIN ".$DB->pre."site_user AS U ON(U.siteUserID=O.siteUserID) LEFT JOIN ".$DB->pre."shipping_address AS S ON(S.shippingAddressID=O.shippingAddressID) LEFT JOIN ".$DB->pre."country AS C ON(C.countryID=S.countryID) WHERE O.status='$STATUS' $FRM->where ORDER BY orderID DESC LIMIT $MXOFFSET,$MXSHOWREC"; 
	$DB->dbRows($sql);
	$COLS = array(
	array("#ID","orderID",' width="1%" align="center"'),
	array("Token","token",' align="left"',true),
	array("Payer ID","payerID",' align="left"'),
	array("Username","userName",' align="left"'),
	array("User Contact","userContact",' align="left"'),
	array("Total Amount","totalAmount",' align="left"'),
	array("Order Type","orderType",' align="left"'),
	array("Date Added","dateAdded",' align="center"'));
?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($COLS); ?> </tr>
    <?php foreach($DB->rows as $d) { ?>
    <tr> <?php echo getMAction("mid",$d["orderID"]);?>
      <?php foreach ($COLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { echo '<a href="#" rel="'.$d["orderID"].'" class="edit" title="Click to Edit"><strong>'.$d[$v[1]].'</strong></a>'; } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php } ?>
  </table>
</div>
<?php } else { ?>
<div class="no-records">No records found</div>
<?php } ?>


