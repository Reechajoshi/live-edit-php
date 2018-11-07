<?php session_start();?>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/mod/user/x-user.inc.js"></script>

<div class="vip-membership">
  <div class="loader"></div>
  <?php
	echo( getVipConfirmation() );
  ?>
</div>
