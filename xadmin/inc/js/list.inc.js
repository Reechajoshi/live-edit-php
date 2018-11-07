function updateURL(currUrl, param, paramVal){
    var url = currUrl
    var newAdditionalURL = "";
    var tempArray = url.split("?");
    var baseURL = tempArray[0];
    var aditionalURL = tempArray[1]; 
    var temp = "";
    if(aditionalURL)
    {
        var tempArray = aditionalURL.split("&");
        for ( i=0; i<tempArray.length; i++ ){
            if( tempArray[i].split('=')[0] != param ){
                newAdditionalURL += temp+tempArray[i];
                temp = "&";
            }
        }
    }
    var rows_txt = temp+""+param+"="+paramVal;
    var finalURL = baseURL+"?"+newAdditionalURL+rows_txt;
    return finalURL;
}


function setListPage(){
	//$("ul#wrap-list-search").width(RIGHTSPACE);
	//$("ul#wrap-list-nav").width(RIGHTSPACE);	
}

function initListPage(){
	$('div#navigate a.search').click(function(){
		$(this).toggleClass("active search-active");	
		$("div#search-data").fadeToggle();
		return false;
	});
	
	$('div.mxpaging a.next,div.mxpaging a.prev').click(function(){
		var showRec = parseInt($("input#showRec").val());
		if(showRec){
			var newUrl = updateURL($(this).attr("href"),"showRec",showRec);		
			window.location.href = newUrl;
		}
		return false;
	});
	
	$('div.mxpaging input#showRec').change(function(){
		$("#frmSearch input#showRec").val($(this).val());
	});
	
	$("table.tbl-list tr").not(":first-child").mouseover(function(){
			$(this).find("td:first").addClass("over"); 
		}).mouseout(function(){ 
			$(this).find("td:first").removeClass("over"); 
		}).click(function(){ 
			$(this).parent().find("tr").removeClass('over').mouseout(function(){ 
				$(this).find("td:first").removeClass("over"); 
			});																																																																																																		
			$(this).find("td:first").addClass("over"); 
			$(this).find("td:first").unbind('mouseout');
		}
	);
	
	$('.chkAll').click(function () {					
		var status = $(this).attr('checked');
		if(!status)
			status = false;		
		$("table.tbl-list tr:not(:first)").each(function(){
			$(this).find("input").eq(0).attr('checked', status);
		});
	});
	
	$("div#page-action a.action").click(function(){									
		var action =  $(this).attr('rel');			
		var arrID = [];						
		$("table.tbl-list tr:not(:first)").each(function(){ 
			var input = $(this).find("input:eq(0)");
			if(input.is(":checked")){ 
				if(input.val())
					arrID.push(input.val()); 
			} 
		});
			
		if(arrID.length > 0){			
			var strID = arrID.join(",");
			var url = ASITEURL+"/inc/ajax.inc.php?id="+strID+"&xAction="+action+"&TBL="+PGINFO["TBL"]+"&PK="+PGINFO["PK"];
			showMxLoader();			
			$.get(url, function(data) {
				if(data == "OK") {								
					hideMxLoader();						
					$("table.tbl-list tr:not(:first)").each(function(){	
						var el = $(this);					
						if($(this).find("input:eq(0)").is(":checked")){ 
							$(this).children("td").each(function() { $(this).wrapInner("<div/>").children("div").slideUp(function() {el.remove();})});
						} 
					});																				
				}
			});						
			return false;				
		} else {
			mxMsg("Nothing selected to perform this action.");
		}								
		return false;
	});
	
	//==================Serach========
	
	var serachFLg = 0;
	$("#frmSearch input:text").each(function(){
		if ($(this).val() != $(this).attr("title") && $.trim($(this).val()) != ""){ serachFLg=1; }		
		$(this).toggleText();
	});
	$("#frmSearch input:radio,#frmSearch input:checkbox").each(function(){ if($(this).is(":checked")) {serachFLg=1; } });
	$("#frmSearch select").each(function(){ if($(this).val()) { serachFLg=1; }  });
	
	$("#frmSearch #btnReset").click(function() { window.location = ASITEURL+"/"+PGINFO["MODNAME"]+"-"+PGINFO["PGTYPE"]+"/"});	
	
	if(serachFLg){  $('div#navigate a.search').trigger("click"); }
	//===========
	
	//$("#frmSearch input:text").focus(function(){ if ($(this).val() == $(this).attr("title")){  $(this).val(""); } });
	//$("#frmSearch input:text").blur(function() { if ($(this).val() == "") { $(this).val($(this).attr("title")); } });
	$("#frmSearch #btnReset").click(function() { window.location = ASITEURL+"/"+PGINFO["MODNAME"]+"-"+PGINFO["PGTYPE"]+"/"});	
	
	$("a.delete-me").click(function(){
		alert("Have patience, i will do it in next few days.");
		return false;
	});
		
	$("a.print").click(function(){
		window.open(ASITEURL+'/x-print.php?col=0,3','Print','width=700,height=600,resizable=1,toolbar=0,menubar=1,scrollbars=1,status=1')	
	});
	$('.chkAll,input#showRec,a.edit').tipsy({gravity: 's',fade: true});
}