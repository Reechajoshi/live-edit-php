showMsg = function(caption, message){
	$.blockUI({ message : '<div style="width: 100%; background-color: #ccc; Text-align: left;" ><h3>'+caption+'</h3></div><div style="padding-top: 5px;" ><h3>'+message+'</h3></div><div style="padding-top: 7px;" ><button id="alertOK" >OK</button></div>'});
	$( '#alertOK' ).click(
		function(){ $.unblockUI() }
	);
}