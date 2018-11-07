<script>
$(document).ready(function(){
	$("ul.sidebar-nav li:first a").addClass('active');
	$("div.loader").show();
	var htpID = $('ul.sidebar-nav li:first a').attr('rel');	
	var aUrl = SITEURL+"/mod/page/x-page.inc.php";
	dataString = "xAction=GetHowTOPlay&HTPID="+htpID;
	$.ajax({
		type: 'post',
		url: aUrl,
		data: dataString,
		success: function(data){
			$("div.loader").hide();
			$('div.game-about').html(data);
			
			Aloha.jQuery('.editable').aloha();
		}
	});	
	
	$('ul.sidebar-nav li a.game-title').click(function(){
		$("div.loader").show();
		var htpID = $(this).attr('rel');	
		var aUrl = SITEURL+"/mod/page/x-page.inc.php";
		dataString = "xAction=GetHowTOPlay&HTPID="+htpID;
		$.ajax({
			type: 'post',
			url: aUrl,
			data: dataString,
			success: function(data){
				$("div.loader").hide();
				$('ul#how-to-play-games li').css('display','block');
				$('div.game-about').html(data);
				
				Aloha.jQuery('.editable').aloha();
			}
		});
	});
});
</script>

<div class="banner-730-90">
	<?php echo( getBanner( 'banner_ad_6_how_to_play' ) ); ?>
</div>
<div class="how-to-play-info-wrapp">
  <div class="game-instruction" >
    <div style="height: 50px;" ><h1>HOW TO PLAY NU GAMES</h1></div>
	<div class="editable" id="page-4" >	
		<?php 
		$sql = "SELECT pageContent FROM ".$DB->pre."page WHERE status = 1 AND pageID = 4";
		$C = $DB->dbRow($sql);
		echo $C['pageContent'];
		?>
	</div>	
  </div>
</div>
<div class="shop-wrapp no-margin">
  <div class="sidebar">
    <h2>NU GAMES</h2>
    <ul class="sidebar-nav">
      <?php 
	  $k = 0;
	  $sql = "SELECT HTPID, HTPGameTitle FROM ".$DB->pre."how_to_play WHERE status = '1' ORDER BY HTPID ASC";
	  $DB->dbRows($sql);
	  if($DB->numRows > 0){
		  foreach($DB->rows as $d){
	  ?>
      <li><a class="game-title" rel="<?php echo $d['HTPID'];?>" href="#"><?php echo $d['HTPGameTitle'];?></a></li>
      <?php
		  }
	  }
	  ?>
    </ul>
  </div>
  <div class="shop-conainer">
    <ul id="how-to-play-games">
      <li>
        <div class="game-about"> </div>
      </li>
    </ul>
  </div>
  <div class="horizontaly-shadow"></div>
  
  <?php
		/* RETRIEVE HOW TO PLAY STEPS DESCRIPTION */
		getNUCardsSteps( 'page', &$title_arr, &$desc_arr );
  ?>
  
  <div class="about-container">
    <h1>NU PLAYING CARDS&reg;</h1>
	<div class="step-1">
      <h2>-- <?php echo( $title_arr[ 0 ] ); ?> --</h2>
      <?php echo( $desc_arr[ 0 ] ); ?>
	</div>
    <div class="step-4">
      <h2>-- <?php echo( $title_arr[ 3 ] ); ?> --</h2>
      <?php echo( $desc_arr[ 3 ] ); ?>
    </div>
    <div class="step-2">
      <h2>-- <?php echo( $title_arr[ 1 ] ); ?> --</h2>
      <?php echo( $desc_arr[ 1 ] ); ?>
	</div>
    <div class="step-5">
      <h2>-- <?php echo( $title_arr[ 4 ] ); ?> --</h2>
      <?php echo( $desc_arr[ 4 ] ); ?>
	</div>
    <div class="step-3">
      <h2>-- <?php echo( $title_arr[ 2 ] ); ?> --</h2>
      <?php echo( $desc_arr[ 2 ] ); ?>
    </div>
   
  </div> 
  </div>
</div>
<script language="javascript" type="text/javascript">
$(document).ready(function(e) {
    $("ul#how-to-play-games li:first").fadeIn();
	$("ul.sidebar-nav a").click(function(){
		$("ul.sidebar-nav a").removeClass("active");
		$(this).addClass("active");
		var index = $("ul.sidebar-nav a").index(this);
		$("ul#how-to-play-games li").hide();
		$("ul#how-to-play-games li").eq(index).fadeIn();
		return false;	
	});
	<?php
		if( isset( $_GET[ 'i' ] ) )
		{
			echo( '$("ul.sidebar-nav a[rel='.$_GET[ 'i' ].']").click();' );
		}
	?>
	
});
</script> 