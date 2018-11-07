<link rel="stylesheet" type="text/css" href="<?php echo SITEURL?>/inc/js/msdropdown/dd.css" />
<script type="text/javascript" src="<?php echo SITEURL?>/inc/js/msdropdown/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="<?php echo SITEURL?>/inc/js/msdropdown/js/jquery.dd.js"></script>
<script>
$(document).ready(function(){
try {
oHandler = $(".mydds").msDropDown().data("dd");
$("#ver").html($.msDropDown.version);
} catch(e) { alert("Error: "+e.message); }
});
</script>
<div class="home-spotlight"><img src="<?php echo SITEURL;?>/images/trash/shop-spotlight.jpg" /> </div>
<div class="shop-wrapp">
  <div class="sidebar">
    <h2>NU CATEGORIES</h2>
    <ul class="sidebar-nav">
     <?php echo getCatTree($parentID='0',$type="treelist");	?>
    </ul>
  </div>
  <div class="shop-conainer">
  	<?php
		$d = $TPL->data; 
		$MXSHOWREC = 1;
		$productID = $TPL->modID;
		$SQL = "SELECT * FROM ".$DB->pre."product WHERE status = '1' AND productID = '".$productID."'";
		$DB->dbRows($SQL);
		if($DB->numRows > 0){
			foreach($DB->rows as $product){ ?>
    <div class="product-details">
            <div class="social-net">
            <img src="images/trash/fb-like.png" />
            </div>
              <div class="product-view"> 
              <a href="#" class="img-box">
			  	<img src="<?php echo SITEURL.'/uploads/product/'.$product['productImg1'];?>" />
              </a>
                <ul class="thumbs">
                  <li><a href="#"><img src="<?php echo SITEURL.'/uploads/product/'.$product['productImg1'];?>" width="50" height="50" /></a></li>
                  <li><a href="#"><img src="<?php echo SITEURL.'/uploads/product/'.$product['productImg2'];?>" width="50" height="50" /></a></li>
                  <li><a href="#"><img src="<?php echo SITEURL.'/uploads/product/'.$product['productImg3'];?>" width="50" height="50" /></a></li>
                  <li><a href="#"><img src="<?php echo SITEURL.'/uploads/product/'.$product['productImg4'];?>" width="50" height="50" /></a></li>
                </ul>
              </div>
              <div class="product-description">
                <h2><?php $product["productTitle"];?></h2>
                <p><?php $product["synopsis"];?></p>
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
                  <a class="button" href="#" id="addCart"> <span>$24.99</span> </a>
                  <ul class="product-available">
                  <h3>AVAILABILITY :</h3>
                   <li><label class="title">Small</label>  <div><p style="width:30%;"></p></div></li>
                   <li><label class="title">Medium</label>  <div><p style="width:70%;"></p></div></li>
                   <li><label class="title">Large</label>  <div><p style="width:90%;"></p></div></li>
                  </ul>
                </div>
              </div>
              <div class="scroll-bottom">
               <a href="#"><img src="<?php echo SITEURL?>/images/btn-scroll-back.png" /></a>
              </div>
            </div>
           <?php	}
	}
?>
  </div>
</div>
</div>