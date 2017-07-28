$(document).ready(function(){
	mode = doCookie('nightmode');
	//alert(mode);
	if(mode==1)
		$('*').toggleClass('night-mode');
});

function uw_font_smaller(elem){
	$('.entry-content').each(function(){
		var k =  parseInt($(this).css('font-size')); 
		var redSize = k*0.9 ; //here, you can give the percentage( now it is reduced to 90%)
		$(this).css('font-size',redSize);  
	});
}
function uw_font_larger(elem){
	$('.entry-content').each(function(){
		var k =  parseInt($(this).css('font-size')); 
		var redSize = k*1.19 ; //here, you can give the percentage( now it is reduced to 90%)
		$(this).css('font-size',redSize);  
	});
}
function uw_font_reset(elem){
	$('.entry-content').css('font-size', '');
}
function uw_night_mode(elem){
	mode = doCookie('nightmode');
	if(mode==1)
		doCookie('nightmode',0);
	else
		doCookie('nightmode',1);
	$('*').toggleClass('night-mode');
}
