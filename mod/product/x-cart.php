
<input type="text" name="SITEUSERID" id="SITEUSERID" value="<?php $_SESSION?>" />
<div class="shop-wrapp">
  <div class="shop-conainer">
    <div class="product-details">
    	<div id="Step-1" style="display:block;">
        	<?php
			echo '<pre>';
			print_r($_SESSION);
			?>
        	Login
        </div>
        <div id="Step-2" style="display:none;">
        	Address
        </div>
        <div id="Step-3" style="display:none;">
        	Address
        </div>      
    </div>
  </div>
</div>
</div>