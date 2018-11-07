<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $MXSETTINGS["page-title"];?>><?php echo $TPL->tplTitle?></title>
<link href="<?php echo ASITEURL; ?>/images/settings/<?php echo $MXSETTINGS["favicon"];?>" rel="SHORTCUT ICON" type="images/icon" />
<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' />
<link rel="stylesheet" type="text/css" href="<?php echo ASITEURL; ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo ASITEURL; ?>/css/inside.css" />
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/config.js.php"></script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/lib/js/jquery-1.7.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>/lib/js/tipsy-0.1.7/tipsy.css" />
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/lib/js/tipsy-0.1.7/jquery.tipsy.js"></script>
<link rel="Stylesheet" type="text/css" href="<?php echo SITEURL; ?>/lib/js/jscrollpane/jquery.jscrollpane.css" />
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/lib/js/jscrollpane/jquery.mousewheel.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/lib/js/jscrollpane/jquery.jscrollpane.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/core/js/mxdialog.inc.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/core/js/common.inc.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ASITEURL; ?>/inc/js/common.inc.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ASITEURL; ?>/inc/js/inside.inc.js"></script>
<?php if($TPL->pageType == "list" || $TPL->pageType == "trash") {?>
<link rel="stylesheet" type="text/css" href="<?php echo ASITEURL; ?>/css/list.css" />
<script language="javascript" type="text/javascript" src="<?php echo ASITEURL; ?>/inc/js/list.inc.js"></script>
<?php } else { ?>
<link rel="stylesheet" type="text/css" href="<?php echo ASITEURL; ?>/css/form.css" />
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/core/js/validate.inc.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ASITEURL; ?>/inc/js/form.inc.js"></script>
<?php } ?>
<?php if($MXSETTINGS["theme"] != "default") { ?>
<link rel="stylesheet" type="text/css" href="<?php echo ASITEURL; ?>/css/<?php echo $MXSETTINGS["theme"]; ?>.css" />
<?php } ?>
</head>
<body>
<div class="details-popup" style="display:none;"> 
  <a href="#" class="btn-close">X</a>
  <ul>
    <li>
      <label>Test</label>
      <p>Lorem ipsum</p>
    </li>
    <li>
      <label>Test</label>
      <p>Lorem ipsum</p>
    </li>
    <li>
      <label>Test</label>
      <p>Lorem ipsum</p>
    </li>
    <li>
      <label>Test</label>
      <p>Lorem ipsum</p>
    </li>
  </ul>
</div>
<input type="hidden" name="PGINFO" id="PGINFO" value="<?php echo getJsSettings();?>" />
<input type="hidden" name="XJSON" id="XJSON" value="0" />
<?php if($_SESSION['MSG']) { echo '<p id="err-main">'.$_SESSION['MSG'].'</p>'; $_SESSION['MSG'] = "";}	?>
<div id="top-nav"> <a class="logout right last" href="<?php echo ASITEURL;?>/?xAction=xLogout" title="logout">Logout</a> <a class="profile right" href="<?php echo ASITEURL;?>/admin-user-edit/?id=<?php echo $_SESSION["MXID"]; ?>" title="Click to view profile">Welcome : <?php echo $_SESSION["MXNAME"]; ?></a> <?php echo getAdminMenu();?> </div>
<div id="wrap-left"> <a href="<?php echo ASITEURL.'/'.$TPL->tplDefault; ?>/" id="admin-logo"><img src="<?php echo ASITEURL;?>/images/settings/<?php echo $MXSETTINGS["logo"];?>" /></a>
  <ul id="main-nav">
    <?php echo getAdminSMenu(); ?>
  </ul>
</div>
<div id="wrap-right">
<h1>CURRENTLY VIEWING : <?php echo $TPL->tplTitle; ?></h1>
