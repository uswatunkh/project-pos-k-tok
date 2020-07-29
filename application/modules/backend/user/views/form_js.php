<script>
$('#password').change(function(){		
	if($(this).val()!= ''){
		$('#re_password').attr('required', 'required');
		$('#dt_form').attr('onsubmit','return validateForm()');
	 	
	}else{
		$('#re_password').removeAttr('required');
		$('#dt_form').removeAttr('onsubmit');
		$('#al_password').hide();
	}
	
});
	
function validateForm() {
	
	   if($('#password').val() != $('#re_password').val()){
		$('#al_password').show();
		   	return false;
		}
	
}	
$(function () {
		
});
</script>




<!-- 

/* Generated via crud engine by indonesiait.com | 2020-07-27 10:34:33 */

-->