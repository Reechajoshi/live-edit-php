<?php
$MXTOTREC = 0;
$MXPGINFO["PK"] = "orderID";
$MXPGINFO["TBL"] = "order";

function orderDetail($orderID){
	global $DB;
	$str = '<a href="#" class="btn-close">X</a>';
	$sql = "SELECT OP.*, S.userName, O.siteUserID, O.shippingAmt, O.shippingAddressID, O.orderType FROM `".$DB->pre."order_product` OP LEFT JOIN ".$DB->pre."order AS O ON(O.orderID=OP.orderID) LEFT JOIN ".$DB->pre."site_user AS S ON (S.siteUserID=O.siteUserID) WHERE O.orderID='$orderID'";
	$res = $DB->dbRows($sql);
	if($DB->numRows > 0) {
		$sql = "SELECT * FROM `".$DB->pre."order` WHERE orderID = '".$orderID."' AND status = 1";
		$add = $DB->dbRow($sql);
		if($DB->numRows > 0) {
		$str.='
    	  <strong>Shipping Address:</strong><br/><br/>
	      <table class="address" cellpadding="0" width="100%">
			<tr><td colspan="7">Address : '.$add['shippingAddress'].'</td></tr>
			<tr><td colspan="7">City : '.$add['userCity'].'</td></tr>
			<tr><td colspan="7">Country : '.$add['countryName'].'</td></tr>
			<tr><td colspan="7">State :'.$add['userState'].'</td></tr>
			<tr><td colspan="7">Contact : '.$add['userContact'].'</td></tr>
			<tr><td colspan="7">Zip : '.$add['userZip'].'</td></tr>
		  </table>';
		}

		$orderType = $add['orderType'];
		$k = 0;	
		if($orderType == 'Membership'){
			$str .= '
			<table width="100%" cellspacing="0" cellpadding="0" align="center" class="order-list" border="1" bordercolor="#ccc">
			  <tr>
				<th>Sr No.</th>
				<th>Image</th>
				<th>User Name</th>
				<th>Vip Membership</th>
				<th>Total</th>
              </tr>
			  <tr>
				<td>'.++$k.'</td>
				<td><img src="'.SITEURL.'/images/vip-membership.jpg" title="" height="50" width="50"/></td>
				<td> '.$res[0]['userName'].' </td>
				<td> SUCCESS</td>
				<td>$'.number_format($add['totalAmount']-5, 2, '.', '').'</td>
			  </tr>
			  <tr>
				<td colspan="4" align="right"><strong>Shipping Cost</strong></td>
				<td><strong>'.$add['shippingAmt'].'</strong></td>
			  </tr>
			  <tr>
				<td colspan="4" align="right"><strong>Total</strong></td>
				<td><strong>$'.number_format($add['totalAmount'], 2, '.', '').'</strong></td>
			  </tr>
		    </table>';
		}else{
			$str.='
			<table width="100%" cellspacing="0" cellpadding="0" align="center" class="order-list" border="1" bordercolor="#ccc">
			  <tr>
				<th>Sr No.</th>
				<th>Image</th>
				<th>Product Name</th>
				<th>Size</th>
				<th>Qty</th>
				<th>Price</th>
				<th>Total</th>
			</tr>';
			foreach($res as $D) {
				if($D['shippingAmt'])
					$shippingAmt = "$ ".$D['shippingAmt'];	
				else
					$shippingAmt = "N/A";	

				$sql = "SELECT P.productTitle, P.productImg1, C.categoryTitle FROM `".$DB->pre."product` AS P LEFT JOIN ".$DB->pre."category AS C ON (P.categoryID=C.categoryID) WHERE P.productID = '".$D['productID']."'";	
				$DB->dbRow($sql);
				$subTotal = $D['productQty'] * $D['productAmount'];
				$finalTotal += $subTotal;
					$str.= '
					<tr>
						<td>'.++$k.'</td>
						<td><img src="'.SITEURL.'/core/image.inc.php?path=product/'.$DB->row['productImg1'].'&w=50&h=50&type=crop" title=""/></td>
						<td>'.$DB->row['productTitle'].'</td>
						<td>'.$D['productSize'].'</td>
						<td>'.$D['productQty'].'</td>
						<td>$'.$D['productAmount'].'</td>
						<td>$'.number_format($subTotal, 2, '.', '').'</td>
					</tr>
				';
			}
			$str.='
				<tr>
					<td colspan="6" align="right"><strong>Shipping Cost</strong></td>
					<td><strong>'.$shippingAmt.'</strong></td>
				</tr>
				<tr>
					<td colspan="6" align="right"><strong>Total</strong></td>
					<td><strong>$'.number_format($finalTotal+$D['shippingAmt'], 2, '.', '').'</strong></td>
				</tr>
			</table>';
		}
	}else{
		$str .= 'No order details found.';
	}
	return $str;

}


if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {
		
		case "orderDetail":		
			include("../../../connectdb.inc.php");	
			echo orderDetail(intval($_GET['orderID']));			
		break;
	}
}

?>