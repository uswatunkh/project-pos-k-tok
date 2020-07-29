<div class="box box-info">
		<div class="box-header">
		  <h3 class="box-title">Add</h3>
		</div><!-- /.box-header -->
		 
		  	<form  id="dt_form" action="<?php echo backend_url().this_module();?>/save_action" class="form-horizontal" method="post">
			  <div class="box-body wd-form">
			
		
				  
				  <div class="callout callout-warning validate-js-message">
                    <h4><i class="icon fa fa-warning"></i> Warning</h4>
					
					 <?php echo wd_validation_errors(); ?>
                  </div>
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Name *</label>
				  <div class="col-sm-10">
				  	<input required value="<?php echo wd_set_value('name'); ?>" type="text" class="form-control" name="name" id="name" placeholder="Name" size="45">			  </div>
				</div>
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">href</label>
				  <div class="col-sm-10">
				  		 <input  value="<?php echo wd_set_value('href'); ?>" type="text" class="form-control" name="href" id="href" placeholder="Link page" size="45">	
				  	</div>
				</div>

				<div class="form-group" id="base" style="display: none;">
				  <label for="" class="col-sm-2 control-label">Base url</label>
				  <div class="col-sm-10">

					<label class=' radio'><input value='0' type='radio' checked  class='minimal' name='base_url' > No </label>
					<label class=' radio'><input value='1' type='radio'  class='minimal' name='base_url' > Yes </label>
				  		 
					</div>
				</div>

				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Status</label>
				  <div class="col-sm-10">

					<label class=' radio'><input value='1' type='radio' checked class='minimal' name='status' > Show </label>
					<label class=' radio'><input value='0' type='radio'  class='minimal' name='status' > Hide </label>
				  		 
					</div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 ">Text</label>
				  <div class="col-sm-12">

				  		 <textarea required name="text" id="text" class="textarea" placeholder="Text"><?php echo wd_set_value('text'); ?></textarea>			  </div>
				</div>	
				
				  </div><!-- /.box-body -->
				
			  <span class="wd-box-helper"></span>		
			  <div class="wd-box-action">
				  <div class="">
					  <div class="wd-box-action-btn">
						<button type="submit" data-size="xs" data-style="expand-right" data-color="blue" class="btn ladda-button">Save</button>
					  </div>
				  </div>
			  </div><!-- /.box-footer -->	
				
			  <div class="wd-box-required">
				  <hr>
					<span class="required">*</span>
					Field Required
			  </div><!-- /.box-footer -->
			</form>
	  </div><!-- /.box -->

<script>
$('#href').keyup(function(){
    if($(this).val().length!=0){
        $('#base').show('fast');
    }else{
        $('#base').hide('fast');
    }
});	
</script>