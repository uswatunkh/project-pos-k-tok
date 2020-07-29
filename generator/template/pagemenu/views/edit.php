  
  <div class="box box-info">
	  	<div class="box-header">
		  <h3 class="box-title">Edit</h3>
		</div><!-- /.box-header -->
		 
	
	  	<form  id="dt_form" action="<?php echo backend_url().this_module();?>/update_action" class="form-horizontal" method="post">
		  <div class="box-body wd-form">
		
	
			  <div class="callout callout-warning validate-js-message">
                <h4><i class="icon fa fa-warning"></i> Warning</h4>
				
				 <?php echo wd_validation_errors(); ?>
              </div><input value="<?php echo $this->input->get('id'); ?>" type="hidden" name="id">
			<div class="form-group">
			  <label for="" class="col-sm-2 control-label">Name *</label>
			  <div class="col-sm-10"><input required value="<?php set_value_edit_text(wd_set_value('name'),$this->data['list']['name']); ?>" type="text" class="form-control" name="name" id="name" placeholder="Name" size="45">			  
			</div>
			</div>
		
			<div class="form-group">
			  <label for="" class="col-sm-2 control-label">href</label>
			  <div class="col-sm-10">
			  		 <input  value="<?php set_value_edit_text(wd_set_value('href'),$this->data['list']['href']); ?>" type="text" class="form-control" name="href" id="href" placeholder="Link page" size="45">			  </div>
			</div>

			<div class="form-group" id="base" 
			<?php if ($list['base_url']!=1) { echo 'style="display: none;"';} ?> 
			>
			  <label for="" class="col-sm-2 control-label">Base url</label>
			  <div class="col-sm-10">
					<?php 
						$isBase = array( 				
						 		array('0','No'), 				
						 		array('1','Yes')
							);
						
					
					foreach ( $isBase as $value) {
						$check = set_value_edit_check(wd_set_value('base_url'),$list['base_url'], $value[0]);
						echo "<label class='radio'><input $check value='$value[0]' class='minimal' type='radio'  name='base_url' > $value[1] </label>";
					}
					?>
				</div>
			</div>

			<div class="form-group">
			  <label for="" class="col-sm-2 control-label">Base url</label>
			  <div class="col-sm-10">
					<?php 
						$isBase = array( 				
						 		array('1','Show'),
						 		array('0','Hide') 				
							);
						
					
					foreach ( $isBase as $value) {
						$check = set_value_edit_check(wd_set_value('status'),$list['status'], $value[0]);
						echo "<label class='radio'><input $check value='$value[0]' class='minimal' type='radio'  name='status' > $value[1] </label>";
					}
					?>
				</div>
			</div>

			<div class="form-group">
			  <label for="" class="col-sm-2 ">Text</label>
			  <div class="col-sm-12"><textarea  name="text" id="text" class="textarea " placeholder="Text"><?php set_value_edit_text(wd_set_value('text'),$this->data['list']['text']); ?></textarea>			  
			</div>
			</div>

			
			  </div><!-- /.box-body -->
			
		  <span class="wd-box-helper"></span>		
		  <div class="wd-box-action">
			  <div class="">
				  <div class="wd-box-action-btn">
					<button type="submit" data-size="xs" data-style="expand-right" data-color="blue" class="btn ladda-button" >Save</button>
					<?php if($privilege['C']=="1"){ ?>
					<a href="<?php echo backend_url().this_module();?>/add" class="add-form btn btn-default">Back to add</a>
					<?php }	 ?>
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
$(".add-form" ).click(function() {        
	var link = $(this).attr("href");   
	$(".loader").load(link);

	return false;
});

$('#href').keyup(function(){
    if($(this).val().length!=0){
        $('#base').show('fast');
    }else{
        $('#base').hide('fast');
    }
});
</script>