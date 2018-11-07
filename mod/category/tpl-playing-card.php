<script type="text/javascript" src="<?php echo SITEURL;?>/lib/js/jscrollpane/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/lib/js/jscrollpane/jquery.jscrollpane.min.js"></script>
<link type="text/css" href="<?php echo SITEURL;?>/lib/js/jscrollpane/jquery.jscrollpane.css" rel="stylesheet" media="all" />
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$('.scroll-pane').jScrollPane();
	$("ul.list li:last").addClass('last');
	$('html, body').animate({ scrollTop: $('#showMiddle').offset().top }, 'fast');	
});
</script>
<h1 class="title-nu-shop" style="width:75% !important;">Nu Shop</h1>
<?php require("inc/header-slider.php");?>
<!--<div class="home-spotlight"><img src="<?php echo SITEURL;?>/images/trash/shop-spotlight.jpg" /> </div>-->
<div class="shop-wrapp">
  <div class="loader"></div>
  <div class="sidebar">
    <h2>NU CATEGORIES</h2>
    <ul class="sidebar-nav">
      <?php echo getCategoryMenu($TPL->data['parentID'],$TPL->data['categoryID']);?>
      <script>
      	$("a#nu-vip-membership").attr('href',SITEURL+"/user/vip-membership/");
      </script>
    </ul>
  </div>
  <div id="showMiddle"></div>
  <div class="shop-conainer">
	<?php
	$sql = "SELECT P.*, C.categoryTitle FROM ".$DB->pre."product P LEFT JOIN ".$DB->pre."category AS C ON(P.categoryID=C.categoryID) WHERE P.status=1 AND P.categoryID = '".$TPL->data['categoryID']."'";
	$DB->dbRows($sql);
	if($DB->numRows > 0){
	$REC = $DB->dbRows($sql);	
		foreach($REC as $d){ 
	?>	
     <h2>NU PLAYING CARDS | $<?php echo $d['productPrice']?></h2>
    	<div class="playing-cards-section">
      <div class="img-box" style="width:640;height:320px">
      	<img src="<?php echo SITEURL?>/core/image.inc.php?path=product/<?php echo $d['productImg1'];?>&w=640&h=320&type=crop" />
      </div>
      <p><?php echo $d['description'];?></p>
      
	<!-- <a class="button addCart" producttype="<?php // echo makeSeoUri($d['categoryTitle']);?>" href="#"  rel="<?php // echo $d['productID']?>"> BUY NOW</a> -->
   </div>
	<?php
      	}
	}
    ?>
  </div>
</div>
