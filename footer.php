</div>
 <div class="footer-wrapp">
		<div style="padding: 20px;" >
			<?php
				include( "inc_mg/google_translate/body.php" );
			?>
		</div>
        <div class="footer">
			
          <ul class="footer-nav">
            <?php /*?><li>
               <a href="<?php echo SITEURL;?>">Home</a>
            </li><?php */?>
             <?php echo getMenu("FOOTER");?> 
			<script>
			var SITEUSERID = "<?php echo $_SESSION['SITEUSERID'];?>";
			$("ul.footer-nav li.footer-register a").click(function(){
				// $(this).removeAttr('href');
				$('body,html').animate({scrollTop:0},0);
        	    if(!SITEUSERID){
					$("div#login-register-wrapp a.btn-close").hide();
					$("div.header-button").slideUp(200,function(){
						$("div#login-register-wrapp").slideDown(700,function(){
							$("div#login-register-wrapp a.btn-close").slideDown(200);
						});	
						$("div.login-wrapp").hide();
						$("div.register-wrapp").fadeIn();
					});
				}
	            return false;
            });
            </script>
            </ul>
            <ul class="social-footer">
            	<li><div class="fb-like" data-href="<?php echo SITEURL; ?>" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div></li>
            	<li><a href="http://www.twitter.com" target="_blank"><img src="<?php echo SITEURL;?>/images/twitter.png" /></a></li>
				<li><script src="//platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script><script type="IN/Share"></script></li>
            </ul>
          
          <p class="copy" style="font-size:<?php echo( getFooterMessage( "message02_font_size" ) ); ?>"><?php echo getFooterMessage( "message02" ); ?></p>
		  <p class="copy" style="margin-top: 5px; "><a href="#" style="font-size: 7pt; text-decoration: none; color: #565555;" onClick="showT(); return( false );" >Terms and Conditions</a>&#160;&#160;&#160;&#160;<a href="#" style="font-size: 7pt; text-decoration: none; color: #565555;" onClick="showP(); return( false );" >Privacy Policy</a></p>
        </div>
      </div>
      <div id="fb-root"></div>
<script type="text/javascript">
	window.fbAsyncInit = function() {
		FB.init({appId: '<?php echo APPID; ?>', status: true, cookie: true, xfbml: true, oauth  : true});		
					};
	(function() {
		var e = document.createElement("script");
		e.type = "text/javascript";
		e.src = document.location.protocol +"//connect.facebook.net/en_US/all.js";
		e.async = true;
		document.getElementById("fb-root").appendChild(e);
	}());
</script>

	</div>
</body>
</html>
