var WINWIDTH   = 0;
var WINHEIGHT  = 0;
function setWindow(){	
	if(jQuery.browser.msie){ 
		WINWIDTH = document.documentElement.offsetWidth; 
		WINHEIGHT = document.documentElement.offsetHeight; 
	} else { 
		WINWIDTH = window.innerWidth;
		WINHEIGHT = window.innerHeight;
	}
}
setWindow();

jQuery.fn.toggleText = function() {
    var o = $(this[0]);	
	o.focus(function(){ if ($(this).val() == $(this).attr("title")){  $(this).val(""); } });
	o.blur(function() { if ($(this).val() == "") { $(this).val($(this).attr("title")); } });
};

function handleEscape(e){ if (e.keyCode == 27){ hideMxPopup(); }}

jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", ( $(window).height() - this.height() ) / 2+$(window).scrollTop() + "px");
    this.css("left", ( $(window).width() - this.width() ) / 2+$(window).scrollLeft() + "px");
    return this;
}

$.extend({URLEncode:function(c){var o='';var x=0;c=c.toString();var r=/(^[a-zA-Z0-9_.]*)/;
  while(x<c.length){var m=r.exec(c.substr(x));
    if(m!=null && m.length>1 && m[1]!=''){o+=m[1];x+=m[1].length;
    }else{if(c[x]==' ')o+='+';else{var d=c.charCodeAt(x);var h=d.toString(16);
    o+='%'+(h.length<2?'0':'')+h.toUpperCase();}x++;}}return o;},
  URLDecode:function(s){var o=s;var binVal,t;var r=/(%[^%]{2})/;
  while((m=r.exec(o))!=null && m.length>1 && m[1]!=''){b=parseInt(m[1].substr(1),16);
  t=String.fromCharCode(b);o=o.replace(m[1],t);}return o;}
});