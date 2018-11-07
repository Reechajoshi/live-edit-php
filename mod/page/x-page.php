<div class="banner-730-90">
	<?php echo( getBanner( 'banner_ad_7_nu_prizes' ) ); ?>
</div>
<div class="editor-data">
	<div class="prize_img">
		<img src="<?php echo SITEURL?>/images/nu-prize.jpg" />
	</div>
  
<?php 
	$sql = "SELECT prize_desc FROM ".$DB->pre."prizes";
	$C = $DB->dbRow($sql);
	echo $C['prize_desc'];
?>
</div>
</div> <!-- CLOSE WRAPPER -->