// JavaScript Document
$(document).ready(function(e) {
    $('select#categoryID').live('change',function(event) {
		var catID = $(this).val();
		if($(this).val()) {			
			showMxLoader($(this));
			var obj = $(this);					
			var url = ASITEURL+"/mod/stock/x-stock.inc.php?categoryID="+$(this).val()+"&xAction=getProduct";								
			$.get(url, function(data) {	
				hideMxLoader();						
				if(data){
					//alert(catID);
					if(catID==3){
						$("div#wrap-form table tbody tr").eq(3).show();
					}else{
						$("div#wrap-form table tbody tr").eq(3).hide();
					}
					$("select#productID").html(data);
				}
			});
		}
        return false;
    });
});