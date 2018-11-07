<?php
	echo( ' <div class="product-list-wrapp game-inner-product"  >
				<h2 class="product-list-title" style="width: 100%; padding: 0px;" >NU Leader Board<span class="text-gradiant"></span></h2>
				
				<table ><tr><td>
					<div class="leaderboard-left" style="clear: both;" >
						<div class="leaderboard-left-head" >LEADERBOARD</div>
						<div class="leaderboard-left-lst" >
							<div><a class="leaderboard-left-lst-item" onClick="handleLeaderBoard(this, 1);" >ME</a></div>
							<div><a class="leaderboard-left-lst-item leaderboard-left-lst-item-sel" onClick="handleLeaderBoard(this, 2);">OVERALL</a></div>
							<!--div><a class="leaderboard-left-lst-item" onClick="handleLeaderBoard(this, 3);">NU FRIENDS</a></div-->
							<!--div><a class="leaderboard-left-lst-item" onClick="handleLeaderBoard(this, 4);">BIGGEST WIN</a></div-->
							<!--div><a class="leaderboard-left-lst-item" onClick="$(\'.scroll-pane\').jScrollPane();">BIGGEST LOSS</a></div-->
							<!--div><a class="leaderboard-left-lst-item" onClick="handleLeaderBoard(this, 5);">BEST %</a></div-->
						</div>
					</div>
				</td>	
				<td valign="middle" >
					<div class="leaderboard-right" >
						<div id="leader-loading" style="text-align: center; height: 100%" ><img src="'.SITEURL.'/images/loader.gif"></div>
						<div id="leaderboard-content" class="scroll-pane" style="display: block;" >
							<!--table><tr>
								<td>
									<div class="leaderboard-right-element" >
										<div class="leaderboard-right-element-txt" >NAME</div>
										<div class="leaderboard-right-element-im" ></div>
										<div class="leaderboard-right-element-txt" >SCORE</div>
									</div>
								</td>
							</tr></table-->
						</div>
					</div>
				</td></tr></table>	
				<script>
					$(document).ready(function(){
						$(".scroll-pane").jScrollPane();
						loadleaderboard( 2 );
					});
				</script>
				
				<!-- styles needed by jScrollPane - include in your own sites -->
				<link type="text/css" href="'.SITEURL.'/inc_mg/slider/jquery.jscrollpane.css" rel="stylesheet" media="all" />

				<!-- the mousewheel plugin -->
				<script type="text/javascript" src="'.SITEURL.'/inc_mg/slider/jquery.mousewheel.js"></script>
				<!-- the jScrollPane script -->
				<script type="text/javascript" src="'.SITEURL.'/inc_mg/slider/jquery.jscrollpane.min.js"></script>
				
				<script type="text/javascript" id="sourcecode">
					$(function()
					{
						
					});
				</script>
				
			</div>' );
?>