<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Page</title>
<style>
body {
	font-family: Verdana, Helvetica, sans-serif;	
	font-weight: normal;
	color: #000000;
	text-decoration: none;
	margin:0px;
	padding:3px;
	outline:none;
}
#tbl-list {  
	font-size:12px;
	border-top:1px solid #000000;
	border-left:1px solid #000000;
}
#tbl-list td,#tbl-list th{
	border-right:1px solid #000000;	
	border-bottom:1px solid #000000;
	padding:3px;	
}

a.print-doc{ text-decoration:none; color:#333333; margin:10px 0px 10px 0px; font-size:11px; font-weight:bold;}

</style>
<script language="javascript" type="text/javascript" src="lib/js/jquery-1.4.4.min.js"></script>
<script language="javascript" type="text/javascript">
function setupPrint(col) {	
	if(window.opener == null)
		return;	
	var tblClone = window.opener.$("#tbl-list").clone(true);		
	$("#div-print").append(tblClone);
	$("#div-print a").each(function(){	$(this).parent().html($(this).text()); });	
	$("#div-print input").each(function(){	$(this).parent().remove(); });
	$("#div-print .action").remove();	
}
</script>
</head>
<body onLoad="setupPrint('<?php echo $_GET["col"]?>')">
<div id="div-print"></div>
</body>
</html>
