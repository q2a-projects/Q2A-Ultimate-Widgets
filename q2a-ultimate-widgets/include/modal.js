function show_modal(modal) {
	$('#'+modal).show();
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
