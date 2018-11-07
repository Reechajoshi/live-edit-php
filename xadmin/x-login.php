<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MaxDigi Solutions > Login</title>
<link rel="SHORTCUT ICON" href="<?php echo ASITEURL; ?>/images/favicon.png" type="images/icon">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php echo ASITEURL; ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo ASITEURL; ?>/css/login.css" />
<?php if($MXSETTINGS["theme"] != "default") { ?>
<link rel="stylesheet" type="text/css" href="<?php echo ASITEURL; ?>/css/<?php echo $MXSETTINGS["theme"]; ?>.css" />
<?php } ?>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/config.js.php"></script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/lib/js/jquery-1.7.1.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/core/js/common.inc.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/core/js/mxdialog.inc.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ASITEURL; ?>/inc/js/common.inc.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ASITEURL; ?>/inc/js/login.inc.js"></script>
</head>
<body>
<form name="frmLogin" method="post" id="frmLogin" action="<?php echo ASITEURL; ?>/inc/ajax.inc.php" onsubmit="return false">
  <ul id="wrap-login">
    <li class="welcome">Welcome</li>
    <li>
      <input type="text" name="userName" id="userName" class="text" value="Login Name" title="Login Name" />
    </li>
    <li>
      <input type="text" name="userPass" id="userPass" class="text" value="Login Password" title="Login Password" />
    </li>
    <li>
      <input type="submit" name="btnLogin" id="btnLogin" class="btn-large" value="Login" />
      <input type="hidden" name="xAction" value="xLogin" />
      <input type="hidden" name="redirect" id="redirectMe" value="<?php echo $_REQUEST["redirect"]; ?>" />
      <input type="hidden" name="PGINFO" id="PGINFO" value="<?php echo getJsSettings();?>" />
      <input type="hidden" name="XJSON" id="XJSON" value="0" />
    </li>
  </ul>
</form>
</body>
</html>
