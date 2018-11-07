<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/mod/home/x-home.inc.js"></script>
<?php require("inc/header-slider.php");?>

<?php
	getBrowserUpdateMsg( $DB_browser, $msg_title, $msg_content, $latest_ver );
	
	$browser = new Browser();
	$browser_name = $browser->getBrowser();
	$browser_version = $browser->getVersion();
	$browser_message = "";
	for( $i = 0; $i < count( $DB_browser ); $i++ )
	{
		if( ( $DB_browser[ $i ] != "Internet Explorer" ) && ( $browser_name == $DB_browser[ $i ] ) && ( $browser_version != $latest_ver[ $i ] ) )
		{
			$heading = $msg_title[ $i ];
			$browser_message = $msg_content[ $i ];
		}
		else if( $DB_browser == "Internet Explorer" )
		{
			$heading = $msg_title[ $i ];
			$browser_message = $msg_content[ $i ];
		}
	}
	
	if( $browser_message != "" ) // if user is using old browser or ie then display message
	{
		echo( "
		<script type='text/javascript'>
		showMsg( 'Browser Update', '$browser_message' );
		</script>
		" ); 
	}
	
?>

<div class="product-list-wrapp">
  <h2 class="product-list-title"><span class="text-gradiant"></span>From the NU SHOP</h2>
  <ul class="product-list">
  <?php
  $sql = "SELECT * FROM ".$DB->pre."middle_gallery WHERE status = 1 LIMIT 3 ";
  $DB->dbRows($sql);
  
  $home_page_btn_details[0] = getButtons( "button_01", "home_page" );
  $home_page_btn_details[1] = getButtons( "button_02", "home_page" );
  $home_page_btn_details[2] = getButtons( "button_03", "home_page" );
  
  if($DB->numRows > 0){
	  // foreach($DB->rows as $d)
	  for( $i = 0; $i < count( $DB->rows ); $i++ )
	  {
		$d = $DB->rows[ $i ];
		echo( '<li>
      <div class="img-box"><img src="'.SITEURL.'/core/image.inc.php?path=middle_gallery/'.$d['imageName'].'&w=294&h=190&type=ratio" /></div>
      <img class="img-icon" src="'.SITEURL.'/core/image.inc.php?path=middle_gallery/'.$d['iconImage'].'&w=294&h=40&type=ratio" /> <span class="title">'.$d['middleGalTitle'].'</span>
      <p class="editable" id="middle_gallery-'.$d['middleGalID'].'" >'.limitChars($d['middleGalDescription'],100).'</p>
      <!-- <a href="'.SITEURL.$d['btnLink'].'" class="button editable" id="middle_gallery-'.$d['middleGalID'].'-2" > '.$d['btnName'].' </a>  -->
	  <a href="'.SITEURL.$home_page_btn_details[$i]["link"].'" class="button '.$home_page_btn_details[ $i ][ "color" ].'" id="middle_gallery-'.$d['middleGalID'].'-2" > '.$home_page_btn_details[$i]["button_txt"].' </a> 
	  </li>' );
	  }
  }
  ?>
  </ul>
</div>
<div class="video-wrapp">
  <ul class="video-list">
    <?php
	$sql = "SELECT * FROM ".$DB->pre."video WHERE status = 1 ORDER BY dateAdded ASC LIMIT 2";
	$D = $DB->dbRows($sql);
	if($DB->numRows > 0){
		$cnt = 1;
		foreach($DB->rows as $val){ 
			if($val['videoLink']){
				$videoLink = parse_youtube_url($val['videoLink'],'');
			} 
	?>
    <li> <a href="#" class="img-box" id="img-box-<?php echo( $cnt ); ?>" rel="<?php echo $videoLink;?>"> <img style="width:100%;height:100%;" src="<?php echo SITEURL;?>/uploads/video/<?php echo $val['videoImage'];?>" /> </a> <span class="title"><?php echo $val['videoTitle']; ?></span>
      <p style="cursor: pointer;" onClick="$( '#img-box-<?php echo( $cnt ); ?>' ).click();" ><?php echo $val['synopsis']; ?></p>
      <a href="#" class="btn-watch-video" onClick="$( '#img-box-<?php echo( $cnt ); ?>' ).click();return(false);" ><p id="texts-MORE_VIDEO_TEXT_<?php echo( $cnt ); ?>" class="editable" ><?php echo( getMoreVideoText( $cnt ) ); ?></p></a> </li>
    <?php $cnt++; }
	}?>
  </ul>
</div>
<div class="banner-730-90">
	<?php echo( getBanner( 'banner_ad_1_home' ) ); ?>
</div>
