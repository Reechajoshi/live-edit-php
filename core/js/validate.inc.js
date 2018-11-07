var $MXFUNCV,MXVALIDATE,MXOBFRM,FLGERR;
$(document).ready(function(e) {
	$MXFUNCV = {		
		required : function($value, el) { if(el.is("select")) return $value && $value.length > 0; else return $.trim($value).length > 0;	},
		checked  : function($value, el, param) { if(param) return el.find("input:checked").length >= param; else return el.find("input:checked").length > 0;	},	
		minlen   : function(value, el, param) { return (parseFloat(value.length) >= parseFloat(param)); },
		maxlen   : function(value, el, param) { return (parseFloat(value.length) <= parseFloat(param) && parseFloat(value.length) > 0);},
		rangelen : function(value, el, param) { var range = param.split("~"); return ((parseFloat(value.length) >= parseFloat(range[0])) && (parseFloat(value.length) <= parseFloat(range[1]))); },
		min      : function(value, el, param) { if(isNaN(value)) return false; return (parseFloat(value) >= parseFloat(param)); },
		max      : function(value, el, param) { if(isNaN(value)) return false; return (parseFloat(value) <= parseFloat(param)); },
		range    : function(value, el, param) { if(isNaN(value)) return false; var range = param.split("~"); return (parseFloat(value) >= parseFloat(range[0]) && parseFloat(value) <= parseFloat(range[1])); },
		alpha    : function(value) { return /^[a-z ._\-]+$/i.test(value);	},
		mobile   : function(value) { return /^[\+]?\(?([0-9-.+\/\() ]{10,20})$/.test(value);	},
		number   : function(value) { return /^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value);	},
		digits   : function(value) { return /^\d+$/.test(value); },
		alphanum : function(value) { return /^[a-z\d ._\-]+$/i.test(value); },
		equalto  : function(value, el,param) { return value == $("#"+param).val() && value != ""; },
		name     : function(value, el) { return value.match(/^[a-z0-9 ]+$/i);	},
		email    : function(value) { return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(value);	},
		loginname: function(value) { return /^[A-Za-z0-9_]{2,10}$/.test(value); },
		password : function(value) { return /^[A-Za-z0-9!@#$%^&*()_]{5,100}$/.test(value) },
		image    : function(value) { return /\.(jpg|jpeg|png|gif|bmp)$/i.test(value); },		
		date     : function(value) { return !/Invalid|NaN/.test(new Date(value));	},
		dateISO  : function(value) { return /^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(value);	},						
		accept   : function(value, el, param) { param = typeof param == "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif|bmp"; return value.match(new RegExp(".(" + param + ")$", "i")); },		
		url      : function(value) { return /^(http|https|ftp)\:\/\/[a-z\d\-\.]+\.[a-z]{2,3}(:[a-z\d]*)?\/?([a-z\d\-\._\?\,\'\/\\\+&amp;%\$#\=~])*$/i.test(value); }		
	};
	 
	var $MXMSGV = {
		'required' : '{TITLE} cannot be blank',
		'checked'  : 'Please select atleast {0} {TITLE}',
		'minlen'   : '{TITLE} length must be at least {0} characters',
		'maxlen'   : '{TITLE} length must be at max {0} characters',
		'rangelen' : '{TITLE} length must be between {0} and {1}',
		'min'  	   : '{TITLE} should be a number greater than or equal to {0}',
		'max'      : '{TITLE} should be a number less than or equal to {0}',
		'range'    : '{TITLE} should be a number between {0} and {1}.',		
		'alpha'    : '{TITLE} should be alphabetic characters only.',
		'mobile'   : '{TITLE} should be number[0-9], can contain brakets(), plus +, slash /, space, hypen -, dot .',
		'number'   : '{TITLE} should be number[0-9]',
		'digit'    : '{TITLE} should be only digits.',
		'alphanum' : '{TITLE} should be alphanumeric characters only.',	
		'equalto'  : '{TITLE} must be the same as {0}',
		'name'     : '{TITLE} can contain only letters and numbers and space',
		'email'    : '{TITLE} should be a valid email',
		'loginname': '{TITLE} should be more than 2 and maximum 10 characters, can contain only letters, numbers, and underscores',
		'password' : '{TITLE} should be more than five characters, should not contain any space',	
		'image'    : '{TITLE} should only contain image types',
		'date'     : '{TITLE} should be a valid date.',
		'dateISO'  : '{TITLE} should be a valid date (ISO).',
		'time'     : '{TITLE} is not a valid time',				
		'url'      : '{TITLE} is not a valid url'		
	};
	
	$setmxmsg = function(el,arrMsg,currV){
		if(el.is("select"))
			var parent = el.parent().parent();
		else if(el.is("input:file"))
		 	var parent = el.parent().parent().parent();
		else
			var parent = el.parent();
			
		if(arrMsg.length){			
			var cmsg = currV.msg;			
			if(cmsg){
				var msg = cmsg.replace(/\+/g,' ');
			} else {
				var msg = arrMsg.join(", ");
				msg = msg.replace("{TITLE}",el.attr("title"));
				msg = msg.replace(/{TITLE}/g,"");
			}
			var _xx = parent.find('p.e');
			if( _xx && _xx.html() )
			{
				if( _xx.html() != msg )
				{
					var err = $('<p class="e">'+msg+'</p>').hide();
					parent.append(err);			
					err.slideDown();
					FLGERR++;
				}
			}
			else
			{
				var err = $('<p class="e">'+msg+'</p>').hide();
				parent.append(err);			
				err.slideDown();
				FLGERR++;
			}
		}
		else
			parent.find('p.e').remove();
	}
	
	$.mxsetvalidate = function(el,currV){
		//alert(JSON.stringify(currV));		
		if(currV && el.length){										
			var arrFunc = currV.func.split(",");
			if(arrFunc.length){
				var arrMsg = [];					
				$.each(arrFunc, function(i,func) {
					var arrF = func.split(":");
					if(arrF[0]){						
						if(el.is("input,select,textarea")){																									
							var req = false; var val = $.trim(el.val());
							if(val == el.attr("title")) val = "";
							if(currV.func.indexOf("required") != -1) req = true;
							if(req || val){ var ret = $MXFUNCV[arrF[0]](val,el,arrF[1]); }
						} else {							
							var ret = $MXFUNCV[arrF[0]]("",el,arrF[1]);							
						}											
						if(ret==false) {
							var msg = $MXMSGV[arrF[0]];
							if(arrF[1]){								
								var params = arrF[1].split("~");
								$.each(params, function(i,param) { msg = msg.replace(new RegExp("\\{" + i + "\\}", "g"), params); });								
							}
							arrMsg.push(msg);
						}						
					}
				});
				$setmxmsg(el,arrMsg,currV);			
			}						
		}			
	}
	
	$.fn.mxvalidate = function(){
		var frm = $(this[0]);
		var objV = frm.find("input#mxValidate");
		if(objV.length){
			var strV = objV.val();
			// alert( strV );
			if( $.URLDecode )
			{
				var strJ = $.parseJSON($.URLDecode(strV));			
				//alert(JSON.stringify(strJ));									
				frm.find("input:text,input:password,textarea").live('focusout',function () {$.mxsetvalidate($(this),strJ[$(this).attr("id")]); });		
				frm.find("input:file,select").change(function () { $.mxsetvalidate($(this),strJ[$(this).attr("id")]); });
				frm.find("ul.mx-group input:checkbox").click(function () { var el = $(this).closest("ul.mx-group"); $.mxsetvalidate(el,strJ[el.attr("id")]); });
				frm.live('submit',function(){
					FLGERR = 0;
					frm.find("input:text,input:password,textarea,select").trigger('focusout');
					frm.find("input:file,select").trigger('change');		
					frm.find("ul.mx-group").each(function(index, el) { $.mxsetvalidate($(el),strJ[$(this).attr("id")]); });
					if(FLGERR) return false;
				});
			}	
		}
		return false;
	}
	
	$("form").each(function(){ $(this).mxvalidate(); });
});

/*
extent js validation function
$MXFUNCV["testfunc"] = function($value, element, param) { alert("HELLLO");};
add in php code after initializing form class

$FRM->validate["itemtovalidate"] = array("func"=>"testfunc","msg"=>"Please select atleast one ".$D["title"]);	
*/