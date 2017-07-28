function close_alert(elem){
	$(elem).parent().hide();
	doCookie($(elem).attr('closed-box'), 1);
}
