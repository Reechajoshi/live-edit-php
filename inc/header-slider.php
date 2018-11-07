<link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>/inc/js/jslider/css/layout.css" />
<link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>/inc/js/jslider/css/style2.css" />
<style>
ul.lof-main-wapper li {
	position:relative;
}
</style>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/inc/js/jslider/js/jquery.easing.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/inc/js/jslider/js/script.js"></script>
<script type="text/javascript">
$(document).ready( function(){	
	$("ul.sliders-wrap-inner li:first").css("position","");
	$('#jslidernews2').lofJSidernews( { interval:5000,
		easing:'easeInOutQuad',
		direction:"opacity",
		duration:1200,
		auto:true,
		mainWidth:698,
		mainHeight:350,
		navigatorHeight: 120,
		navigatorWidth: 255,
		maxItemDisplay:3
	});
});
</script>
<div class="home-spotlight">
  <div id="container">
    <div id="jslidernews2" class="lof-slidecontent" style="width:948px; height:350px;">
      <div class="preload">
        <div></div>
      </div>
      <div class="main-slider-content" style="width:698px; height:350px;">
        <ul class="sliders-wrap-inner">
		<?php
			if($TPL->pageType == "home"){ $categoryID = 7;}else{ $categoryID = 8; }
			
			$sql = "SELECT G.*,GC.galleryID,GC.categoryID,C.categoryTitle FROM `".$DB->pre."gallery` AS G LEFT JOIN ".$DB->pre."gallery_category AS GC ON(G.galleryID=GC.galleryID) LEFT JOIN ".$DB->pre."category AS C ON(C.categoryID=GC.categoryID) WHERE G.status =1 AND GC.categoryID='".$categoryID."';";
			$D = $DB->dbRows($sql);
			if($DB->numRows > 0){
				foreach($DB->rows as $val){ 
					//if($TPL->pageType == "home"){ $linkUrl = ""; }else{	$linkUrl = makeSeoUri($val['galleryTitle']);}
		?>
          <li style="position:absolute;">
          	<a href="<?php echo $val['galleryLink']; ?>">
            	<img src="<?php echo SITEURL.'/core/image.inc.php?path=gallery/'.$val['imageName'].'&w=698&h=350&type=crop';?>" title="Newsflash 2" >
            </a>
          </li>
        <?php		
				}
			}
	   ?>
        </ul>
      </div>
      <div class="navigator-content">
        <div class="navigator-wrapper">
          <ul class="navigator-wrap-inner">
          <?php
			$sql = "SELECT G.*,GC.galleryID,GC.categoryID,C.categoryTitle FROM `".$DB->pre."gallery` AS G LEFT JOIN ".$DB->pre."gallery_category AS GC ON(G.galleryID=GC.galleryID) LEFT JOIN ".$DB->pre."category AS C ON(C.categoryID=GC.categoryID) WHERE G.status =1 AND GC.categoryID='".$categoryID."';";
			$D = $DB->dbRows($sql);
			if($DB->numRows > 0){
				foreach($DB->rows as $val){ 
					//if($TPL->pageType == "home"){ $linkUrl = ""; }else{	$linkUrl = makeSeoUri($val['galleryTitle']);}
		   ?>
            <li>
              <div>
                <h3><a href="#"><?php echo $val['galleryTitle'];?></a></h3>
                <div class="editable" id="gallery-<?php echo( $val['galleryID'] ) ?>" ><?php echo limitChars($val['synopsis'],100);?></div>
                <?php if($val['galleryLink']){ ?>
                <a href="<?php echo $val['galleryLink'];?>" class="btn-signupnow"><?php echo $val['galleryLinkName'];?></a> 
                <?php } ?>
              </div>
            </li>
            <?php		
				}
			}
	       ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
