function show_modal(modal) {
	$('#'+modal).show();
	element = $('#'+modal+' .uw-modal-content');
    element.css("position", "fixed");
    element.css("top", ($(window).height()/2 - element.outerHeight()/2)+ "px");
    element.css("left", ($(window).width()/2 - element.outerWidth()/2)  + "px");
}
$(document).ready(function(){
	$(".uw-close").click(function (event) {
		$(".uw-modal").hide();
	});
	$(".uw-modal").click(function (event) {
		$(".uw-modal").hide();
	}).children().click(function(e) {
		return false;
	});
});
