<?php
session_start();

function addToCart(){
	global $DB;
	$str="";

	if(!isset($_SESSION["PRODUCTCART"])){
		$_SESSION['PRODUCTCART'] = array();
	}

	$productID = intval($_REQUEST['productID']);
	$productType = $_REQUEST['producttype'];
	$productSize = $_REQUEST['size'];
	if($productID){
		$sql = "SELECT productID,productTitle,productPrice,productImg1,discount FROM `".$DB->pre."product` WHERE `productID` ='".sprintf('%d',$productID)."' AND status = 1";	
		$res = $DB->dbRows($sql);
	
		$productTitle = $res[0]['productTitle'];
		$productPrice = $res[0]["productPrice"];
		$productImage = $res[0]['productImg1'];
		$discount = $res[0]['discount'];
		
		if($discount != 0){
			$prodDiscount = (($productPrice * $discount)/100);
			$productPrice = $productPrice - $prodDiscount;
		}
		if($_REQUEST['prodQty']){
			$productQty  = $_REQUEST['prodQty'];
		}else{
			$productQty  = 1;
		}
		
		if($productQty > 0){
			if($productSize != "undefined"){
				if($_SESSION["PRODUCTCART"][$productID][$productSize]){
					$sizeQty = $_SESSION["PRODUCTCART"][$productID][$productSize]['productQty'];
					$_SESSION["PRODUCTCART"][$productID][$productSize] = array("productID"=>$productID,"productType"=>$productType,"productQty"=>($sizeQty+$productQty),"productPrice"=>$productPrice,"productSize"=>$productSize,"productTitle"=>$productTitle,"productImage"=>$productImage,"productID"=>$productID,"discount"=>$discount);
				} else {
					$_SESSION["PRODUCTCART"][$productID][$productSize] = array("productID"=>$productID,"productType"=>$productType,"productQty"=>$productQty,"productPrice"=>$productPrice,"productSize"=>$productSize,"productTitle"=>$productTitle,"productImage"=>$productImage,"productID"=>$productID,"discount"=>$discount);
				}
			}else{
				if($_SESSION["PRODUCTCART"][$productID]){
					$prodQty = $_SESSION["PRODUCTCART"][$productID]['productQty'];
					$_SESSION["PRODUCTCART"][$productID] = array("productID"=>$productID,"productType"=>$productType,"productQty"=>($prodQty+$productQty),"productPrice"=>$productPrice,"productSize"=>$productSize,"productTitle"=>$productTitle,"productImage"=>$productImage,"productID"=>$productID,"discount"=>$discount);
				} else {
					$_SESSION["PRODUCTCART"][$productID] = array("productID"=>$productID,"productType"=>$productType,"productQty"=>$productQty,"productPrice"=>$productPrice,"productSize"=>$productSize,"productTitle"=>$productTitle,"productImage"=>$productImage,"productID"=>$productID,"discount"=>$discount);
				}
			}
				
			if($_SESSION['PRODUCTCART']){	
				foreach($_SESSION['PRODUCTCART'] as $key=>$val){
					if($val['productSize'] !="undefined"){
						foreach($val as $k=>$v){
							$tot1 = $tot1+1;
						}
					}else{
						$tot2 = $tot2+1;
					}
				}
			}
			echo $_SESSION['totProCartCount'] =  $tot3 = ($tot1 + $tot2);
		}else{
			echo "ERR";	
		}
	}
}

function changeProdQty(){
	global $DB;
	$str="";

	if(!isset($_SESSION["PRODUCTCART"])){
		$_SESSION['PRODUCTCART'] = array();
	}
	
	$productID = intval($_REQUEST['productID']);
	$productSize = $_REQUEST['size'];
	if($productID){
		$sql = "SELECT productID,productTitle,productPrice,productImg1,discount FROM `".$DB->pre."product` WHERE `productID` ='".sprintf('%d',$productID)."' AND status = 1";	
		$res = $DB->dbRows($sql);
	
		$productTitle = $res[0]['productTitle'];
		$productPrice = $res[0]["productPrice"];
		$productImage = $res[0]['productImg1'];
		$discount = $res[0]['discount'];
		
		if($discount != 0){
			$prodDiscount = (($productPrice * $discount)/100);
			$productPrice = $productPrice - $prodDiscount;
		}
		if($_REQUEST['prodQty']){
			$productQty  = $_REQUEST['prodQty'];
		}else{
			$productQty  = 1;
		}
		
		if($productQty > 0){
			if($_REQUEST['changeQty'] == 'changeQty'){
				if($productSize != "undefined"){
					$_SESSION["PRODUCTCART"][$productID][$productSize] = array("productQty"=>$_REQUEST['prodQty'],"productPrice"=>$productPrice,"productSize"=>$productSize,"productTitle"=>$productTitle,"productImage"=>$productImage,"productID"=>$productID,"discount"=>$discount);
				}else{
					$_SESSION["PRODUCTCART"][$productID] = array("productQty"=>$_REQUEST['prodQty'],"productPrice"=>$productPrice,"productSize"=>$productSize,"productTitle"=>$productTitle,"productImage"=>$productImage,"productID"=>$productID,"discount"=>$discount);
				}
			}
			if($_SESSION['PRODUCTCART']){
				foreach($_SESSION['PRODUCTCART'] as $key=>$val){
					if($val['productSize'] !="undefined"){
						foreach($val as $k=>$v){
							$tot1 = $tot1+1;
						}
					}else{
						$tot2 = $tot2+1;
					}
				}
			}
			echo $_SESSION['totProCartCount'] =  $tot3 = ($tot1 + $tot2);
		}else{
			echo "ERR";	
		}
	}
}

function deleteCartProduct(){
	$productID = intval($_REQUEST['productID']);
	$productSize = $_REQUEST['productsize'];
	if($productID && $productSize == "NOTDEF"){
		unset($_SESSION["PRODUCTCART"][$productID]);
		if($_SESSION['PRODUCTCART']){
			foreach($_SESSION['PRODUCTCART'] as $key=>$val){
				if($val['productSize'] !="undefined"){
					foreach($val as $k=>$v){
						$tot1 = $tot1+1;
					}
				}else{
					$tot2 = $tot2+1;
				}
			}
		}
		echo $_SESSION['totProCartCount'] =  $tot3 = ($tot1 + $tot2);
	}elseif($productID && $productSize != "NOTDEF"){
		$_SESSION["PRODUCTCART"][$productID][$productSize];
		unset($_SESSION["PRODUCTCART"][$productID][$productSize]);
		if($_SESSION['PRODUCTCART']){
			foreach($_SESSION['PRODUCTCART'] as $key=>$val){
				if($val['productSize'] !="undefined"){
					foreach($val as $k=>$v){
						$tot1 = $tot1+1;
					}
				}else{
					$tot2 = $tot2+1;
				}
			}
		}
		echo $_SESSION['totProCartCount'] =  $tot3 = ($tot1 + $tot2);
	}else{
		echo "ERR";	
	}
}

function checkOutForm(){
	global $DB;
	$str = "";
	
	$continue_shopping_btn_details = getButtons( "continue_shopping", "checkout_step_01" );		
	$proceed_payment_btn_details = getButtons( "proceed_payment", "checkout_step_01" );		
	
	if($_SESSION['PRODUCTCART']){
		$flag = 0;
		foreach($_SESSION['PRODUCTCART'] as $key=>$val){
			if($val['productType'] != 'nu-chips'){
				foreach($val as $k=>$v){
					$flag = 1;
				}
			}
		}
	}
	

	$str.='<h3>SHOPPING CART</h3>';
	if($_SESSION['PRODUCTCART']){
    $str.='
	<table class="table-order-summary" width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="118">ITEM</th>
        <th width="415">&nbsp;</th>
        <th width="115" align="left">SIZE</th>
		<th width="140" align="center">QUANTITY</th>
        <th width="140" align="center">DISCOUNT</th>
        <th width="115" align="center">PRICE</th>
        <th width="78" align="center">TOTAL</th>
      </tr>';
	  if($_SESSION['PRODUCTCART']){
		foreach($_SESSION['PRODUCTCART'] as $key=>$val){
			$prodCost = $val['productPrice'] * $val['productQty'];
			if($val['productSize'] !="undefined"){
				foreach($val as $k=>$v){
					$prodSizeCost = $v['productPrice'] * $v['productQty'];
		$str.='
		<tr>
			<td width="118">
				<a class="thumb">
					<img src="'.SITEURL.'/core/image.inc.php?path=product/'.$v['productImage'].'&amp;w=60&amp;h=60&amp;type=crop" title="'.$v['productTitle'].'" /></a></td>
			<td width="415">'.$v['productTitle'].'</td>
			<td width="415">';
			if($v['productSize']){
				$str.=$v['productSize'];
			}else{ 
				$str.='NULL';
			}
			$str.='
			</td>
			<td width="140" align="center">
            	<input type="text" value="'.$v['productQty'].'" sizename="'.$v['productSize'].'" class="text" pid="'.$v['productID'].'" disabled="disabled" />
			  <a href="#" rel="'.$v['productID'].'" sizename="'.$v['productSize'].'" class="changeVal">Change</a> 
              <a href="#" rel="'.$v['productID'].'" sizename="'.$v['productSize'].'" class="saveVal" style="display:none;">Save</a>
            </td>
			<td width="115" align="center">'.$v['discount'].'%</td>
			<td width="115" align="center">$'.$v['productPrice'].'</td>
			<td width="78" align="center">$'.$prodSizeCost.'</td>
			<td width="24">
				<a href="#" class="btn-remove"  rel="'.$v['productID'].'" productsize="'.$v['productSize'].'"> 
					<img src="'.SITEURL.'/images/btn-remove.png" /> 
				</a>
			</td>
		  </tr>';	
				$totProdSizeCost = $totProdSizeCost + $prodSizeCost;
				}
			}else{
		  $str.='
		  <tr>
			<td width="118">
				<a class="thumb">
					<img src="'.SITEURL.'/core/image.inc.php?path=product/'.$val['productImage'].'&amp;w=60&amp;h=60&amp;type=crop" title="'.$val['productTitle'].'" />
				</a>
			</td>
			<td width="415">'.$val['productTitle'].'</td>
			<td width="415">N/A</td>
			<td width="140" align="center">
            	<input type="text" value="'.$val['productQty'].'" class="text" pid="'.$val['productID'].'" disabled="disabled" />
			  	<a href="#" rel="'.$val['productID'].'"  class="changeVal">Change</a> 
              	<a href="#" rel="'.$val['productID'].'" class="saveVal" style="display:none;">Save</a>
            </td>
            <td width="115" align="center">'.$val['discount'].'%</td>
			<td width="115" align="center">$'.number_format($val['productPrice'], 2, '.', '').'</td>
			<td width="78" align="center">$'.number_format($prodCost, 2, '.', '').'</td>
			<td width="24">
				<a href="#" class="btn-remove"  rel="'.$val['productID'].'" productsize="NOTDEF"> 
					<img src="'.SITEURL.'/images/btn-remove.png" /> 
				</a>
			</td>
		  </tr>';
			}
			$totProdCost = $totProdCost + $prodCost;
		}
	}
    $str.='</table>
	<div class="total-amount">';
	if($flag != 0){
	$str.='
     <span class="title">SHIPPING CHARGES :</span>
      <p>$5.00</p>
	  <span class="title">TOTAL :</span>
      <p>$'.number_format(($totProdSizeCost + $totProdCost + 5), 2, '.', '').'</p>
    </div>';
	}else{
		$str.='
		  <span class="title">TOTAL :</span>
		  <p>$'.number_format(($totProdSizeCost + $totProdCost), 2, '.', '').'</p>
		</div>';
	}
    	if(!$_SESSION['SITEUSERID']){
			$URL = SITEURL.'/checkout/step-2/';
		}else{
			$URL = SITEURL.'/checkout/step-3/';
		}
    /* $str.='
	<div class="chekout-btn"><a href="'.SITEURL.'/shop/nu-chips/'.'" class="btn-back"> CONTINUE SHOPPING</a>
	<a href="'.$URL.'" class="btn-proceed-to-payment"> PROCEED TO PAYMENT</a></div>'; */
	$str.='
	<div class="chekout-btn"><a href="'.$continue_shopping_btn_details['link'].'" class="btn-back '.$continue_shopping_btn_details['color'].'"> '.$continue_shopping_btn_details['button_txt'].'</a>
	<a href="'.$proceed_payment_btn_detailsa['link'].'" class="btn-proceed-to-payment '.$proceed_payment_btn_details['color'].'">'.$proceed_payment_btn_details['button_txt'].'</a></div>';
	}else{
	$str.='
	<div class="without-shop-step-1"><span>YOUR CART IS EMPTY</span>	
	<a href="'.SITEURL.'/shop/nu-chips/'.'" class="button"> SHOP NOW </a></div>';
	}
	echo $str;
}

function addToVipMember(){
	global $DB;
	
	$str="";
	if( isset( $_SESSION['SITEUSERID'] ) )
	{
		$sql = "SELECT isVip FROM `".$DB->pre."site_user` WHERE siteUserID='".$_SESSION['SITEUSERID']."'";
		
		$DB->dbRow($sql);
		if($DB->numRows > 0) {
			$isVIP = ( intval( $DB->row["isVip"] ) === 1 );
			
			if( !$isVIP )
			{
				$sql = "update `".$DB->pre."site_user` set isVip=1, userChips=userChips+100000 WHERE siteUserID='".$_SESSION['SITEUSERID']."'";
				
				$DB->dbRow($sql);
				
				echo "OK";
			}
			else
				echo "OK1"; //user already vip memeber
		}
		else
			echo "ERR";
	}
	else{
		echo "ERR";	
	} 
	/* if(!isset($_SESSION["VIPMEMBERSHIPCART"])){
		$_SESSION['VIPMEMBERSHIPCART'] = array();
	}

	$sql = "SELECT * FROM `".$DB->pre."vip_membership` WHERE status = 1 LIMIT 1";	
	$DB->dbRow($sql);
	if($DB->numRows > 0) {
		$memberType = "vipMembership";
		$vipMemberAmt = $DB->row["vipMemberAmt"];
		$_SESSION["VIPMEMBERSHIPCART"] = array("memberType"=>$memberType,"vipMemberAmt"=>$vipMemberAmt);
		echo "OK";
	}else{
		echo "ERR";	
	} */
	
	
}

if($_REQUEST["xAction"]) {
  switch($_REQUEST["xAction"]) {
	  case "addToCart":
	  	require("../connectdb.inc.php");
	    addToCart();
	  break;
	  
	   case "deleteCartProduct":
	  	require("../connectdb.inc.php");
	    deleteCartProduct();
	  break;
	  
	  case "checkOutForm":
	  	require("../connectdb.inc.php");
	    checkOutForm();
	  break;
	  
	  case "changeProdQty":
	  	require("../connectdb.inc.php");
	    changeProdQty();
	  break;
	  
	  case "addToVipMember":
	  	require("../connectdb.inc.php");
	    addToVipMember();
	  break;
  }
}
?>