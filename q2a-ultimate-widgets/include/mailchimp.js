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


	$("#useo_save_meta").click(function (e) {
		qa_show_waiting_after(document.getElementById('useo_buttons_container_meta'), true);
		var metas = new Array();
		if($('#useo-meta-editor-title').val().length !== 0){
			var title = $('#useo-meta-editor-title').val();
		}
		if($('#useo-meta-editor-description').val().length !== 0){
			var description = $('#useo-meta-editor-description').val();
		}
		if($('#useo-meta-editor-keywords').val().length !== 0){
			var keywords = $('#useo-meta-editor-keywords').val();
		}
		var meta_info = JSON.stringify({title: title, description: description, keywords: keywords});
		$.ajax({
			url: useo_ajax_url,
			data: { action: "meta-save", postid: useo_postid,data: meta_info },
			type: "POST"
		}).done(function(data) {

			qa_hide_waiting(document.getElementById('useo_buttons_container_meta'));
		});
		e.preventDefault();
	});

	$("#useo_save_social").click(function (e) {
		qa_show_waiting_after(document.getElementById('useo_buttons_container_social'), true);
		var metas = new Array();
		if($('#useo-og-sitename').val().length !== 0){
			var og_sitename = $('#useo-og-sitename').val();
		}
		if($('#useo-og-title').val().length !== 0){
			var og_title = $('#useo-og-title').val();
		}
		if($('#useo-og-description').val().length !== 0){
			var og_description = $('#useo-og-description').val();
		}
		if($('#useo-og-url').val().length !== 0){
			var og_url = $('#useo-og-url').val();
		}
		if($('#useo-og-image').val().length !== 0){
			var og_image = $('#useo-og-image').val();
		}
		if($('#useo-tc-title').val().length !== 0){
			var tc_title = $('#useo-tc-title').val();
		}
		if($('#useo-tc-description').val().length !== 0){
			var tc_description = $('#useo-tc-description').val();
		}
		if($('#useo-tc-image').val().length !== 0){
			var tc_image = $('#useo-tc-image').val();
		}
		if($('#useo-tc-handler').val().length !== 0){
			var tc_handler = $('#useo-tc-handler').val();
		}
		if($('#useo-gp-image').val().length !== 0){
			var gp_image = $('#useo-gp-image').val();
		}
		
		var meta_info = JSON.stringify({'og-sitename': og_sitename, 'og-title': og_title, 'og-description': og_description, 'og-url': og_url, 'og-image': og_image, 'tc-title': tc_title, 'tc-description': tc_description, 'tc-image': tc_image, 'tc-handler': tc_handler, 'gp-image': gp_image});
		$.ajax({
			url: useo_ajax_url,
			data: { action: "social-save", postid: useo_postid,data: meta_info },
			type: "POST"
		}).done(function(data) {

			qa_hide_waiting(document.getElementById('useo_buttons_container_social'));
		});
		e.preventDefault();
	});

});