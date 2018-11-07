<?php
	header( "Content-Type: text/css" );
	
	require( "../connectdb.inc.php" );
	$_q = "select f from fonts;";
	
	$DB->dbRows( $_q );
	
	$_font = false;
	
	$all_fonts = array( "Georgia" => array( "Conv_georgia", "georgia" ), 
						"Times New Roman" => array( "Conv_times", "times" ), 
						"Bauhaus 93" => array( "Conv_BAUHS93", "BAUHS93" ), 
						"Tahoma" => array( "Conv_tahoma", "tahoma" ),
						"Arial" => array( "Conv_arial", "arial" )
						);
	
	if( $DB->numRows > 0 )
	{
		$rows = $DB->rows;
		foreach($rows as $r) {
			$__f = $r[ 'f' ];
			
			if( isset( $all_fonts[ $__f ] ) )
			{
				// if( strpos( $__f, " " ) !== false )
					// $_f = "'$__f'";
				// else
					// $_f = $__f;
					
				if( $_font !== false )	
					$_font .= ", ".$all_fonts[ $__f ][ 0 ];
				else
					$_font .= $all_fonts[ $__f ][ 0 ];
					
				echo( "
				@font-face {
					font-family: '".$all_fonts[ $__f ][ 0 ]."';
					src: url('fonts/".$all_fonts[ $__f ][ 1 ].".eot');
					src: url('fonts/".$all_fonts[ $__f ][ 1 ].".woff') format('woff'), url('fonts/".$all_fonts[ $__f ][ 1 ].".ttf') format('truetype'), url('fonts/".$all_fonts[ $__f ][ 1 ].".svg') format('svg');
					font-weight: normal;
					font-style: normal;
				}
				
				" );
			}	
		}
	}
	
	echo( "html{float:left; width:100%; margin:0px; padding:0px; background:url(../images/main-bg.png) repeat;}
body{float:left; width:100%; margin:0px; padding:0px; font-family:".$_font." !important; font-size-adjust:0.488;  font-size:12px; color:#000; background:url(../images/main-nav-bg.png) repeat-x top;}
div,ul,ol,li,p,span,img,code,label,a,h1,h2,h3,h4,h5,h6{margin:0px; padding:0px; text-decoration:none; list-style:none; outline:none; border:0px; font-family:".$_font." !important;}
input,textarea,select{outline:none; font-family:".$_font." !important;;}
em{color:#F00; font-family:".$_font." !important;;}
h1{font-size:36px; font-size-adjust:0.488; font-weight:normal; font-family:".$_font." !important;; }
h2{font-size:28px; font-size-adjust:0.488; font-weight:normal; font-family:".$_font." !important;; }
h3{font-size:15.5px; font-size-adjust:0.488; font-weight:normal; font-family:".$_font." !important;; }
input.button{display:inline-block; height:34px; line-height:34px; font-size:13px; color:#fff;  font-size-adjust:0.488;background:#50c8ea; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; padding:0px 20px 4px; border:0; cursor:pointer; text-transform:uppercase;}
a.button-II{float:left; height:32px; color:#FFF; font-size:13px; text-transform:uppercase; text-align:center; line-height:32px; background:#b3b3b3; padding:0px 32px; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px;  font-size-adjust:0.488;}
input.text,textarea.text{float:left; min-width:275px; height:34px; border:1px solid #e5e5e5; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; padding:0px 10px; color:#565555; font-size:14px; }
textarea.text{width:628px; height:85px; padding:10px; }
code{ font-size-adjust:0.488;}
div.common-message{float:left; width:460px; padding:10px; color:#FFF; background:#cd3333; text-align:center; font-weight:bold; position:fixed; left:50%; top:0px; margin-left:-240px; z-index:10000; moz-border-radius:0px 0px 5px 5px; -webkit-border-radius:0px 0px 5px 5px; border-radius:0px 0px 5px 5px;}
div.common-message p{float:left; width:100%;}
span.text-gradiant{float:left; width:100%; height:17px; background:url(../images/text-grediant.png) repeat-x bottom; position:absolute; left:0px; top:6px;}
span.text-gradiant01{float:left; width:100%; height:17px; background:url(../images/text-grediant.png) repeat-x bottom; position:absolute; left:0px; top:6px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
a.button,input.button-red{display:inline-block; padding:0px 18px; height:30px; line-height:27px; border:1px solid #8e1818; -moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; color:#fff;  font-size-adjust:0.488; text-transform:uppercase; font-size:14px; text-align:center; text-shadow:0px 2px 0px #7c0202;
box-shadow:0px 0px 1px #e44b4b inset,0px 0px 0px 4px #f0f0f0;
-webkit-box-shadow:0px 0px 1px #e44b4b inset,0px 0px 0px 4px #f0f0f0;
-moz-box-shadow:0px 0px 1px #e44b4b inset,0px 0px 0px 4px #f0f0f0;
background:#dd2020; /* Old browsers */
background:-moz-linear-gradient(top, #dd2020 24%, #b31919 100%); /* FF3.6+ */
background:-webkit-gradient(linear, left top, left bottom, color-stop(24%,#dd2020), color-stop(100%,#b31919)); /* Chrome,Safari4+ */
background:-webkit-linear-gradient(top, #dd2020 24%,#b31919 100%); /* Chrome10+,Safari5.1+ */
background:-o-linear-gradient(top, #dd2020 24%,#b31919 100%); /* Opera 11.10+ */
background:-ms-linear-gradient(top, #dd2020 24%,#b31919 100%); /* IE10+ */
background:linear-gradient(to bottom, #dd2020 24%,#b31919 100%); /* W3C */
filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#dd2020', endColorstr='#b31919',GradientType=0 ); /* IE6-9 */}
input.button-red{padding-bottom:6px; cursor:pointer;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
a.btn-gray{display:inline-block; padding:0px 18px; height:30px; line-height:27px; border:1px solid #888; -moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; color:#fff;  font-size-adjust:0.488; text-transform:uppercase; font-size:14px; text-align:center; text-shadow:0px 2px 0px #4a4a4a;
box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #1d1d1d;
-webkit-box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #1d1d1d;
-moz-box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #1d1d1d;
background:rgb(195,195,195); /* Old browsers */
background:-moz-linear-gradient(top, rgba(195,195,195,1) 0%, rgba(103,103,103,1) 74%); /* FF3.6+ */
background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(195,195,195,1)), color-stop(74%,rgba(103,103,103,1))); /* Chrome,Safari4+ */
background:-webkit-linear-gradient(top, rgba(195,195,195,1) 0%,rgba(103,103,103,1) 74%); /* Chrome10+,Safari5.1+ */
background:-o-linear-gradient(top, rgba(195,195,195,1) 0%,rgba(103,103,103,1) 74%); /* Opera 11.10+ */
background:-ms-linear-gradient(top, rgba(195,195,195,1) 0%,rgba(103,103,103,1) 74%); /* IE10+ */
background:linear-gradient(to bottom, rgba(195,195,195,1) 0%,rgba(103,103,103,1) 74%); /* W3C */
filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#c3c3c3', endColorstr='#676767',GradientType=0 ); /* IE6-9 */}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
a.btn-yellow{display:inline-block; padding:0px 18px; height:30px; line-height:27px; border:1px solid #a69039; -moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; color:#fff;  font-size-adjust:0.488; text-transform:uppercase; font-size:14px; text-align:center; text-shadow:0px 2px 0px #9b8012;
box-shadow:0px 0px 1px #e0c461 inset,0px 0px 0px 4px #f0f0f0;
-webkit-box-shadow:0px 0px 1px #e44b4b inset,0px 0px 0px 4px #f0f0f0;
-moz-box-shadow:0px 0px 1px #e44b4b inset,0px 0px 0px 4px #f0f0f0;
background:#f1de91; /* Old browsers */
background:-moz-linear-gradient(top, #f1de91 0%, #d5bb53 74%); /* FF3.6+ */
background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#f1de91), color-stop(74%,#d5bb53)); /* Chrome,Safari4+ */
background:-webkit-linear-gradient(top, #f1de91 0%,#d5bb53 74%); /* Chrome10+,Safari5.1+ */
background:-o-linear-gradient(top, #f1de91 0%,#d5bb53 74%); /* Opera 11.10+ */
background:-ms-linear-gradient(top, #f1de91 0%,#d5bb53 74%); /* IE10+ */
background:linear-gradient(to bottom, #f1de91 0%,#d5bb53 74%); /* W3C */
filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#f1de91', endColorstr='#d5bb53',GradientType=0 ); /* IE6-9 */}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
a.btn-dark-yellow{display:inline-block; padding:0px 18px; height:30px; line-height:27px; border:1px solid #a88710; -moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; color:#000;  text-transform:uppercase; font-size:14px; text-align:center; text-shadow:0px 2px 0px #ffe400;
box-shadow:0px 0px 1px #fccd3c inset,0px 0px 0px 4px #f0f0f0;
-webkit-box-shadow:0px 0px 1px #fccd3c inset,0px 0px 0px 4px #f0f0f0;
-moz-box-shadow:0px 0px 1px #fccd3c inset,0px 0px 0px 4px #f0f0f0;
background:rgb(251,219,6); /* Old browsers */
background:-moz-linear-gradient(top, rgba(251,219,6,1) 0%, rgba(252,184,0,1) 74%); /* FF3.6+ */
background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(251,219,6,1)), color-stop(74%,rgba(252,184,0,1))); /* Chrome,Safari4+ */
background:-webkit-linear-gradient(top, rgba(251,219,6,1) 0%,rgba(252,184,0,1) 74%); /* Chrome10+,Safari5.1+ */
background:-o-linear-gradient(top, rgba(251,219,6,1) 0%,rgba(252,184,0,1) 74%); /* Opera 11.10+ */
background:-ms-linear-gradient(top, rgba(251,219,6,1) 0%,rgba(252,184,0,1) 74%); /* IE10+ */
background:linear-gradient(to bottom, rgba(251,219,6,1) 0%,rgba(252,184,0,1) 74%); /* W3C */
filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#fbdb06', endColorstr='#fcb800',GradientType=0 ); /* IE6-9 */}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
a.btn-blue{display:inline-block; padding:0px 18px; height:30px; line-height:27px; border:1px solid #30a7c8; -moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; color:#fff;  text-transform:uppercase; font-size:14px; text-align:center; text-shadow:0px 2px 0px #1988a8;
box-shadow:0px 0px 1px #88def8 inset,0px 0px 0px 4px #f0f0f0;
-webkit-box-shadow:0px 0px 1px #88def8 inset,0px 0px 0px 4px #f0f0f0;
-moz-box-shadow:0px 0px 1px #88def8 inset,0px 0px 0px 4px #f0f0f0;
background:rgb(84,213,250); /* Old browsers */
background:-moz-linear-gradient(top, rgba(84,213,250,1) 0%, rgba(80,200,234,1) 74%); /* FF3.6+ */
background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(84,213,250,1)), color-stop(74%,rgba(80,200,234,1))); /* Chrome,Safari4+ */
background:-webkit-linear-gradient(top, rgba(84,213,250,1) 0%,rgba(80,200,234,1) 74%); /* Chrome10+,Safari5.1+ */
background:-o-linear-gradient(top, rgba(84,213,250,1) 0%,rgba(80,200,234,1) 74%); /* Opera 11.10+ */
background:-ms-linear-gradient(top, rgba(84,213,250,1) 0%,rgba(80,200,234,1) 74%); /* IE10+ */
background:linear-gradient(to bottom, rgba(84,213,250,1) 0%,rgba(80,200,234,1) 74%); /* W3C */
filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#54d5fa', endColorstr='#50c8ea',GradientType=0 ); /* IE6-9 */}
/*~~~~~~~~~~~~~~~BANNER~~~~~~~~~~~~~~~*/
div.banner-730-90{float:left; width:730px; height:90px; background:url(../images/bg-banner-730-90.png) no-repeat; position:relative; left:50%; margin:32px 0px 0px -365px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div#main-wrapper{float:left; width:100%; background:url(../images/main-top-bg.png) no-repeat center top;}
div#wrapper{float:left; width:960px; position:relative; left:50%; margin-left:-475px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div#header{ z-index: 99;  float:left; width:100%; min-height:151px; position:relative;}
div#header a.logo{float:left; margin-left:-3px;}
ul#main-nav{float:right; background:url(../images/main-nav-sep.png) no-repeat left; padding-left:2px;}
ul#main-nav li{float:left; height:100px; position:relative;}
ul#main-nav li a{float:left; height:100px; line-height:100px; padding:0px 32px 0px 30px; background:url(../images/main-nav-sep.png) no-repeat right; color:#FFF;  font-size:14px; position:relative; left:0px; top:0px;}
ul#main-nav li a:hover,ul#main-nav li a.active{background:url(../images/main-nav-over.png) no-repeat center top; z-index:11; text-shadow:0px 2px 0px #000;}
/*ul#main-nav li a.active{cursor:default;}*/
/*ul#main-nav li.show-games { background:url(../images/main-nav-over.png) no-repeat center top; }*/
ul#main-nav li.show-games a:hover,
ul#main-nav li.show-games a.active1,
ul#main-nav li.show-games a.active{/*height:118px;*/ background:url(../images/main-nav-over.png) no-repeat center top; z-index:11; text-shadow:0px 2px 0px #000; }
ul#main-nav li.show-nucards a:hover,
ul#main-nav li.show-nucards a.active{/*height:118px;*/ z-index:11; text-shadow:0px 2px 0px #000;}

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.top-nav{float:left; /*min-width:250px;*/ position:absolute; right:0px; top:100px; z-index:10; -moz-box-shadow:0px 2px 5px rgba(0, 0, 0, 0.4); -webkit-box-shadow:0px 2px 5px rgba(0, 0, 0, 0.4); box-shadow:0px 2px 5px rgba(0, 0, 0, 0.4);}
div.top-nav ul.user-nav{display:block; width:100%; background:#fff;}
div.top-nav ul.user-nav li{display:block; width:100%;}
div.top-nav ul.user-nav li a{display:block; width:100%; height:36px; line-height:36px; font-size:14px; color:#808080; text-transform:uppercase; text-align:center;  border-top:1px solid #ebeaea;}
div.top-nav ul.user-nav li a:hover{opacity:0.8;}
div.top-nav ul.user-nav li a img{position:relative; top:4px; margin-right:10px;}
div.header-button{float:left; min-width:160px; height:44px; background:url(../images/bg-btn-top.png) repeat-x; color:#FFF;  font-size:16px; text-transform:uppercase; padding:0px 10px; text-shadow:0px 2px 2px #7c0202; clear:both; }
div.header-button a.name{float:left; min-width:150px; color:#FFF; text-transform:uppercase;}
div.header-button a.btn-cart{float:right; font-size:16px;  background:url(../images/cart-icon.png) no-repeat left; padding-left:30px; color:#FFF; margin-left:10px;}
div.header-button a.btn-arrow{float:right; width:19px; height:24px; margin:12px 0px 0px 10px; background:url(../images/arrow-down.png) no-repeat;}
div.header-button a#withOutLogin{display:none;}
div.header-button a.btn-arrow.active{background:url(../images/arrow-up.png) no-repeat;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div#login-register-wrapp{float:left; width:798px; position:absolute; z-index:100; right:0px; top:100px; padding:0px 0px 45px;}
div.login-register-wrapp-inside{float:left; width:718px; background:#fff; overflow:hidden; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1); padding:25px 40px 10px;}
div#login-register-wrapp a.btn-close-II{ float:left; position:absolute; top:5px; right:5px;}
div#login-register-wrapp a.btn-close{float:left; width:250px; height:45px; background:url(../images/btn-close.png) repeat-x; position:absolute; right:0px; bottom:0px; text-align:center; font-size:16px; line-height:45px; color:#FFF;  text-shadow:0px 2px 2px #7c0202; -moz-box-shadow:0px 2px 5px rgba(0, 0, 0, 0.4); -webkit-box-shadow:0px 2px 5px rgba(0, 0, 0, 0.4); box-shadow:0px 2px 5px rgba(0, 0, 0, 0.4);}
div#login-register-wrapp div.btn-connect-fb{float:left; position:relative; left:50%; margin-left:-160px; cursor:pointer;}
div#login-register-wrapp p.login-register-copy{float:left; width:100%; font-size:16px; line-height:17px; margin-top:15px; padding-bottom:18px; border-bottom:1px solid #d9d9d9;}
div#login-register-wrapp div.loader{float:left; width:100%; height:425px; opacity:0.9; position:absolute; left:0px; top:0px; z-index:2; background:url(../images/loader.gif) no-repeat center #fff; display:none;}
div.register-wrapp{float:left; width:100%;}
div.register-wrapp h1{float:left; width:100%; margin:20px 0px ; text-align:center;}
div.register-wrapp ul.register-form{float:left; width:790px; position:relative;}
div.register-wrapp ul.register-form li{float:left; width:322px; min-height:66px; margin:10px 73px 0px 0px;}
div.register-wrapp ul.register-form li input{float:left; width:254px; height:38px; color:#b3b3b3; padding:0px 10px 0px 56px; border:1px solid #e5e5e5; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; position:relative; z-index:1;}
div.register-wrapp ul.register-form li input.email{background:url(../images/email-icon.png) no-repeat left center #fff;}
div.register-wrapp ul.register-form li input.user{background:url(../images/user-icon.png) no-repeat left center #fff;}
div.register-wrapp ul.register-form li input.password{background:url(../images/password-icon.png) no-repeat left center #fff;}
div.register-wrapp ul.register-form li input.confirm-password{background:url(../images/password-icon.png) no-repeat left center #fff;}
div.register-wrapp ul.register-form li p.e{float:left; width:282px; padding:6px 20px 6px; background:#ea6b6b; color:#913535; -moz-border-radius:0px 0px 4px 4px; -webkit-border-radius:0px 0px 4px 4px; border-radius:0px 0px 4px 4px; margin-top:-2px; display:none; line-height:10px;}
div.register-wrapp p.register-bottom-copy{float:left; width:100%; color:#c6c6c6; font-size:12px; text-align:center; font-style:italic;}
div.register-wrapp input.button{float:left; clear:both; position:relative; left:50%; top:0px; margin:10px 0px 3px -140px; padding:0px 45px 4px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.login-wrapp{float:left; width:100%;}
div.btn-fb-conect{ display:inline-block;}
div.checkout-wrapp div.login-wrapp{width:761px; margin-left:64px;}
div.login-wrapp div.login{float:left; width:320px; border-right:1px solid #d9d9d9; padding:0px 38px 5px 0px;}
div.login-wrapp div.login h1{float:left; width:100%; text-align:center; margin:15px 0px;}
div.login-wrapp div.login h3{float:left; width:100%; text-align:center; margin-bottom:20px;}
div.login-wrapp div.login ul.login-form{float:left; width:100%;}
div.login-wrapp div.login ul.login-form li{float:left; width:100%; margin-bottom:2px;}
div.login-wrapp div.login ul.login-form li input{float:left; height:40px; width:248px; border:none; font-size:16px; color:#b3b3b3;
padding:0px 10px 0px 62px; border-bottom:1px solid #e9e9e9;}
div.login-wrapp div.login ul.login-form li input.user{background:url(../images/user-icon-II.png) no-repeat 14px center;}
div.login-wrapp div.login ul.login-form li input.password{background:url(../images/password-icon-II.png) no-repeat 14px center;}
div.login-wrapp div.login ul.login-form a.btn-forgot-password{float:left; color:#c6c6c6; font-style:italic; margin:28px 0px 0px 0px;}
div.login-wrapp div.login ul.login-form input.button{float:right; background:#b3b3b3; margin:20px 0px 0px 0px;}
div.login-wrapp div.login ul.login-form li p.e{float:left; width:282px; padding:4px 20px; background:#ea6b6b; color:#913535; -moz-border-radius:0px 0px 4px 4px; -webkit-border-radius:0px 0px 4px 4px; border-radius:0px 0px 4px 4px; margin-top:-2px; display:none;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.login-wrapp div.register{float:left; width:320px; padding:0px 0px 0px 38px;}
div.login-wrapp div.register h1{float:left; width:100%; text-align:center; margin:18px 0px;}
div.login-wrapp div.register h3{float:left; width:100%; text-align:center; margin-bottom:25px;}
div.login-wrapp div.register p{float:left; width:100%; min-height:97px; line-height:17px; font-size:16px; color:#b3b3b3;}
div.login-wrapp div.register input.button{float:right; background:#50c8ea;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.login-wrapp div.form-first-time{float:left; width:320px; padding:0px 0px 0px 60px;}
div.login-wrapp div.form-first-time h1{float:left; width:100%; text-align:center; margin:15px 0px;}
div.login-wrapp div.form-first-time input.email{float:left; width:254px; height:38px; color:#b3b3b3; padding:0px 10px 0px 56px; border:1px solid #e5e5e5; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; position:relative; z-index:1; background:url(../images/email-icon.png) no-repeat left center #fff; margin-top:0px;}
div.login-wrapp div.form-first-time input.userName{float:left; width:254px; height:38px; color:#b3b3b3; padding:0px 10px 0px 56px; border:1px solid #e5e5e5; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; position:relative; z-index:1; background:url(../images/user-icon.png) no-repeat left center #fff; margin-top:10px;}
div.login-wrapp div.form-first-time input.password,
div.login-wrapp div.form-first-time input.confirm-password{float:left; width:254px; height:38px; color:#b3b3b3; padding:0px 10px 0px 56px; border:1px solid #e5e5e5; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; position:relative; z-index:1; background:url(../images/password-icon.png) no-repeat left center #fff; margin-top:10px;}
div.login-wrapp div.form-first-time input.button{float:right; margin-top:10px; background:#cc2525;}
div.login-wrapp div.form-first-time p.e{float:left; width:282px; padding:6px 20px 4px; background:#ea6b6b; color:#913535; -moz-border-radius:0px 0px 4px 4px; -webkit-border-radius:0px 0px 4px 4px; border-radius:0px 0px 4px 4px; margin-top:-2px; display:none; line-height:10px;}
div.checkout-wrapp div.login-wrapp div.login{clear:both; min-height:260px; padding-right:61px; background:url(../images/check-out-sep.png) no-repeat right bottom; border:0;}
div.checkout-wrapp div.login-wrapp div.login ul.login-form li{min-height:60px;}
div.checkout-wrapp div.login-wrapp div.login ul.login-form input.button{margin-top:0;}
div.checkout-wrapp div.login-wrapp div.login ul.login-form a.btn-forgot-password{margin-top:8px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.home-spotlight{float:left; width:950px; height:350px; background:#fff; 
-moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1); margin:20px 0px 0px 0px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.product-list-wrapp{float:left; width:100%; margin-top:24px;}
div.product-list-wrapp h2.product-list-title{float:left; padding:0px 328px; text-align:center; background:url(../images/bg-product-title.png) no-repeat left center; text-transform:uppercase; color:#111; margin-bottom:18px; position:relative; font-weight:bold;}
div.product-list-wrapp h2.product-list-title01{float:left; padding:0px 328px; text-align:center; background:url(../images/bg-product-title.png) no-repeat left center; text-transform:uppercase; color:#111; margin-bottom:18px; position:relative; font-weight:bold;}
div.product-list-wrapp h2.product-list-title span.text-gradiant{width:365px; left:292px;}
div.product-list-wrapp h2.product-list-title01 span.text-gradiant01{width:440px; left:257px;}
div.product-list-wrapp ul.product-list{float:left; width:984px; position:relative;}
div.product-list-wrapp ul.product-list li{float:left; width:294px; height:367px; margin:0px 34px 32px 0px; position:relative; text-align:center; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1); background:#fff;}
div.product-list-wrapp ul.product-list li div.img-box{float:left; width:100%; height:190px; background:url(../images/loader.gif) no-repeat center #FFF;}
div.product-list-wrapp ul.product-list li img.img-icon{float:left; position:absolute; z-index:1; top:167px; left:0px;}
div.product-list-wrapp ul.product-list li span.title{float:left; width:264px; padding:0px 15px; text-align:center; margin:30px 0px 8px 0px;  font-size:16px; text-transform:uppercase;}
div.product-list-wrapp ul.product-list li p{float:left; width:264px; min-height:48px; padding:5px 15px 0px 15px; line-height:16px; color:#565555;}
div.product-list-wrapp ul.product-list li a.button{margin-top:16px; padding:0px; min-width:122px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.video-wrapp{float:left; width:100%; height:362px; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1); background:url(../images/home-video-sep.png) no-repeat center #fff;}
ul.video-list{float:left; margin-top:30px;}
ul.video-list li{float:left; width:400px; text-align:center; margin:0px 40px 0px 35px;}
ul.video-list li a.img-box{float:left; width:390px; height:208px; padding:5px; background:url(../images/loader.gif) no-repeat center #FFF; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1);}
ul.video-list li span.title{float:left; width:100%; text-align:center; margin:15px 0px 6px;  font-size:16px; text-transform:uppercase;}
ul.video-list li p{float:left; width:100%; line-height:16px; color:#565555;}
ul.video-list li a.btn-watch-video{display:inline-block; height:16px; padding-right:14px; background:url(../images/arrow-red-small.png) no-repeat right 5px; color:#dc3333; line-height:14px; margin-top:12px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.footer-wrapp{float:left; width:100%; min-height:212px; margin-top:35px; background:url(../images/bg-footer.png) repeat-x top #fff;}
div.footer{float:left; width:990px; position:relative; left:50%; margin-left:-475px; padding-top:20px; background:url(../images/footer-logo.png) no-repeat right 50px;}
div.footer ul.footer-nav{float:left; width:100%;}
div.footer ul.footer-nav li{float:left; margin-right:54px;}
div.footer ul.footer-nav li h5{float:left; width:100%; font-size:12px; color:#dc3333; margin-bottom:3px; font-weight:normal;}
div.footer ul.footer-nav li a{float:left; color:#565555; line-height:16px;}
div.footer ul.footer-nav li a:hover,div.footer ul.footer-nav li a.active{color:#CD3333;}
div.footer p.copy{float:left; width:85%; text-align:center; color:#565555; margin-top:60px;}
.footer_msg_01{width:100%;text-align:center;position:relative;float:right;top:0px;color:#565555;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.shop-wrapp{position:relative;float:left; width:100%; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1); margin:40px 0px 35px 0px; background:#fff;}
h1.title-nu-shop{float:left; width:100%; text-align:center; text-transform:uppercase;}
div.sidebar{float:left; width:223px; background:#fff; padding:25px 0px 25px 15px;}
div.sidebar h2{float:left; width:208px; text-align:center; font-size:25px; background:url(../images/img-2-line.png) repeat-x bottom; padding-bottom:24px;}
ul.sidebar-nav{float:left; width:100%;}
ul.sidebar-nav li{float:left; width:208px; border-bottom:1px solid #000;}
ul.sidebar-nav li a{float:left; width:208px; position:relative; z-index:10; line-height:60px; font-size:18px; padding-right:27px;  color:#000; text-align:center; text-transform:uppercase; background:url(../images/arrow-sidebar.png) no-repeat 198px center;}
ul.sidebar-nav li a:hover{background:url(../images/arrow-sidebar-over.png) no-repeat 198px center; color:#da2121;}
ul.sidebar-nav li a.active{background:url(../images/arrow-with-shadow.png) no-repeat right center; color:#da2121;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.shop-conainer{float:left; width:643px; padding:42px 0px 46px 33px; background:url(../images/bg-shadow-right.png) repeat-y left; position:relative;}
div.shop-conainer h2{float:left; width:100%; font-size:25px; text-transform:uppercase; text-align:center;}
div.shop-conainer span.subtitle{float:left; width:100%; margin-bottom:7px; margin-top:7px; color:#565555; text-align:center;}
div.shop-conainer div.shoping-landing{float:left; width:100%;}
div.shop-conainer div.shoping-landing ul.list{float:left; width:590px; padding:28px 28px 14px; margin:25px 0px 0px 0px; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1);}
div.shop-conainer div.shoping-landing ul.list li{float:left; width:100%; min-height:88px; margin:0px 0px 15px; padding-bottom:10px; border-bottom:1px solid #e7e7e7;}
div.shop-conainer div.shoping-landing ul.list li a.img-box{float:left; width:66px; height:66px; margin-right:44px;}
div.shop-conainer div.shoping-landing ul.list li div.details{float:left; width:480px; position:relative;}
div.shop-conainer div.shoping-landing ul.list li div.btns{ float:right; width:128px;}
div.shop-conainer div.shoping-landing ul.list li a.button{float:right; width:122px; padding:0px; margin:6px 4px 8px 0px;}
div.shop-conainer div.shoping-landing ul.list li a.buynow{clear:both;}
div.shop-conainer div.shoping-landing ul.list li a.prodPrice{ float:right; width:140px; height:30px; font-size:25px;  text-align:center; line-height:30px; }
div.shop-conainer div.shoping-landing ul.list li span.name{float:left; font-size:25px; text-transform:uppercase;  margin-top:10px;}
div.shop-conainer div.shoping-landing ul.list li p{float:left; clear:both; color:#dc3333; font-size:14px; position:absolute; top:42px;}
div.shop-conainer div.shoping-landing ul.list li.last{border:none; margin-bottom:0px;}
ul#how-to-play-games li{display:none;}
div.playing-cards-section{float:left; width:100%; margin-top:20px; text-align:center;}
div.playing-cards-section div.img-box{float:left; width:100%; height:320px; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1); background:#FFF;}
div.playing-cards-section p{float:left; width:100%; margin:20px 0px 20px; text-align:left;}
div.playing-cards-section a.button{min-width:100px; display:inline-block;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.shop-conainer div.product-list-wrapp ul.product-list{float:left; width:645px; display:block; margin-bottom:-23px;}
div.shop-conainer div.product-list-wrapp ul.product-list li{margin:0px 26px 28px 0px;}
div.shop-conainer div.product-list-wrapp ul.product-list li span.title{margin:0px 0px 12px; background:url(../images/img-2-line.png) repeat-x top; padding-top:30px;}
div.shop-conainer div.product-list-wrapp ul.product-list li span.title a{color:#000;}
div.shop-conainer div.product-list-wrapp div.scroll-pane{float:left; width:640px; height:648px; padding:5px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.game-about{float:left; width:100%;}
div.game-about h1{float:left; width:100%; font-size:40px; text-align:center; margin-bottom:20px;}
div.game-about div.video-box{float:left; width:440px; height:234px; padding:5px; background:url(../images/loader.gif) no-repeat center #FFF; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1); margin:0px 0px 25px 100px;}
div.game-about span.title{float:left; width:100%; color:#000; line-height:16px; margin:5px 0px 5px 0px; font-size:14px; text-transform:uppercase; }
div.game-about p{float:left; width:100%; color:#565555; line-height:16px; margin-bottom:15px}
div.game-about a.button{float:left; width:210px; margin:20px 0px 0px 200px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.product-details{float:left; width:100%; position:relative;}
div.product-view{float:left; margin:0px 34px 12px 0px; position:relative; width:294px; height:333px; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1); background:#fff; text-align:center; background:url(../images/loader.gif) no-repeat center 130px #FFF;}
div.product-view ul.thumbs{float:left; min-width:248px; margin:8px 0px 0px 20px;}
div.product-view ul.thumbs li{float:left; width:54px; height:54px; border:1px solid #e5e5e5; -moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; margin-left:6px; background:url(../images/loader.gif) no-repeat center;}
div.product-view div.outer{float:left; width:100%;}
div.product-view div.outer ul#Products{float:left; width:100%; height:284px; background:url(../images/img-2-line.png) repeat-x bottom; padding-bottom:5px;}
div.product-view div.outer ul#Products li{float:left; width:100%; height:284px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.product-description{float:left; width:292px; min-height:500px; margin:0px 0px 0px 0px;}
div.product-description h2{float:left; width:100%; font-size:25px; margin-bottom:26px; text-align:left;}
div.product-description p{float:left; width:100%; color:#565555; line-height:16px;}
div.product-size{float:left; width:100%; margin-top:18px;}
div.product-size span.title{float:left; margin-right:9px; line-height:40px; font-size:16px; }
div.product-size a.button{float:right; min-width:122px; padding:0px; margin:30px 4px;}
div.product-size a.btn-gray{float:right; margin-top:30px; 
box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #f0f0f0;
-webkit-box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #f0f0f0;
-moz-box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #f0f0f0;}
ul.product-available{float:left; width:100%; margin-top:30px;}
ul.product-available li{float:left; width:100%; margin-bottom:8px;}
ul.product-available h3{float:left; width:100%; margin-bottom:10px;}
ul.product-available li label.title{float:left; width:100%; color:#565555; margin-bottom:3px;}
ul.product-available li div{float:left; width:100%; height:5px; background:#e5e5e5;}
ul.product-available li div p{float:left; height:5px; background:#dc3333;}
div.social-net{float:left; position:absolute; left:0px; top:345px;}
div.scroll-bottom{float:left; width:100%; text-align:center; padding:40px 0px; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1); background:#fff; margin-top:50px;}
div.scroll-bottom a{display:inline-block;}
div.scroll-bottom a:hover{opacity:0.8;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.profile-wrapp{float:left; width:890px; min-height:306px; background:#fff; margin-top:30px; padding:30px; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1);}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.user-details{float:left; width:888px; min-height:304px; border:1px solid #e5e5e5; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px;}
div.user-details div.left{float:left; width:568px; padding:20px 19px 20px 20px; border-right:1px solid #e5e5e5;}
div.user-details div.left div.img-box{float:left; width:162px; height:162px; position:relative; background:url(../images/defaul-picture.png) no-repeat;}
div.user-details div.left div.img-box div.file-browse{float:left; width:92px; height:34px; background:url(../images/btn-edit.png) no-repeat; overflow:hidden; position:absolute; left:50%; top:50%; margin:-17px 0px 0px -46px; display:none;}
div.user-details div.left div.img-box div.profile_del_button {display:none;position:absolute;right:0px; top: 0px;}
div.user-details div.left div.img-box div.file-browse input{float:left; height:34px; opacity:0; margin-left:-17px; cursor:pointer;}
div.user-details div.left div.img-box:hover div.file-browse{display:block;}
div.user-details div.left div.img-box:hover div.profile_del_button{display:block;} 
div.user-details div.left div.img-box div.loader a.cl{display:none;}
div.user-details div.left div.img-box div.loader:hover a.cl{display:block;}
div.user-details div.left div.user-data{float:left; width:388px; margin-left:18px; position:relative; background:url(../images/img-2-line.png) repeat-x bottom; padding-bottom:13px;}
div.user-details div.left div.user-data h1{float:left; width:100%; text-transform:uppercase; margin-bottom:15px;}
div.user-details div.left div.user-data label.title{float:left; margin:0px 10px 12px 0px; clear:both; text-transform:uppercase;  font-size:16px;}
div.user-details div.left div.user-data span{float:left; font-size:14px; line-height:18px; margin:0px 10px 12px 0px; color:#565555;  font-size:12px;}
div.user-details div.left div.user-data a.btn-edit{float:left; height:32px; color:#FFF; font-size:13px; text-transform:uppercase; text-align:center; line-height:32px; background:#b3b3b3; padding:0px 32px; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px;  position:absolute; bottom:20px; right:0px;width:56px;}
div.user-details div.left div.user-data a.btn-edit:hover{background:#50c8ea;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.btn-box{float:left; width:100%; margin-top:10px;}
div.btn-box a{float:left; height:32px; color:#FFF; font-size:13px; margin-right:26px; text-transform:uppercase; text-align:center; line-height:30px; background:#b3b3b3; padding:0px 15px; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; }
div.btn-box a.btn-price{background:url(../images/doller-icon-small.png) no-repeat 10px center; padding-left:44px; width:95px;}
div.btn-box a.btn-unreg{background:#cc2525; text-align: center; width:125px;}
div.btn-box a.btn-turnament{background:#d5bb53; width:150px;}
div.btn-box a.btn-won-game{background:url(../images/won-icon.png) no-repeat 10px center #50c8ea; padding-left:44px; margin:0px; width:123px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.chekout-btn{float:left; width:100%; text-align:center; margin-top:20px;}
div.chekout-btn a.btn-next,
div.chekout-btn a.btn-add,
div.chekout-btn a.btn-back,
div.chekout-btn a.btn-proceed-to-payment{display:inline-block; height:32px; margin:0px 5px; color:#FFF; font-size:13px; text-transform:uppercase; text-align:center; line-height:32px;background:#cc2525; padding:0px 30px; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; }
div.chekout-btn a.btn-back{background:#b3b3b3;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.user-details div.left ul.other-info{float:left; width:608px; position:relative; margin-top:10px;}
div.user-details div.left ul.other-info li{float:left; width:304px; margin-top:13px;}
div.user-details div.left ul.other-info li span{float:left; width:110px; font-size:16px;  text-transform:uppercase;}
div.user-details div.left ul.other-info li p{float:left; line-height:19px; color:#565555; font-size:14px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.user-details div.right{float:right; width:240px; padding:20px 19px 20px 20px; /*border-right:1px solid #e5e5e5;*/}
div.user-details div.right h3{float:left; width:100%; text-transform:uppercase; text-align:center; margin-bottom:12px;}
div.user-details div.right p{float:left; width:100%; font-size:14px; line-height:16px; color:#565555;}
div.user-details div.right div.progress-bar{float:left; padding-top:12px; border-top:1px solid #e5e5e5; margin-top:12px;}
div.user-details div.right div.progress-bar span.title{float:left; width:100%; font-size:14px; color:#565555; margin-bottom:6px;}
div.user-details div.right div.progress-bar div.bar{float:left; width:232px; height:32px; background:#f7f7f7; line-height:32px; padding:4px; -moz-border-radius:2px; -webkit-border-radius:2px; border-radius:2px;}
div.user-details div.right div.progress-bar div.bar div{float:left; height:32px; text-indent:10px; font-size:16px; background:url(../images/bg-progress-bar.png) repeat;  -moz-border-radius:2px; -webkit-border-radius:2px; border-radius:2px;}
div.user-details div.right ul.remaining-data{float:left; width:100%; font-size:14px; color:#565555; margin-top:10px;}
div.user-details div.right ul.remaining-data span.title{float:left; width:100%; margin-bottom:8px;}
div.user-details div.right ul.remaining-data li{float:left; width:100%; line-height:16px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.personal-info-wrapp{float:left; width:100%; position:relative;}
div.personal-info-wrapp h1{float:left; width:100%; margin-bottom:22px;}
div.personal-info-wrapp ul.form{float:left; width:100%; border-bottom:1px solid #e5e5e5; padding-bottom:6px;}
div.personal-info-wrapp ul.form li{float:left; width:100%; border-top:1px solid #e5e5e5; padding:6px 0px;}
div.personal-info-wrapp ul.form li span.title{float:left; width:240px; line-height:36px; font-size:16px; text-transform:uppercase; }
div.personal-info-wrapp ul.form li div.data,div.personal-info-wrapp ul.form li div.lineHeight16{float:left; width:650px; line-height:36px; font-size:14px; color:#565555;}
div.personal-info-wrapp ul.form li div.lineHeight16{line-height:16px;}
div.personal-info-wrapp ul.form li div.element{float:left; width:650px; font-size:14px; color:#565555;}
div.personal-info-wrapp ul.form li input.text{float:left;}
div.personal-info-wrapp ul.form li textarea.address{width:340px;}
div.personal-info-wrapp a.btn-save,div.personal-info-wrapp a.btn-remove,div.personal-info-wrapp a.btn-cancel,div.personal-info-wrapp a.btn-edit{float:left; height:32px; color:#FFF; font-size:13px; text-transform:uppercase; text-align:center; line-height:32px; background:#b3b3b3; padding:0px 32px; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px;  position:absolute; top:0px; right:0px;}
a.btn-edit{float:left; height:32px; color:#FFF; font-size:13px; text-transform:uppercase; text-align:center; line-height:32px; background:#b3b3b3; padding:0px 32px; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px;}
div.personal-info-wrapp a.btn-cancel{right:135px;}
div.personal-info-wrapp a.btn-remove{right:270px;}
div.personal-info-wrapp a.btn-save:hover,a.btn-remove:hover,div.personal-info-wrapp a.btn-cancel:hover,div.personal-info-wrapp a.btn-edit:hover{background:#50c8ea;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.forgot-password-wrapp{float:left; width:890px; min-height:300px; background:#fff; margin:22px 0px 25px; padding:28px 30px; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1);}
div.forgot-password-wrapp h1{float:left; width:100%; margin-bottom:30px; text-align:center;}
div.forgot-password-wrapp span.data{float:left; width:100%; text-align:center; font-size:14px; color:#565555;}
div.forgot-password-wrapp ul.form-forgot-password{float:left; width:560px; position:relative; left:50%; margin:35px 0px 0px -280px;}
div.forgot-password-wrapp ul.form-forgot-password li{float:left; width:300px;  font-size:16px; text-align:right; line-height:34px;}
div.forgot-password-wrapp ul.form-forgot-password li.title{width:250px; padding-right:10px; text-transform:uppercase;}
div.forgot-password-wrapp ul.form-forgot-password li input.text{float:left; position:relative; z-index:1;}
div.forgot-password-wrapp ul.form-forgot-password li p.e{float:left; width:286px; padding:4px 5px; font-size:12px; font-weight:normal;  background:#ea6b6b; color:#913535; -moz-border-radius:0px 0px 4px 4px; -webkit-border-radius:0px 0px 4px 4px; border-radius:0px 0px 4px 4px; margin-top:-3px; text-align:center; display:block; line-height:normal; display:none;}
div.forgot-password-wrapp ul.form-forgot-password li.last{width:100%; text-align:center; margin-top:40px;}
div.forgot-password-wrapp ul.form-forgot-password li.last input.button{background:#b3b3b3;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.change-password-wrapp{float:left; width:890px; min-height:300px; background:#fff; margin-top:30px; padding:30px; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1);}
div.change-password-wrapp h1{float:left; width:100%; margin-bottom:30px; text-align:center;}
div.change-password-wrapp ul.form-change-password{float:left; width:570px; position:relative; left:50%; margin:0px 0px 0px -280px;}
div.change-password-wrapp ul.form-change-password li{float:left; width:297px;  min-height:64px; margin-bottom:10px; font-size:16px; text-align:right; line-height:34px;}
div.change-password-wrapp ul.form-change-password li.title{width:260px; padding-right:10px; text-transform:uppercase;}
div.change-password-wrapp ul.form-change-password li input.text{float:left; position:relative; z-index:1;}
div.change-password-wrapp ul.form-change-password li.last{width:100%; text-align:center; margin-top:15px;}
div.change-password-wrapp ul.form-change-password li.last input.button{/* background:#b3b3b3; */}
div.change-password-wrapp ul.form-change-password p.e{float:left; width:286px; padding:4px 5px; font-size:12px; font-weight:normal;  background:#ea6b6b; color:#913535; -moz-border-radius:0px 0px 4px 4px; -webkit-border-radius:0px 0px 4px 4px; border-radius:0px 0px 4px 4px; margin-top:-2px; text-align:center; display:block; line-height:normal;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.checkout-wrapp{position:relative;float:left; width:890px; min-height:570px; background:#fff; margin:22px 0px 35px; padding:30px; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1);}
div.checkout-wrapp h1{float:left; width:100%; text-align:center; margin-bottom:8px;}
ul.steps-nav{float:left; width:100%; text-align:center; border-bottom:1px solid #444; padding-bottom:18px; margin-bottom:12px;}
ul.steps-nav li{display:inline-block; margin:0px 5px;}
ul.steps-nav li a{display:inline-block; width:95px; height:32px; background:#b3b3b3; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; line-height:32px; line-height:32px; color:#fff; font-size:13px; text-transform:uppercase; }
ul.steps-nav li a.active{background:#cc2525;}
div.checkout-wrapp div.btn-fb-conect{float:left; width:320px; height:45px; margin:25px 0px 20px 220px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.checkout-step2-new-user{float:left; width:100%;}
div.checkout-new-user-form{float:left; width:602px; margin-left:144px;}
div.checkout-new-user-form ul.form{float:left; width:602px;}
div.checkout-new-user-form ul.form li{float:left; width:100%; padding:6px 0px;}
div.checkout-new-user-form ul.form li span.title{float:left; width:240px; line-height:36px; font-size:16px; text-transform:uppercase; }
div.checkout-new-user-form ul.form li div.element{float:left; width:362px; font-size:14px; color:#565555;}
div.checkout-new-user-form ul.form li input.text{float:left;}
div.checkout-new-user-form ul.form li textarea.address{width:340px;}
div.checkout-new-user-form a.btn-cancel{right:110px;}
div.checkout-step2-new-user a.btn-add{float:left; height:32px; color:#FFF; font-size:13px; text-transform:uppercase; text-align:center; line-height:30px;background:#50C8EA; padding:0px 30px; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px;  margin:5px 0px 0px 118px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.checkout-existing-user-form{float:left; width:100%;}
div.checkout-existing-user-form h2{float:left; width:100%; font-size:20px; margin-bottom:40px; text-align:center;}
div.checkout-existing-user-form h2.step-3-title{margin-top:12px;}
div.checkout-existing-user-form div.left{float:left; width:446px; background:url(../images/check-out-sep.png) no-repeat right center;}
div.checkout-existing-user-form div.left a{float:left; width:347px; color:#565555; font-size:14px; line-height:16px; border:1px solid #d9d9d9; padding:10px 25px; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; margin-bottom:15px; position:relative;}
div.checkout-existing-user-form div.left input.checkShipping{ float:left; clear:both;}
div.checkout-existing-user-form div.left a span.editAdd{float:right; height:11px; background:url(../images/edit-icon.gif) no-repeat left center; padding-left:13px; font-size:10px; text-transform:uppercase; line-height:13px; color:#cc2525; position:absolute; right:10px; top:10px; display:none;}
div.checkout-existing-user-form div.left a span.deleteAdd{float:right; height:11px; background:url(../images/delete-icon.png) no-repeat left center; padding-left:14px; font-size:10px; text-transform:uppercase; line-height:13px; color:#cc2525; position:absolute; right:54px; top:10px; display:none;}
div.checkout-existing-user-form div.left a.active{border:3px solid #CC2525; width:343px;}
div.checkout-existing-user-form div.scroll-pane{float:left; width:446px; height:360px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.checkout-existing-user-form div.right{float:left; width:420px; margin-left:24px;}
div.checkout-existing-user-form div.right ul.form{float:left; width:420px;}
div.checkout-existing-user-form div.right ul.form li{float:left; width:100%; padding:6px 0px;}
div.checkout-existing-user-form div.right ul.form li span.title{float:left; width:118px; line-height:36px; font-size:16px; text-transform:uppercase; }
div.checkout-existing-user-form div.right ul.form li div.element{float:left; width:296px; font-size:14px; color:#565555;}
div.checkout-existing-user-form div.right ul.form li input.text{float:left; width:276px}
div.checkout-existing-user-form div.right ul.form li textarea.address{width:276px;}
div.checkout-existing-user-form div.right ul.form li .dd,
div.checkout-existing-user-form div.right ul.form li .dd .ddChild{width:297px !important;}
div.checkout-existing-user-form div.right a.btn-cancel{right:110px;}
div.checkout-existing-user-form div.right ul.form li p.e{float:left; width:258px; padding:4px 20px; font-size:11px; background:#ea6b6b; color:#913535; -moz-border-radius:0px 0px 4px 4px; -webkit-border-radius:0px 0px 4px 4px; border-radius:0px 0px 4px 4px; margin-top:-2px; display:none;}
div.order-summary-wrapp-step-4{float:left; width:100%;}
div.order-summary-wrapp-step-4 input.btn-proceed-to-payment{display:inline-block; height:32px; clear:both; color:#FFF; font-size:13px; text-transform:uppercase; text-align:center; line-height:32px; background:#cc2525; padding:0px 30px 3px; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px;  border:none; cursor:pointer; margin-left:5px;}
div.without-shop-step-1{float:left; width:100%; text-align:center; margin-top:40px;}
div.without-shop-step-1 span{float:left; width:100%; font-size:14px; margin-bottom:20px;  color:#CC2525;}
div.without-shop-step-1 a.button{display:inline-block;}
div.order-summary-wrapp-step-4 h3{float:left; width:100%; height:40px; font-size:20px;  text-align:center;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.shopping-cart-wrapp{float:left; width:890px; min-height:570px; background:#fff; padding:30px; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1);}
div.shopping-cart-wrapp h1{float:left; width:100%; text-align:center; margin-bottom:30px;}
table.table-order-summary{float:left; clear:both;  font-size:16px; border-bottom:1px solid #000; background:url(../images/bg-shoping-cart-table.png) repeat-x top;}
table.table-order-summary th{line-height:40px; font-weight:normal;}
table.table-order-summary td{border-top:1px solid #e5e5e5;}
table.table-order-summary a.thumb{float:left; width:60px; height:60px; background:#e5e5e5; margin:10px;}
table.table-order-summary input.text{min-width:0px; width:20px; text-align:center; margin-left:50px;}
div.total-amount{float:right; width:315px; background:url(../images/img-2-line.png) repeat-x left 74px;  font-size:16px; line-height:75px; padding-right:24px;}
table.table-order-summary a.changeVal,
table.table-order-summary a.saveVal{color:#dc3333; width:42px; text-align:center; margin-left:27px; font-size:10px; text-transform:uppercase;}
div.total-amount span.title{float:left; width:178px; text-align:right;}
div.total-amount p{float:left; width:135px; text-align:right;}
div.total-amount a.btn-continue-browse,
div.total-amount a.btn-checkout{float:right; height:32px; color:#FFF; font-size:13px; text-transform:uppercase; text-align:center; line-height:32px; background:#b3b3b3; padding:0px 15px; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px;  margin:10px 0px 0px 10px;}
div.total-amount a.btn-continue-browse:hover,
div.total-amount a.btn-checkout:hover{background:#cc2525;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.wait-moment-step-4{float:left; width:100%; text-align:center; margin-top:100px;}
div.wait-moment-step-4-II{float:left; width:890px; min-height:200px; background:#fff; padding:30px; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1); text-align:center; margin-top:35px;}
div.wait-moment-step-4 h2,,div.wait-moment-step-4-II h2{float:left; width:100%; font-size:20px; margin-bottom:28px;}
div.wait-moment-step-4 p,,div.wait-moment-step-4-II p{float:left; width:100%; font-size:14px; color:#565555;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
ul.game-list{float:left; width:950px; margin-top:30px;}
ul.game-list li{float:left; width:930px; min-height:390px; background:#fff; padding:10px; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1); margin-bottom:30px;}
ul.game-list li div.flash-box{float:left; width:574px; height:390px; background:url(../images/loader.gif) no-repeat #f0f0f0 center;}
ul.game-list li div.game-description{float:left; width:308px; margin-left:32px;}
ul.game-list li div.game-description h2{float:left; width:100%; margin-bottom:15px; font-size:40px; text-align:center; text-transform:uppercase;}
ul.game-list li div.game-description p{float:left; width:100%; color:#565555; line-height:16px; padding-bottom:10px; background:url(../images/img-2-line.png) repeat-x bottom;}
ul.game-list li div.game-description a.btn-yellow,ul.game-list li div.game-description a.button{width:263px; margin:14px 0px 0px 4px;}
ul.game-list li div.game-description div.title{height:110px;width:300px;}
ul.game-list li div.game-description div.title img{height:100%;width:100%;}
ul.game-list li div.game-description a.btn-gray{float:left; width:140px; margin:14px 0px 0px 4px; padding:0px; 
box-shadow:0px 0px 1px #e44b4b inset,0px 0px 0px 4px #f0f0f0;
-webkit-box-shadow:0px 0px 1px #e44b4b inset,0px 0px 0px 4px #f0f0f0;
-moz-box-shadow:0px 0px 1px #e44b4b inset,0px 0px 0px 4px #f0f0f0; /* Old browsers */}
ul.game-list li div.game-description a:hover{opacity:0.9;}
ul.game-list li div.game-description a.btn-watch-demo{margin-left:8px;}
ul.game-list li div.game-description a.btn-watch-demo{float:right; margin-right:4px;}
div.game-list-loader{float:left; width:100%; padding:52px 0px; text-align:center; background:url(../images/bg-game-list-scroller.png) repeat; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1);}
div.game-list-loader a{display:inline-block;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.msg-jackpot-grabs{float:left; width:283px; height:66px; background:url(../images/bg-msg-jackpot-grabs.png) no-repeat; position:absolute; z-index:10; left:50%; margin-left:-220px; top:-2px; padding:14px 15px 0px 60px; text-align:center; font-size:18px; color:#7b6c2e; text-shadow:0px 2px 0px #f8ebb3;  text-transform:uppercase;}
div.game-inner-wrapp{float:left; width:930px; min-height:610px; background:#fff; margin:40px 0px 0px; padding:10px; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1);}
div.game-list-inner-banner{margin-bottom:30px;}
div.game-window{float:left; width:721px; height:626px; border:4px solid #7f7f7f; background:url(../images/loader.gif) no-repeat center #fdfdfd; text-align:center;}
div.game-window h2{float:left; width:100%; padding:20px 0px 22px 0px; text-align:center; margin-bottom:30px; font-size:25px; background:url(../images/img-2-line.png) repeat-x bottom;}
div.game-window a{ color:#b61c1c; font-size:18px; font-weight:bold; text-transform:uppercase; display:inline-block;}
div.game-details{float:left; width:190px; margin-left:10px; min-height:634px; position:relative;}
div.game-details h2{float:left; width:100%; padding:20px 0px 25px 0px; text-align:center; margin-bottom:30px; font-size:25px; background:url(../images/img-2-line.png) repeat-x bottom;}
div.btn-tip-wrapp{ float:left; width:202px; position:relative;}
div.game-details a.btn-gray,div.game-details a.btn-green,div.game-details a.btn-feedback,div.game-details a.btn-blue,
div.game-details a.button,div.game-details a.btn-dark-yellow{padding:0px; width:182px; margin:0px 0px 18px 4px; box-shadow:0px 0px 1px #e0c461 inset,0px 0px 0px 4px #f0f0f0; -webkit-box-shadow:0px 0px 1px #e44b4b inset,0px 0px 0px 4px #f0f0f0; -moz-box-shadow:0px 0px 1px #e44b4b inset,0px 0px 0px 4px #f0f0f0;}
div.game-details a.btn-gray img,div.game-details a.btn-blue img,
div.game-details a.button img,div.game-details a.btn-dark-yellow img{display:inline-block; position:relative; margin-right:10px; top:4px;}
#video_close_btn{position:relative;top:-13px;right:-11px;float:right;height:30px;width:30px;z-index:1000}
#video_close_btn img{height:100%;width:100%;}
#video_iframe{height:600px;width:100%;border:none;position:relative;top:-11px;z-index:100}

div.btn-social-like{float:left; width:100%; padding-bottom:40px; background:url(../images/img-2-line.png) repeat-x bottom;}
div.btn-social-like div.btn-gplus{float:right; width:85px; text-align:right; }
div.btn-social-like div.fb-like{float:left; width:95px; }
div.btn-social-like div.btn-linked-in{float:right;}
div.banner-198x165{float:left; width:198px; height:165px; border:0px solid #000; position:absolute; bottom:0px; left:0px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.game-inner-product{float:left; width:100%;}
div.game-inner-product h2.product-list-title{padding:0px 297px; background:url(../images/bg-product-title-large.png) no-repeat left center; position:relative; font-weight:normal;}
div.game-inner-product h2.product-list-title01{padding:0px 297px; background:url(../images/bg-product-title-large01.png) no-repeat left center; position:relative; font-weight:normal;}
div.game-inner-product ul.product-list li span.title{margin:0px 0px 10px; background:url(../images/img-2-line.png) repeat-x top; padding-top:26px;}
div.game-inner-product ul.product-list li span.title a{color:#000;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.games-popup{display:none; position:absolute; z-index:101; left:50%; top:100px; margin-left:-323px; float:left; width:798px; min-height:526px; padding:5px 0px 0px 0px; background:#242424; -moz-box-shadow:5px 5px 5px rgba(0, 0, 0, 0.2); -webkit-box-shadow:5px 5px 5px rgba(0, 0, 0, 0.2); box-shadow:5px 5px 5px rgba(0, 0, 0, 0.2);}
ul.game-cat-list{float:left; width:100%; padding:20px 0px 24px; background:url(../images/h-sep-black.png) repeat-x bottom;}
ul.game-cat-list li{float:left; width:234px; margin-left:24px;}
ul.game-cat-list li div.img-box{float:left; width:100%; height:152px; background:url(../images/loader.gif) no-repeat center #fff;}
ul.game-cat-list li span.title{float:left; width:100%; font-size:16px; text-transform:uppercase; color:#fff;  text-align:center; margin:15px 0px}
ul.game-cat-list li a.btn-gray,ul.game-cat-list li a.button{width:105px; padding:0px; font-size:12px;
box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #1d1d1d;
-webkit-box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #1d1d1d;
-moz-box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #1d1d1d;}
ul.game-cat-list li a.btn-gray{float:right; }
ul.game-cat-list li a.button{float:left;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.running-low-on-chips{float:right; width:210px; height:198px; padding:0px 24px; background:url(../images/v-sep-black.png) repeat-y left; margin-top:24px; text-align:center;}
div.running-low-on-chips div.img-box{float:left; width:100%; height:112px;}
div.running-low-on-chips span.title{float:left; width:100%; font-size:16px; text-transform:uppercase; color:#fff;  text-align:center; margin:10px 0px}
div.running-low-on-chips a.button{min-width:122px; padding:0px;
box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #1d1d1d;
-webkit-box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #1d1d1d;
-moz-box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #1d1d1d;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
ul.top-10-player{float:left; width:502px; margin:16px 0px 0px 24px;}
ul.top-10-player h3{float:left; width:100%; font-size:16px; text-transform:uppercase; color:#fff;  text-align:center; font-weight:normal; margin-bottom:15px;}
ul.top-10-player li{float:left; width:250px; margin-bottom:12px;}
ul.top-10-player li a{float:left; width:100%; line-height:25px; color:#737373; font-size:14px;}
ul.top-10-player li a div.img-box{float:left; width:25px; height:25px; background:#FFF; margin-right:12px;}
ul.top-10-player li a span{float:left; width:212px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.how-to-play-info-wrapp{float:left; width:890px; background:#fff; padding:30px; margin-top:35px; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1);}
div.playing-card{float:left; width:100%; text-align:right;}
div.playing-card img.playing-card{float:left; margin-left:15px;}
div.playing-card div.playing-card-details{float:right; width:560px; border-bottom:1px solid #e9e9e9; padding-bottom:24px;}
div.playing-card div.playing-card-details h1{float:left; width:100%; font-size:40px; min-height:75px;}
div.playing-card div.playing-card-details p{float:left; width:100%; min-height:170px; color:#565555; line-height:16px; text-align:right;}
div.playing-card div.playing-card-details a.button{float:right; margin-top:10px;}
div.playing-card div.playing-card-details a.button span{width:260px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.game-instruction{float:left; width:100%;}
div.game-instruction h1{float:left; width:100%; font-size:40px; margin-bottom:15px;}
div.game-instruction p{float:left; width:100%; line-height:16px; color:#565555; margin-bottom:15px;}
div.no-margin{margin:0;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.editor-data{float:left; width:890px; background:#fff; padding:30px; margin-top:35px; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1);}
div.editor-data h1{float:left; width:100%; margin-bottom:10px; text-transform:uppercase;}
div.editor-data p{float:left; width:100%; line-height:16px; font-size:14px; color:#565555; margin-bottom:15px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.loader{float:left; width:100%; height:100%; position:absolute; left:0px; top:0px; z-index:1000; background:url(../images/loader.gif) no-repeat center #fff; opacity:0.8; display:none;}
/*~mx-alert~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div#mxalert{float:left; position:absolute; z-index:9999; padding:17px; background:#fff; width:560px; border:3px solid #cc2525; -webkit-border-radius:7px; -khtml-border-radius:7px; -moz-border-radius:7px;}
div#mxalert div#err-message{padding:0px 0px 10px 0px; color:#2f2f2f; font-weight:bold;}
div#mxalert p{font-size:18px; font-weight:bold; padding:40px 15px; text-align:center; color:#dc3333;}
div#mx-winmask{position:absolute; left:0; top:0; z-index:10; background-color:#000; display:none;}
div#mxalert a.close{border:1px solid #CCCCCC; color:#000000; font-weight:bold; height:25px; line-height:24px; position:absolute; right:5px; text-align:center;top:5px; width:25px; -moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.thanks-for-payment div.chekout-btn{text-align:left;}
div.thanks-for-payment h2{margin:0px 0px 30px 0px;}
div.thanks-for-payment ul{float:left; width:50%;}
div.thanks-for-payment ul li{float:left;width:100%; margin:0 0 10px 0; }
div.thanks-for-payment ul li label{float:left;width:150px; margin:0 15px 0 0;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
p.noFound{float:left; width:90%; padding:5px 2%; background:#CC2525; color:#fff; text-align:center; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; }
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.about-popup{float:left; width:745px; height:300px; padding:30px; position:absolute; left:145px; top:100px; z-index:101; background:#FFF; display:none; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1);}
div.about-popup ul.about-popup-nav{float:left; width:100%; text-align:center;}
div.about-popup ul.about-popup-nav li{display:inline-block; margin:0px 10px;}
div.about-popup ul.about-popup-nav li a{display:inline-block; width:120px; font-size:18px; color:#b4b4b4;  text-transform:uppercase; text-align:center; line-height:17px;}
div.about-popup ul.about-popup-nav li a:hover,
div.about-popup ul.about-popup-nav li a.active{background:url(../images/about-popup-nav-over1.png) no-repeat center 5px; color:#c0a649;background-size:120px 9px;}
div.about-popup ul.about-popup-inside{float:left; width:100%; margin-top:35px;}
div.about-popup ul.about-popup-inside h3{float:left; width:100%; text-align:center;  font-size:18px; text-transform:uppercase;}
div.about-popup ul.about-popup-inside h3 span,
div.about-popup ul.about-popup-inside h3 a{color:#ed1c24;}
div.about-popup ul.about-popup-inside h3 a.active{border-bottom:1px solid #ed1c24;}

div.about-popup ul.about-popup-inside li.about-popup-step-1,
div.about-popup ul.about-popup-inside li.about-popup-step-2,
div.about-popup ul.about-popup-inside li.about-popup-step-3,
div.about-popup ul.about-popup-inside li.about-popup-step-4,
div.about-popup ul.about-popup-inside li.about-popup-step-5{float:left; width:100%; text-align:center;}
div.about-popup ul.about-popup-inside li.about-popup-step-1 img{display:inline-block; margin-top:35px;}

div.about-popup ul.about-popup-inside li.about-popup-step-2 table{float:left; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; font-weight:bold; text-transform:uppercase; font-size:18px; text-align:center; position:relative; left:50%; margin:35px 0px 0px -137px;  font-weight:normal;}
div.about-popup ul.about-popup-inside li.about-popup-step-2 table code{color:#c0a649; font-weight:bold;}

div.about-popup ul.about-popup-inside li.about-popup-step-3{margin-top:-10px;}
div.about-popup ul.about-popup-inside li.about-popup-step-3 h3{height:36px; line-height:36px; background:url(../images/star-icon.png) no-repeat 250px center;}
div.about-popup ul.about-popup-inside li.about-popup-step-3 img{display:inline-block; margin-top:20px;}
div.about-popup ul.about-popup-inside li.about-popup-step-4 img{display:inline-block; margin:20px 0px;}
div.about-popup ul.about-popup-inside li.about-popup-step-5 img{display:inline-block; margin-top:28px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.about-wrapp{float:left; width:870px; background:#fff; overflow:hidden; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1); padding:25px 40px 0px; margin-top:22px;}
div.about-wrapp h1{float:left; width:100%; text-align:center; margin-bottom:30px;}
div.about-wrapp p{float:left; width:100%; line-height:18px; color:#565555;}
div.about-wrapp div.about-v-player{float:left; width:614px; height:346px; margin:38px 0px 0px 138px;}
div.about-container{float:left; width:100%; min-height:910px; margin-top:40px; background:url(../images/bg-lines-about-container.png) no-repeat center 78px; position:relative;}
div.about-container h2{float:left; width:100%; height:25px; text-align:center;  font-size:18px; text-transform:uppercase; color:#c0a649; margin-bottom:5px;}
div.about-container h3{float:left; width:100%; text-align:center;  font-size:18px; text-transform:uppercase; line-height:23px;}
div.about-container h4{float:left; width:100%; text-align:center;  font-weight:normal; font-size:14px; line-height:16px; text-transform:uppercase;}
div.about-container h3 span,
div.about-container h4 span,
div.about-container h3 a{color:#ed1c24;}
div.about-container h3 a.active{border-bottom:1px solid #ed1c24;}
div.about-container div.step-1{float:left; width:355px; height:267px; text-align:center; margin:6px 0px 0px 53px;}
div.about-container div.step-1 img{display:inline-block; margin-top:35px;}

div.about-container div.step-4{float:left; width:381px; height:266px; text-align:center; margin:5px 0px 0px 75px;}
div.about-container div.step-4 img{display:inline-block; margin:16px 0px 7px;}

div.about-container div.step-2{float:left; height:269px; clear:both; width:355px; text-align:center; margin:25px 0px 0px 49px;}

div.about-container div.step-2 table{float:left; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; font-weight:bold; text-transform:uppercase; font-size:18px; text-align:center; position:relative; left:50%; margin:10px 0px 6px -137px;  font-weight:normal;}
div.about-container div.step-2 table code{color:#c0a649; font-weight:bold;}

div.about-container div.step-5{float:left; width:381px; text-align:center; margin:25px 0px 0px 81px;}
div.about-container div.step-5 img{display:inline-block; margin:35px 0px 0px;}

div.about-container div.step-3{float:right; width:364px; text-align:center; position:absolute; left:40px; bottom:15px;}
div.about-container div.step-3 h2{ margin-bottom:5;}
div.about-container div.step-3 img{display:inline-block; margin:10px 0px 0px;}

div.about-wrapp div.playing-card{margin-top:50px;}
div.about-wrapp div.playing-card div.playing-card-details{padding:0; border:none;}
div.about-wrapp div.playing-card div.playing-card-details h1{min-height:inherit; text-align:right; margin-bottom:18px;}
div.about-wrapp div.playing-card div.playing-card-details p{min-height:inherit; color:#565555;}
div.about-wrapp div.playing-card div.playing-card-details a.btn-gray,
div.about-wrapp div.playing-card div.playing-card-details a.button{width:210px; margin-top:48px;}
div.about-wrapp div.playing-card div.playing-card-details a.btn-gray{float:right; margin:48px 0px 0px 38px;
box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #f0f0f0;
-webkit-box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #f0f0f0;
-moz-box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #f0f0f0;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.horizontaly-shadow{float:left; width:100%; height:7px; background:url(../images/bg-shadow-H.png) repeat-x top;}
div.shop-wrapp div.about-container{width:890px; margin:27px 0px 35px 30px;}
div.shop-wrapp div.about-container h1{float:left; width:100%; text-align:center; margin-bottom:30px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.contact-wrapp{float:left; width:870px; background:#fff; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1); padding:25px 40px 25px; margin-top:22px; position:relative}
div.contact-wrapp h1{float:left; width:100%; text-align:center; margin-bottom:10px;}
div.contact-wrapp p.contact-copy{float:left; width:100%; line-height:16px; font-size:14px;}
div.contact-wrapp ul.contact-form{float:left; width:636px; margin-top:40px;}
div.contact-wrapp ul.contact-form li{float:left; width:400px; font-size:14px; margin-bottom:14px;}
div.contact-wrapp ul.contact-form li.title{float:left; width:236px; font-size:16px; text-transform:uppercase; }
div.contact-wrapp ul.contact-form li input.text{float:left; width:378px !important; border:1px solid #e5e5e5; color:#565555;  background:#fff;}
div.contact-wrapp ul.contact-form li.dd-contact-reason .dd,
div.contact-wrapp ul.contact-form li.dd-contact-reason .dd .ddChild{width:398px !important; background:#fff;}
div.contact-wrapp ul.contact-form li.dd-contact-reason .dd .ddTitle span.arrow{background-color:#FFF; opacity:0.5;}
div.contact-wrapp ul.contact-form li textarea.text{width:378px; height:130px; background:#fff;}
div.contact-wrapp ul.contact-form input.button-red{float:right; clear:both; margin-top:-10px;}
div.contact-wrapp ul.contact-form li p.e{float:left; width:360px; padding:4px 20px; background:#ea6b6b; color:#913535; -moz-border-radius:0px 0px 4px 4px; -webkit-border-radius:0px 0px 4px 4px; border-radius:0px 0px 4px 4px; margin-top:-2px; display:none; font-size:12px;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.vip-membership,div.vip-membership-login-wrapp{float:left; width:894px; background:#fff; -moz-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); -webkit-box-shadow:0px 0px 7px rgba(229, 229, 229, 1); box-shadow:0px 0px 7px rgba(229, 229, 229, 1); padding:25px 28px 40px; margin-top:22px; position:relative}
div.vip-membership div.membership-content{ float:left; width:656px; }
div.vip-membership h1{ float:left; width:100%; margin-bottom:30px; text-align:center;}
div.vip-membership img{float:left; margin-right:15px; }
div.vip-membership div.membership-content p{ float:left; width:656px; color:#565555; text-align:right;}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
div.membership-playing-cart{ float:right; width:420px; margin-top:25px;}
div.membership-playing-cart img{ float:left; margin-right:40px;}
div.membership-playing-cart div{ float:left; width:290px; text-align:right;}
div.membership-playing-cart div h3{float:left; width:100%; margin-bottom:15px;}
div.membership-playing-cart div p{ float:left; width:100%; line-height:16px; color:#565555;}
div.membership-btn-box{float:left;}
div.membership-btn-box{float:left; width:100%; text-align:center; border-top:1px solid #000; padding-top:40px;}
div.membership-btn-box p{ float:left; width:100% !important;}
div.membership-btn-box a{display:inline-block; width:155px; height:32px; line-height:32px; font-weight:bold; font-size:13px; color:#fff; text-transform:uppercase; margin:0px 6px; -moz-border-radius:4px; -webkit-border-radius:4px; border-radius:4px;}
div.membership-btn-box a.no-thanks{ background:#b3b3b3;}
div.membership-btn-box a.upgrade{ background:#cc2525;}
div.vip-membership-login-wrapp{ margin-top:30px; padding-top:30px;}
div.vip-membership-login-wrapp div.login{ padding:0px 60px 0px 65px;}
div.vip-membership-login-wrapp div.btn-fb-conect{ float:left; width:100%; text-align:center; margin-bottom:45px;}
div.vip-membership-login-wrapp div.btn-fb-conect a{ display:inline-block;}

.dd, .dd .ddTitle{ !important;}
.prize_img{ position:relative; left:25%; margin-bottom:20px; }
a.btn-green{display:inline-block; padding:0px 18px; height:30px; line-height:27px; border:1px solid #46780c; -moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; color:#fff;  text-transform:uppercase; font-size:14px; text-align:center; text-shadow:0px 2px 0px #666;
box-shadow:0px 0px 1px #000 inset,0px 0px 0px 4px #f0f0f0;
-webkit-box-shadow:0px 0px 1px #88def8 inset,0px 0px 0px 4px #f0f0f0;
-moz-box-shadow:0px 0px 1px #88def8 inset,0px 0px 0px 4px #f0f0f0;
background: #7ce139;
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzdjZTEzOSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9Ijc0JSIgc3RvcC1jb2xvcj0iIzY2YjMzMyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgPC9saW5lYXJHcmFkaWVudD4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
background: -moz-linear-gradient(top,  #7ce139 0%, #66b333 74%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#7ce139), color-stop(74%,#66b333));
background: -webkit-linear-gradient(top,  #7ce139 0%,#66b333 74%);
background: -o-linear-gradient(top,  #7ce139 0%,#66b333 74%);
background: -ms-linear-gradient(top,  #7ce139 0%,#66b333 74%);
background: linear-gradient(to bottom,  #7ce139 0%,#66b333 74%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7ce139', endColorstr='#66b333',GradientType=0 );}

a.btn-feedback{display:inline-block; padding:0px 18px; height:30px; line-height:27px; border:1px solid #584d77; -moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; color:#fff;  text-transform:uppercase; font-size:14px; text-align:center; text-shadow:0px 2px 0px #666;
box-shadow:0px 0px 1px #000 inset,0px 0px 0px 4px #f0f0f0;
-webkit-box-shadow:0px 0px 1px #88def8 inset,0px 0px 0px 4px #f0f0f0;
-moz-box-shadow:0px 0px 1px #88def8 inset,0px 0px 0px 4px #f0f0f0;
background: #939296;
background: -moz-linear-gradient(top,  #ccc 0%, #584d77 74%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ccc), color-stop(74%,#584d77));
background: -webkit-linear-gradient(top,  #ccc 0%,#584d77 74%);
background: -o-linear-gradient(top,  #ccc 0%,#584d77 74%);
background: -ms-linear-gradient(top,  #ccc 0%,#584d77 74%);
background: linear-gradient(to bottom,  #ccc 0%,#584d77 74%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ccc', endColorstr='#584d77',GradientType=0 );}

a.btn-purple{display:inline-block; padding:0px 18px; height:30px; line-height:27px; border:1px solid #584d77; -moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; color:#fff;  text-transform:uppercase; font-size:14px; text-align:center; text-shadow:0px 2px 0px #666;
box-shadow:0px 0px 1px #000 inset,0px 0px 0px 4px #f0f0f0;
-webkit-box-shadow:0px 0px 1px #88def8 inset,0px 0px 0px 4px #f0f0f0;
-moz-box-shadow:0px 0px 1px #88def8 inset,0px 0px 0px 4px #f0f0f0;
background: #939296;
background: -moz-linear-gradient(top,  #ccc 0%, #584d77 74%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ccc), color-stop(74%,#584d77));
background: -webkit-linear-gradient(top,  #ccc 0%,#584d77 74%);
background: -o-linear-gradient(top,  #ccc 0%,#584d77 74%);
background: -ms-linear-gradient(top,  #ccc 0%,#584d77 74%);
background: linear-gradient(to bottom,  #ccc 0%,#584d77 74%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ccc', endColorstr='#584d77',GradientType=0 );}

div.game-tips-pop{text-align:center;width:192px; height:337px; position:absolute; top:-3px; left:0px; background:url(../images/loader.gif) no-repeat center #fff; z-index:15;}
div.game-tips-pop a.btnclose{ float:right; position:absolute; right:6px; top:5px; z-index:1;}
div.game-tips-pop a.btnkeep{ float:left; position:absolute; left:6px; top:5px; z-index:1;}
div.game-tips-pop p{margin:10px 0;}

div.game-feedback-pop{text-align:center;width:192px; height:435px; position:absolute; top:-3px; left:0px; no-repeat center #fff; z-index:15; background:#fff; border: 1px #000 solid; border-radius: 5px; -moz-border-radius:5px; -webkit-border-radius:5px; }
div.game-feedback-pop a.btnclose{ float:right; position:absolute; right:6px; top:5px; z-index:1;}
div.game-feedback-pop a.btnkeep{ float:left; position:absolute; left:6px; top:5px; z-index:1;}
div.game-feedback-pop p{margin:10px 0;}

ul.social-footer{width:120px;float:right; margin:90px 0 0;}
ul.social-footer li{ float:left; width:auto !important; margin:0 0px 0 10px;}" ); 

// COLORS FOR BUTTONS
echo("
/* dark yellow shading */
.btn-dark-yellow-shading{
	border:1px solid #a88710 !important; 
	-moz-border-radius:3px !important; 
	-webkit-border-radius:3px !important; 
	border-radius:3px !important; 
	color:#000 !important;  
	text-shadow:0px 2px 0px #ffe400 !important;
	box-shadow:0px 0px 1px #fccd3c inset,0px 0px 0px 4px #f0f0f0 !important;
	-webkit-box-shadow:0px 0px 1px #fccd3c inset,0px 0px 0px 4px #f0f0f0 !important;
	-moz-box-shadow:0px 0px 1px #fccd3c inset,0px 0px 0px 4px #f0f0f0 !important;
	background:rgb(251,219,6) !important; /* Old browsers */
	background:-moz-linear-gradient(top, rgba(251,219,6,1) 0%, rgba(252,184,0,1) 74%) !important; /* FF3.6+ */
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(251,219,6,1)), color-stop(74%,rgba(252,184,0,1))) !important; /* Chrome,Safari4+ */
	background:-webkit-linear-gradient(top, rgba(251,219,6,1) 0%,rgba(252,184,0,1) 74%) !important; /* Chrome10+,Safari5.1+ */
	background:-o-linear-gradient(top, rgba(251,219,6,1) 0%,rgba(252,184,0,1) 74%) !important; /* Opera 11.10+ */
	background:-ms-linear-gradient(top, rgba(251,219,6,1) 0%,rgba(252,184,0,1) 74%) !important; /* IE10+ */
	background:linear-gradient(to bottom, rgba(251,219,6,1) 0%,rgba(252,184,0,1) 74%) !important; /* W3C */
	filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#fbdb06', endColorstr='#fcb800',GradientType=0 ) !important; /* IE6-9 */}

/* light yellow shading */
.btn-light-yellow-shading{
	border:1px solid #a69039 !important; 
	-moz-border-radius:3px !important; 
	-webkit-border-radius:3px !important; 
	border-radius:3px !important; 
	color:#fff !important;  
	text-shadow:0px 2px 0px #9b8012 !important;
	box-shadow:0px 0px 1px #e0c461 inset,0px 0px 0px 4px #f0f0f0 !important;
	-webkit-box-shadow:0px 0px 1px #e44b4b inset,0px 0px 0px 4px #f0f0f0 !important;
	-moz-box-shadow:0px 0px 1px #e44b4b inset,0px 0px 0px 4px #f0f0f0 !important;
	background:#f1de91 !important; /* Old browsers */
	background:-moz-linear-gradient(top, #f1de91 0%, #d5bb53 74%) !important; /* FF3.6+ */
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#f1de91), color-stop(74%,#d5bb53)) !important; /* Chrome,Safari4+ */
	background:-webkit-linear-gradient(top, #f1de91 0%,#d5bb53 74%) !important; /* Chrome10+,Safari5.1+ */
	background:-o-linear-gradient(top, #f1de91 0%,#d5bb53 74%) !important; /* Opera 11.10+ */
	background:-ms-linear-gradient(top, #f1de91 0%,#d5bb53 74%) !important; /* IE10+ */
	background:linear-gradient(to bottom, #f1de91 0%,#d5bb53 74%) !important; /* W3C */
	filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#f1de91', endColorstr='#d5bb53',GradientType=0 ) !important; /* IE6-9 */}

/* green shading */
.btn-green-shading{
	border:1px solid #46780c !important; 
	-moz-border-radius:3px !important; 
	-webkit-border-radius:3px !important; 
	border-radius:3px !important; 
	color:#fff !important;
	text-shadow:0px 2px 0px #666 !important;
	box-shadow:0px 0px 1px #000 inset,0px 0px 0px 4px #f0f0f0 !important;
	-webkit-box-shadow:0px 0px 1px #88def8 inset,0px 0px 0px 4px #f0f0f0 !important;
	-moz-box-shadow:0px 0px 1px #88def8 inset,0px 0px 0px 4px #f0f0f0 !important;
	background: #7ce139 !important;
	background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzdjZTEzOSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9Ijc0JSIgc3RvcC1jb2xvcj0iIzY2YjMzMyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgPC9saW5lYXJHcmFkaWVudD4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
	background: -moz-linear-gradient(top,  #7ce139 0%, #66b333 74%) !important;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#7ce139), color-stop(74%,#66b333)) !important;
	background: -webkit-linear-gradient(top,  #7ce139 0%,#66b333 74%) !important;
	background: -o-linear-gradient(top,  #7ce139 0%,#66b333 74%) !important;
	background: -ms-linear-gradient(top,  #7ce139 0%,#66b333 74%) !important;
	background: linear-gradient(to bottom,  #7ce139 0%,#66b333 74%) !important;
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7ce139', endColorstr='#66b333',GradientType=0 ) !important;}

/* purple shading */
.btn-purple-shading{
	border:1px solid #584d77 !important; 
	-moz-border-radius:3px !important; 
	-webkit-border-radius:3px !important; 
	border-radius:3px !important; 
	color:#fff !important;
	text-shadow:0px 2px 0px #666 !important;
	box-shadow:0px 0px 1px #000 inset,0px 0px 0px 4px #f0f0f0 !important;
	-webkit-box-shadow:0px 0px 1px #88def8 inset,0px 0px 0px 4px #f0f0f0 !important;
	-moz-box-shadow:0px 0px 1px #88def8 inset,0px 0px 0px 4px #f0f0f0 !important;
	background: #939296 !important;
	background: -moz-linear-gradient(top,  #ccc 0%, #584d77 74%) !important;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ccc), color-stop(74%,#584d77)) !important;
	background: -webkit-linear-gradient(top,  #ccc 0%,#584d77 74%) !important;
	background: -o-linear-gradient(top,  #ccc 0%,#584d77 74%) !important;
	background: -ms-linear-gradient(top,  #ccc 0%,#584d77 74%) !important;
	background: linear-gradient(to bottom,  #ccc 0%,#584d77 74%) !important;
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ccc', endColorstr='#584d77',GradientType=0 ) !important;}

/* blue shading */
a.btn-blue-shading{
	border:1px solid #30a7c8 !important; 
	-moz-border-radius:3px !important; 
	-webkit-border-radius:3px !important; 
	border-radius:3px !important; 
	color:#fff !important;
	text-shadow:0px 2px 0px #1988a8 !important;
	box-shadow:0px 0px 1px #88def8 inset,0px 0px 0px 4px #f0f0f0 !important;
	-webkit-box-shadow:0px 0px 1px #88def8 inset,0px 0px 0px 4px #f0f0f0 !important;
	-moz-box-shadow:0px 0px 1px #88def8 inset,0px 0px 0px 4px #f0f0f0 !important;
	background:rgb(84,213,250) !important; /* Old browsers */
	background:-moz-linear-gradient(top, rgba(84,213,250,1) 0%, rgba(80,200,234,1) 74%) !important; /* FF3.6+ */
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(84,213,250,1)), color-stop(74%,rgba(80,200,234,1))) !important; /* Chrome,Safari4+ */
	background:-webkit-linear-gradient(top, rgba(84,213,250,1) 0%,rgba(80,200,234,1) 74%) !important; /* Chrome10+,Safari5.1+ */
	background:-o-linear-gradient(top, rgba(84,213,250,1) 0%,rgba(80,200,234,1) 74%) !important; /* Opera 11.10+ */
	background:-ms-linear-gradient(top, rgba(84,213,250,1) 0%,rgba(80,200,234,1) 74%) !important; /* IE10+ */
	background:linear-gradient(to bottom, rgba(84,213,250,1) 0%,rgba(80,200,234,1) 74%) !important; /* W3C */
	filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#54d5fa', endColorstr='#50c8ea',GradientType=0 ) !important; /* IE6-9 */}

.btn-light-yellow{background:#d5bb53 !important;} /* light yellow */
.btn-light-blue{background:#50c8ea !important;} /* light blue */
.btn-light-gray{background:#b3b3b3 !important;} /* light gray */
.btn-light-red{ background:#cc2525 !important; } /* light red */
.btn-red-shading-no-border{
	color:#FFF !important;  
	text-shadow:0px 2px 2px #7c0202 !important; 
	-moz-box-shadow:0px 2px 5px rgba(0, 0, 0, 0.4) !important; 
	-webkit-box-shadow:0px 2px 5px rgba(0, 0, 0, 0.4) !important; 
	box-shadow:0px 2px 5px rgba(0, 0, 0, 0.4) !important;} /* red shading without border */

/* red shading */
.button-red-shading-white-border{
	border:1px solid #8e1818 !important; 
	-moz-border-radius:3px !important; 
	-webkit-border-radius:3px !important; 
	text-shadow:0px 2px 0px #7c0202 !important;
	box-shadow:0px 0px 1px #e44b4b inset,0px 0px 0px 4px #f0f0f0 !important;
	-webkit-box-shadow:0px 0px 1px #e44b4b inset,0px 0px 0px 4px #f0f0f0 !important;
	-moz-box-shadow:0px 0px 1px #e44b4b inset,0px 0px 0px 4px #f0f0f0 !important;
	background:#dd2020 !important; /* Old browsers */
	background:-moz-linear-gradient(top, #dd2020 24%, #b31919 100%) !important; /* FF3.6+ */
	background:-webkit-gradient(linear, left top, left bottom, color-stop(24%,#dd2020), color-stop(100%,#b31919)) !important; /* Chrome,Safari4+ */
	background:-webkit-linear-gradient(top, #dd2020 24%,#b31919 100%) !important; /* Chrome10+,Safari5.1+ */
	background:-o-linear-gradient(top, #dd2020 24%,#b31919 100%) !important; /* Opera 11.10+ */
	background:-ms-linear-gradient(top, #dd2020 24%,#b31919 100%) !important; /* IE10+ */
	background:linear-gradient(to bottom, #dd2020 24%,#b31919 100%) !important; /* W3C */
	filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#dd2020', endColorstr='#b31919',GradientType=0 ) !important; /* IE6-9 */}
	
.button-red-shading-black-border{
	border:1px solid #8e1818 !important; 
	-moz-border-radius:3px !important; 
	-webkit-border-radius:3px !important; 
	text-shadow:0px 2px 0px #7c0202 !important;
	box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #1d1d1d !important;
	-webkit-box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #1d1d1d !important;
	-moz-box-shadow:0px 0px 1px #c6c6c6 inset,0px 0px 0px 4px #1d1d1d !important;
	background:#dd2020 !important; /* Old browsers */
	background:-moz-linear-gradient(top, #dd2020 24%, #b31919 100%) !important; /* FF3.6+ */
	background:-webkit-gradient(linear, left top, left bottom, color-stop(24%,#dd2020), color-stop(100%,#b31919)) !important; /* Chrome,Safari4+ */
	background:-webkit-linear-gradient(top, #dd2020 24%,#b31919 100%) !important; /* Chrome10+,Safari5.1+ */
	background:-o-linear-gradient(top, #dd2020 24%,#b31919 100%) !important; /* Opera 11.10+ */
	background:-ms-linear-gradient(top, #dd2020 24%,#b31919 100%) !important; /* IE10+ */
	background:linear-gradient(to bottom, #dd2020 24%,#b31919 100%) !important; /* W3C */
	filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#dd2020', endColorstr='#b31919',GradientType=0 ) !important; /* IE6-9 */

}

/* gray shading */
.btn-gray-shading{ 
	border:1px solid #888 !important; 
	-moz-border-radius:3px !important; 
	-webkit-border-radius:3px !important; 
	border-radius:3px !important; 
	color:#fff !important;
	text-shadow:0px 2px 0px #4a4a4a !important;
	box-shadow:0px 0px 1px #e0c461 inset,0px 0px 0px 4px #f0f0f0; !important;
	-webkit-box-shadow:0px 0px 1px #e0c461 inset,0px 0px 0px 4px #f0f0f0; !important;
	-moz-box-shadow:0px 0px 1px #e0c461 inset,0px 0px 0px 4px #f0f0f0; !important;
	background:rgb(195,195,195) !important; /* Old browsers */
	background:-moz-linear-gradient(top, rgba(195,195,195,1) 0%, rgba(103,103,103,1) 74%) !important; /* FF3.6+ */
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(195,195,195,1)), color-stop(74%,rgba(103,103,103,1))) !important; /* Chrome,Safari4+ */
	background:-webkit-linear-gradient(top, rgba(195,195,195,1) 0%,rgba(103,103,103,1) 74%) !important; /* Chrome10+,Safari5.1+ */
	background:-o-linear-gradient(top, rgba(195,195,195,1) 0%,rgba(103,103,103,1) 74%) !important; /* Opera 11.10+ */
	background:-ms-linear-gradient(top, rgba(195,195,195,1) 0%,rgba(103,103,103,1) 74%) !important; /* IE10+ */
	background:linear-gradient(to bottom, rgba(195,195,195,1) 0%,rgba(103,103,103,1) 74%) !important; /* W3C */
	filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#c3c3c3', endColorstr='#676767',GradientType=0 ) !important; /* IE6-9 */}");
// END OF COLOR FOR BUTTONS

echo('#p_base { width:100%; height: 100%; text-align: center; position: absolute; top: 0px; left: 0px; opacity: 0.3; z-index: 210; background-color: #ccc; font-family: '.$_font.'; display: none; }
#p_content { width:800px; height: 600px; z-index: 215; background: #ffffff; opacity: 1; border: 1px #515358 solid; color: #464a4d; font-family: '.$_font.'; display: none; position: fixed; top: 0px; left: 0px; }');

echo('#t_base { width:100%; height: 100%; text-align: center; position: absolute; top: 0px; left: 0px; opacity: 0.3; z-index: 210; background-color: #ccc; font-family: '.$_font.'; display: none; }
#t_content { width:800px; height: 600px; z-index: 215; background: #ffffff; opacity: 1; border: 1px #515358 solid; color: #464a4d; font-family: '.$_font.'; display: none; position: fixed; top: 0px; left: 0px; }');

echo( '.leaderboard-left { float: left; width: 250px; text-align: center; font-size: 14pt; }
.leaderboard-left-head { width: 100%; text-align: center; background-color: #70787b; font-weight:bold; }
.leaderboard-left-lst { background-color: #37403f; width: 100%; height: 150px;overflow: auto; }
.leaderboard-left-lst-item { cursor: pointer; cursor: hand; background-color: #37403f; height: 27px; text-align: center; width: 100%; text-decoration: none; color: #c8c6c7; display: block; }
.leaderboard-left-lst-item:hover { background-color: #231f20; }
.leaderboard-left-lst-item-sel { background-color: #231f20; }' );

echo( '.leaderboard-right{ height:140px; margin-left: 20px; padding-botom: 10px; padding-left: 5px; padding-top: 10px; background-color: #37403f; overflow: auto; width: 670px; }
.leaderboard-right-element{float: left; padding-left: 5px; padding-right: 5px;}
.leaderboard-right-element-txt{overflow: hidden; width: 80px; height: 15px; text-align: center;}
.leaderboard-right-element-im{overflow: hidden; background: url( ../images/leader_board_bg.png ) no-repeat; width: 80px; height:80px;}
#leaderboard-content { height: 135px; } ' );

// echo( '.time_block{width:500px;height:100px;border:1px solid red;} .curr_time{border:1px solid blue;} ' );

echo('#ph_base { width:100%; height: 100%; text-align: center; position: absolute; top: 0px; left: 0px; opacity: 0.3; z-index: 210; background-color: #ccc; font-family: '.$_font.'; display: none; }
#ph_content { width:700px; height: 600px; z-index: 215; background: #ffffff; opacity: 1; border: 1px #515358 solid; color: #464a4d; font-family: '.$_font.'; display: none; position: fixed; top: 0px; left: 0px; }');

echo('.t_heading { height: 30px; text-align: center; font-family: '.$_font.'; font-size: 16px; font-weight: bold; }
.t_heading_con { height: 30px; float: left; }
.t_heading_con_al { margin-top: 7px; }
.brdr_top{ border-top: #ccc 1px solid; }
.brdr_left{ border-left: #ccc 1px solid; }
.brdr_right{ border-right: #ccc 1px solid; }
.brdr_bottom{ border-bottom: #ccc 1px solid; }
.content{ text-align: left; clear: both; }
.row{ height: 20px; clear: both; }
.col { height: 20px; float: left; }
.col_cont { margin-top: 3px; height: 17px; overflow: hidden; font-family: '.$_font.'; font-size: 14px; padding-left: 3px; }
');

?>