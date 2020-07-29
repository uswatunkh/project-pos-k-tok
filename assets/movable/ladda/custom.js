document.addEventListener('DOMContentLoaded', function(){ 
	var l = Ladda.create( document.querySelector( 'button.ladda-button' ) );
	
	$('#dt_form').ajaxForm({
		 beforeSerialize: function(form, options) { 
		  for (instance in CKEDITOR.instances)
				CKEDITOR.instances[instance].updateElement();
		},
		beforeSend: function() {
			l.toggle();
		},
		uploadProgress: function(event, position, total, percentComplete) {
			$('.ladda-label').html(percentComplete+"%");
			l.setProgress(percentComplete/100);
		},
		success: function(xhr) {
		},
		complete: function(xhr) {
			l.setProgress(1);
			var n = xhr.responseText.search("<!DOCTYPE html>");
			var s = xhr.responseText.search("<!doctype html>");

			if (n>=0 || s>=0) {
				$( 'body' ).html(xhr.responseText);
			}else{
				location.href = xhr.responseText;
			}
		}
	});
}, false);
