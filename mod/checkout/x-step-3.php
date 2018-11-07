<?php 
//$siteUserID = $_SESSION['SITEUSERID'];

/*if($_SESSION['PRODUCTCART']){
	$flag = 0;
	foreach($_SESSION['PRODUCTCART'] as $key=>$val){
		if($val['productType'] != 'nu-chips'){
			foreach($val as $k=>$v){
				$flag = 1;
			}
		}
	}
}
if($flag == 0){
	if(!$siteUserID){
		header('location: '.SITEURL.'/checkout/step-2/');
	}else{
		header('location: '.SITEURL.'/checkout/step-4/');
	}
	if(!$_SESSION['totProCartCount']){ header('location: '.SITEURL.'/checkout/step-1/');}
}else{
	if(!$siteUserID){header('location: '.SITEURL.'/checkout/step-2/');}
	if(!$_SESSION['totProCartCount']){ header('location: '.SITEURL.'/checkout/step-1/');}
}*/

$checkout_s2_err_msg = getErrorMessages( "checkout_step_3" );
$city_err_msg = $checkout_s2_err_msg[ 'city' ];
$contact_err_msg = $checkout_s2_err_msg[ 'contact' ];
$country_id_err_msg = $checkout_s2_err_msg[ 'country_id' ];
$first_name_err_msg = $checkout_s2_err_msg[ 'first_name' ];
$last_name_err_msg = $checkout_s2_err_msg[ 'last_name' ];
$shipping_addr_err_msg = $checkout_s2_err_msg[ 'shipping_addr' ];
$state_err_msg = $checkout_s2_err_msg[ 'state' ];
$user_zip_err_msg = $checkout_s2_err_msg[ 'user_zip' ];

$add_addr_btn_details = getButtons( "add_new_addr", "checkout_step_03" );	
$back_btn_details = getButtons( "back", "checkout_step_03" );	
$next_btn_details = getButtons( "next", "checkout_step_03" );	


$validate = array(
	"userFirstName"=>array("func"=>"required","msg"=>$first_name_err_msg),
	"userLastName"=>array("func"=>"required","msg"=>$last_name_err_msg),
	"userContact"=>array("func"=>"required,mobile","msg"=>$contact_err_msg),
	"userCity"=>array("func"=>"required","msg"=>$city_err_msg),
	"userState"=>array("func"=>"required","msg"=>$state_err_msg),
	"countryID"=>array("func"=>"required","msg"=>$country_id_err_msg),
	"shippingAddress"=>array("func"=>"required","msg"=>$shipping_addr_err_msg),
	"userZip"=>array("func"=>"required","msg"=>$user_zip_err_msg)
);
?>
<script type="text/javascript" src="<?php echo SITEURL?>/inc/js/msdropdown/js/jquery.dd.js"></script>
<script type="text/javascript" src="<?php echo SITEURL?>/mod/checkout/checkout.inc.js"></script>
<script>
$(document).ready(function(){
	try {
	oHandler = $(".mydds").msDropDown().data("dd");
	$("#ver").html($.msDropDown.version);
	} catch(e) { alert("Error: "+e.message); }
});
</script>

<input type="hidden" name="SITEUSERID" id="SITEUSERID" value="<?php $_SESSION?>" />
<input type="hidden" id="billingAddressID" />
<input type="hidden" id="shippingAddressID" />
<div class="checkout-wrapp">
  <h1>CHECKOUT</h1>
  <ul class="steps-nav">
    <li><a onclick="return false;">Step 1</a></li>
    <li><a onclick="return false;">Step 2</a></li>
    <li><a onclick="return false;" class="active">Step 3</a></li>
    <li><a onclick="return false;">Step 4</a></li>
  </ul>
  <div class="checkout-step2-new-user">
    <div class="loader"></div>
    <div class="checkout-existing-user-form">
      <div class="left">
        <h2 class="step-3-title">SELECT AN EXISTING SHIPPING ADDRESS</h2>
        <div class="scroll-pane">
          <div id="addListing"> <?php echo shippingAddresList();?> </div>
        </div>
      </div>
      <div class="right">
        <h2 class="step-3-title">ADD NEW SHIPPING ADDRESS</h2>
        <form name="shippingAddr" id="shippingAddr" onsubmit="return false;">
          <input type="hidden" name="siteUserID" id="siteUserID"  value="<?php echo $_SESSION['SITEUSERID'];?>" />
          <input type="hidden" name="shippingAddressID" id="shippingAddressID" value="" />
          <input type="hidden" name="xAct" id="xAdd" value="ADD" />
          <ul class="form shipping">
            <li> 
              <span class="title">First Name<em>*</em></span>
              <div class="element">
                <input value="" type="text" name="userFirstName" id="userFirstName" class="text" title="First Name" />
              </div>
            </li>
            <li> 
              <span class="title">Last Name<em>*</em></span>
              <div class="element">
                <input value="" type="text" name="userLastName" id="userLastName" class="text" title="Last Name" />
              </div>
            </li>
            <li> 
              <span class="title">CONTACT NO<em>*</em></span>
              <div class="element">
                <input value="" type="text" name="userContact" id="userContact" class="text" title="Contact No" />
              </div>
            </li>
            <li> 
              <span class="title">City<em>*</em></span>
              <div class="element">
                <input type="text" name="userCity" id="userCity" value="" class="text" title="City" />
              </div>
            </li>
            <li> 
              <span class="title">State<em>*</em></span>
              <div class="element">
                <input value="" type="text" name="userState" id="userState"  class="text" title="State" />
              </div>
            </li>
            <li> 
              <span class="title">COUNTRY<em>*</em></span>
              <div class="element">
                <select class="mydds" name="countryID" id="countryID" title="Country">
                  <option value="">--Select--</option>
                  <?php echo getTableDD($DB->pre."country","countryID","countryName",$D["countryID"]);?>
                </select>
              </div>
            </li>
            <li> 
              <span class="title">ADDRESS<em>*</em></span>
              <div class="element">
                <textarea name="shippingAddress" id="shippingAddress" cols="" rows="" class="text address" title="Address"></textarea>
              </div>
            </li>
            <li> 
              <span class="title">Zip Code<em>*</em></span>
              <div class="element">
                <input type="text" name="userZip" id="userZip" value="" class="text" title="Zip Code" />
              </div>
            </li>
            <li>
              <input type="hidden" name="mxValidate" id="mxValidate" value="<?php echo urlencode(json_encode($validate));?>" />
            </li>
          </ul>
          <!-- <a href="#" class="btn-add" id="addShippingAddr">ADD NEW ADDRESS</a> -->
		  <a href="#" class="btn-add <?php echo( $add_addr_btn_details["color"] ); ?>" id="addShippingAddr"><?php echo( $add_addr_btn_details["button_txt"] ); ?></a>
        </form>
      </div>
      <!-- <div class="chekout-btn"> <a href="<?php echo SITEURL.'/checkout/step-2/';?>" class="btn-back">Back</a>  -->
	  <div class="chekout-btn <?php echo( $back_btn_details["color"] ); ?>"> <a href="<?php echo( $back_btn_details["link"] );?>" class="btn-back"><?php echo( $back_btn_details["button_txt"] ); ?></a> 
      <!-- <a href="#" class="btn-next" id="setAddress">Next</a> </div> -->
	  <a href="#" class="btn-next <?php echo( $next_btn_details["color"] ); ?>" id="setAddress"><?php echo( $next_btn_details["button_txt"] ); ?></a> </div>
    </div>
  </div>
</div>
