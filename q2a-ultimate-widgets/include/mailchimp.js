$(document).ready(function(){
	var isValidEmail = function(email) {
		var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
		return pattern.test(email);
	};
	var subscriptionMessageAlert = function(id, message, css_class) {
		$('#message-'+id).text(message);
		$('#message-'+id).removeAttr('class');
		$('#message-'+id).addClass('uw-mailchimp-message ' + css_class);
	};

	$(".uw-mailchimp-subscribe").click(function (event) {
		event.preventDefault();
		id = event.target.id;
		name = $('#input-name-' + id).val();
		lastname = $('#input-lastname-' + id).val();
		email = $('#input-email-' + id).val();
		if ( !isValidEmail( email )) {
			subscriptionMessageAlert(id, uw_mailchimp_invalid, 'alert');
		} else {
			subscriptionMessageAlert(id, uw_mailchimp_subscribing, 'success');
			qa_show_waiting_after(document.getElementById("message-"+id), true);
			$.ajax({
				url: uw_ajax_url,
				data: { action: "mailchimp-subscribe", name: name, lastname: lastname, email:email, widget_name:id},
				type: "POST"
			}).done(function(data) {
				qa_hide_waiting(document.getElementById("message-"+id));
				if(data=='1')
					subscriptionMessageAlert(id, uw_mailchimp_success, 'success');
				else
					subscriptionMessageAlert(id, uw_mailchimp_fail, 'alert');
			});
		}
	});
});