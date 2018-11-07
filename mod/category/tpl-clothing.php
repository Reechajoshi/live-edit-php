<h1 class="title-nu-shop" style="width:75% !important;">Nu Shop</h1>
<?php require("inc/header-slider.php");?>
<div class="shop-wrapp">
  <div class="loader"></div>
  <div class="sidebar">
    <h2>NU CATEGORIES</h2>
    <ul class="sidebar-nav">
      <?php echo getCategoryMenu($TPL->data['parentID'],$TPL->data['categoryID']);?>
      <script>
      	$("a#nu-vip-membership").attr('href',SITEURL+"/user/vip-membership/");
		$(document).ready(function(){
			$('html, body').animate({ scrollTop: $('#showMiddle').offset().top }, 'fast');	
		});
      </script>
    </ul>
  </div>
  <div id="showMiddle"></div>
  <div class="shop-conainer">
    <h2><?php echo $TPL->data['categoryTitle']; ?></h2>
    <span class="subtitle"><?php echo $TPL->data['synopsis']; ?></span>
    <div class="product-list-wrapp" style="display:block;">
      <div class="scroll-pane">
        <ul class="product-list">
         <?php
		 $sql = 'SELECT productID FROM '.$DB->pre.'product WHERE status=1 AND categoryID="'.$TPL->data['categoryID'].'"';
		 $DB->dbQuery($sql);
    	 $MXTOTREC = $DB->numRows;
		 if($MXTOTREC > 0){
			$sql = "SELECT * FROM ".$DB->pre."product WHERE status=1 AND categoryID='".$TPL->data['categoryID']."'";
			$DB->dbRows($sql);
			$REC = $DB->dbRows($sql);
			if($REC){
			  foreach($REC as $d){ 
		 ?>
          <li>
            <div class="img-box"> <a href="<?php echo SITEURL.'/product/'.$d['seoUri'].'/'.$d['productID'].'/'; ?>"> <img src="<?php echo SITEURL; ?>/uploads/product/<?php echo $d['productImg1']; ?>" height="190" width="200"/> </a> </div>
            <span class="title">
            	<a href="<?php echo SITEURL.'/product/'.$d['seoUri'].'/'.$d['productID'].'/'; ?>">
					<?php echo $d['productTitle']; ?> | $<?php echo $d['productPrice']?>
                </a>
            </span>
            <p><?php echo limitChars($d['synopsis'],100); ?></p> 
            <a href="<?php echo SITEURL.'/product/'.$d['seoUri'].'/'.$d['productID'].'/'; ?>" class="button"> <span>BUY NOW</span> </a> 
            </li>
          <?php }
		  	}
		  }?>
        </ul>
      </div>
    </div>
  </div>
</div>
