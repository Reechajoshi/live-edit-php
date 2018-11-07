<div class="banner-730-90">
	<?php echo( getBanner( 'banner_ad_2_nu_cards' ) ); ?>
</div>

<div class="about-wrapp">
  <div style="height: 50px;" ><h1><?php echo $TPL->data['pageTitle'];?></h1></div>
	<div class="editable" id="page-2" >
		<?php echo $TPL->data['pageContent'];?>
	</div>	
	
	<?php
		if( strlen( $TPL->data['videoLink'] ) > 0 )
		{
			list( , $videocode ) = explode( "v=", $TPL->data['videoLink'] );
			list( $videocode ) = explode( "&", $videocode );
			
			echo( '<div style="text-align: center;"> <iframe width="391" height="208" src="http://www.youtube.com/embed/'.$videocode.'?&autoplay=1&autohide=1&rel=0" frameborder="0" allowfullscreen > </iframe></div>' );
		}
	?>
	
	<?php
		/* RETRIEVE HOW TO PLAY STEPS DESCRIPTION */
		getNUCardsSteps( 'page', &$title_arr, &$desc_arr );
		
		$buy_pack_btn_details = getButtons( "buy_pack", "nu_cards" );	
		$how_to_play_btn_details = getButtons( "how_to_play", "nu_cards" );	
		
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
    <!-- <div class="step-1">
      <h2>-- Step 1 --</h2>
      <h3>50 cards • 5 Suits • 10 cards per suit numbered 0 - 49</h3>
      <img src="<?php //echo SITEURL;?>/images/img-about-popup-step1.jpg"> </div>
    <div class="step-4">
      <h2>-- Step 4 --</h2>
      <h3>There are 2 numbers on each card A HIGH Number and <span>LOW Number</span></h3>
      <img height="135" src="<?php //echo SITEURL;?>/images/img-about-popup-step4.jpg">
      <h4>The <span>LOW Number</span> is the last digit of the HIGH Number</h4>
    </div>
    <div class="step-2">
      <h2>-- Step 2 --</h2>
      <h3>5 'Decade' suits</h3>
      <table width="274" cellspacing="2" cellpadding="4" border="0" bgcolor="#000">
        <tbody>
          <tr>
            <td bgcolor="#FFFFFF">SINGLES</td>
            <td bgcolor="#FFFFFF"><code>0</code> - 9</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">TEENs</td>
            <td bgcolor="#FFFFFF"><code>10</code> - 19</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">TWENTIES</td>
            <td bgcolor="#FFFFFF"><code>20</code> - 29</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">THIRTIES</td>
            <td bgcolor="#FFFFFF"><code>30</code> - 39</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">FORTIES</td>
            <td bgcolor="#FFFFFF"><code>40</code> - 49</td>
          </tr>
        </tbody>
      </table>
      <h3>10 cards per suit</h3>
    </div>
    <div class="step-5">
      <h2>-- Step 5 --</h2>
      <h3>There are 5 of each <span>LOW Number:</span><br>
        <a href="#">0,</a> <a href="#">1,</a> <a href="#">2,</a> <a href="#">3,</a> <a href="#">4,</a> <a href="#">5,</a> <a class="active" href="#">6,</a> <a href="#">7,</a> <a href="#">8,</a> <a class="active" href="#">9</a></h3>
      <img src="<?php //echo SITEURL;?>/images/img-about-popup-II-step5.jpg"> </div>
    <div class="step-3">
      <h2>-- Step 3 --</h2>
      <img src="<?php //echo SITEURL;?>/images/img-about-popup-II-step3.jpg"> </div>-->
  </div>
  <div class="playing-card">
    <div class="playing-card-details">
      <h1>NU PLAYING CARDS</h1>
      <div><?php echo $TPL->data['synopsis'];?></div>
      <!-- <a class="btn-gray" href="<?php // echo SITEURL.'/how-to-play/';?>">How to play</a> -->
	  <a class="btn-gray <?php echo( $how_to_play_btn_details["color"] ); ?>" href="<?php echo $how_to_play_btn_details["color"];?>"><?php echo $how_to_play_btn_details["button_txt"];?></a>
	  <!-- <a class="button" href="<?php // echo SITEURL.'/shop/nu-playing-cards/';?>">BUY A PACK NOW !</a> -->
	  <a class="button <?php echo( $buy_pack_btn_details["color"] );?>" href="<?php echo( $buy_pack_btn_details["link"] );?>"><?php echo( $buy_pack_btn_details["button_txt"] );?></a>
	  </div>
    <img class="playing-card" src="<?php echo SITEURL;?>/images/nu-about-playing-card.jpg"> </div>
</div>
