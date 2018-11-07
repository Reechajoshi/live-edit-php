<script type="text/javascript" src="<?php echo SITEURL;?>/mod/product/inc/js/bxslider/jquery.bxGallery.1.1.min.js"></script>
<script>
function checkBal(sizeBal){
	if(sizeBal == 0){
		$("div.product-size a.addCart").hide();
		$("div.product-size a.btn-gray").show();
		mxMsg("Product not availabe.");
	}else{
		$("div.product-size a.btn-gray").hide();
		$("div.product-size a.addCart").show();
	}
}
$(document).ready(function(){
	try {
	oHandler = $(".mydds").msDropDown().data("dd");
	$("#ver").html($.msDropDown.version);
	} catch(e) { alert("Error: "+e.message); }
	
	var sizeBal = $("ul.product-available li.Small div").attr('bal');
	checkBal(sizeBal)

	$('select.size').change(function(e) {
		var size = $(this).val();
		var sizeBal = $("ul.product-available li."+size+" div").attr('bal');
		checkBal(sizeBal)
	});
});
</script>
<?php 
require("inc/header-slider.php");
$productID = $TPL->modID;
$SQL = "SELECT P.*, C.categoryTitle FROM ".$DB->pre."product P LEFT JOIN ".$DB->pre."category AS C ON(P.categoryID=C.categoryID) WHERE P.status = '1' AND P.productID = '".$productID."'";
$DB->dbRow($SQL);
$product = $DB->row;

$out_of_stock_btn_details = getButtons( "out_of_stock", "product_detail" );	
?>
<div class="shop-wrapp">
  <div class="loader"></div>
  <div class="sidebar">
    <h2>NU CATEGORIES</h2>
    <ul class="sidebar-nav">
      <?php echo getCategoryMenu(5,$product["categoryID"]);?>
      <script>
      	$("a#nu-vip-membership").attr('href',SITEURL+"/user/vip-membership/");
      </script>
    </ul>
  </div>
  <div class="shop-conainer">
    <div class="product-details">
      <div class="social-net">
        <div class="fb-like" data-href="<?php echo SITEURL.'/product/'.$product['seoUri'].'/'.$product['productID'].'/'; ?>" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div>
      </div>
      <div class="product-view">
        <ul id="Products">
          <li> <img src="<?php echo SITEURL?>/core/image.inc.php?path=product/<?php echo $product['productImg1'];?>&w=395&h=348&type=crop" title=""/> </li>
          <li> <img src="<?php echo SITEURL?>/core/image.inc.php?path=product/<?php echo $product['productImg2'];?>&w=395&h=348&type=crop" title=""/> </li>
          <li> <img src="<?php echo SITEURL?>/core/image.inc.php?path=product/<?php echo $product['productImg3'];?>&w=395&h=348&type=crop" title=""/> </li>
          <li> <img src="<?php echo SITEURL?>/core/image.inc.php?path=product/<?php echo $product['productImg4'];?>&w=395&h=348&type=crop" title=""/> </li>
        </ul>
      </div>
      <div class="product-description">
        <h2> <?php echo $product["productTitle"];?> | $<?php echo $product['productPrice'];?></h2>
        <p> <?php echo $product["synopsis"];?> </p>
        <div class="product-size"> <span class="title">SIZE :</span>
          <form name="form" id="form">
            <select name="jumpMenu" class="mydds size" id="jumpMenu">
              <option value="Small">Small</option>
              <option value="Medium">Medium</option>
              <option value="Large">Large</option>
              <option value="XL">XL</option>
              <option value="XXL">XXL</option>
            </select>
            <input type="hidden" name="modID" id="modID" value="<?php echo $productID;?>" />
          </form>
          <!--<a class="button addCart" producttype="<?php //echo makeSeoUri($product['categoryTitle']);?>" href="#" rel="<?php //echo $product['productID']?>"> <span>$<?php //echo $product['productPrice'];?></span> </a>--> 
          <!-- <a class="btn-gray" style="display:none; cursor:default;"> <span>Out of Stock</span> </a> -->
		  <a class="btn-gray <?php echo( $out_of_stock_btn_details["color"] ); ?>" style="display:none; cursor:default;"> <span><?php echo( $out_of_stock_btn_details["button_txt"] ); ?></span> </a>
          <a class="button addCart" producttype="<?php echo makeSeoUri($product['categoryTitle']);?>" href="#"  rel="<?php echo $product['productID']?>"> BUY NOW </a>
		  <?php
		  	$SQL = "SELECT distinct(productID),sum(soldQty) AS soldQty,sum(totQty) AS totQty FROM ".$DB->pre."qty WHERE size = 'small' AND productID = '".$productID."' GROUP BY productID";
			$small = $DB->dbRow($SQL);
			if($small['soldQty']>0 && $small['totQty']>0){
				$smallRes = (($small['totQty'] - $small['soldQty']) * 100) / $small['totQty'];
			}else if($small['totQty'] > 0){
				$smallRes = 100;
			}else{
				$smallRes = 0;
			}
			
			$SQL1 = "SELECT distinct(productID),sum(soldQty) AS soldQty,sum(totQty) AS totQty FROM ".$DB->pre."qty WHERE size = 'medium' AND productID = '".$productID."' GROUP BY productID";
			$medium = $DB->dbRow($SQL1);
			if($medium['soldQty']>0 && $medium['totQty']>0){
				$mediumRes = (($medium['totQty'] - $medium['soldQty']) * 100) / $medium['totQty'];
			}else if($medium['totQty']>0){
				$mediumRes = 100;
			}else{
				$mediumRes = 0;
			}
			
			$SQL2 = "SELECT distinct(productID),sum(soldQty) AS soldQty,sum(totQty) AS totQty FROM ".$DB->pre."qty WHERE size = 'large' AND productID = '".$productID."' GROUP BY productID";
			$large = $DB->dbRow($SQL2);
			if($large['soldQty']>0 && $large['totQty']>0){
				$largeRes = (($large['totQty'] - $large['soldQty']) * 100) / $large['totQty'];
			}else if($large['totQty']>0){
				$largeRes = 100;
			}else{
				$largeRes = 0;
			}
			
			$SQL3 = "SELECT distinct(productID),sum(soldQty) AS soldQty,sum(totQty) AS totQty FROM ".$DB->pre."qty WHERE size = 'xl' AND productID = '".$productID."' GROUP BY productID";
			$xl = $DB->dbRow($SQL3);
			if($xl['soldQty']>0 && $xl['totQty']>0){
				$xlRes =  (($xl['totQty'] - $xl['soldQty']) * 100) / $xl['totQty'];
			}else if($xl['totQty']>0){
				$xlRes = 100;
			}else{
				$xlRes = 0;
			}
			
			$SQL4 = "SELECT distinct(productID),sum(soldQty) AS soldQty,sum(totQty) AS totQty FROM ".$DB->pre."qty WHERE size = 'xxl' AND productID = '".$productID."' GROUP BY productID";
			$xxl = $DB->dbRow($SQL4);
			if($xxl['soldQty']>0 && $xxl['totQty']>0){
				$xxlRes =  (($xxl['totQty'] - $xxl['soldQty']) * 100) / $xxl['totQty'];
			}else if($xxl['totQty']>0){
				$xxlRes = 100;
			}else{
				$xxlRes = 0;
			}
		  ?>
          <ul class="product-available">
            <h3>AVAILABILITY :</h3>
            <li class="Small">
              <label class="title">Small</label>
              <div bal="<?php echo $smallRes;?>">
                <p style="width:<?php echo $smallRes;?>%;"></p>
              </div>
            </li>
            <li class="Medium">
              <label class="title">Medium</label>
              <div bal="<?php echo $mediumRes;?>">
                <p style="width:<?php echo $mediumRes;?>%;"></p>
              </div>
            </li>
            <li class="Large">
              <label class="title">Large</label>
              <div bal="<?php echo $largeRes;?>">
                <p style="width:<?php echo $largeRes;?>%;"></p>
              </div>
            </li>
            <li class="XL">
              <label class="title">XL</label>
              <div bal="<?php echo $xlRes;?>">
                <p style="width:<?php echo $xlRes;?>%;"></p>
              </div>
            </li>
            <li class="XXL">
              <label class="title">XXL</label>
              <div bal="<?php echo $xxlRes;?>">
                <p style="width:<?php echo $xxlRes;?>%;"></p>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="scroll-bottom"> <a href="<?php echo getCatUrl($product["categoryID"]);?>"><img src="<?php echo SITEURL?>/images/btn-scroll-back.png" /></a> </div>
    </div>
  </div>
</div>
<script>
	$('ul#Products').bxGallery({
		maxwidth: '294',
		maxheight: '284',
		thumbwidth: '54',
		thumbheight: '54',
		thumbcrop: false,
		croppercent: '.35',
		thumbplacement: 'bottom',
		thumbcontainer: '',
		opacity: '.7',
		load_text: '',
		load_image: SITEURL+'/images/preloader.gif',
		wrapperclass: 'outer'
	});
</script>