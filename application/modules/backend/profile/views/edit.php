<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-info">
		<div class="box-header">
		  <h3 class="box-title">Edit <?php echo $sub_title;?></h3>
		</div><!-- /.box-header -->
		 
		  	<form id="dt_form" action="<?php echo backend_url().this_module();?>/update_action" class="form-horizontal" method="post">
			  <div class="box-body wd-form">
			
			<?php show_alert('success',$this->session->flashdata('success_message'));?>
			<?php show_alert('danger',$this->session->flashdata('danger_message'));?>
				  
				  <div class="callout callout-warning validate-js-message">
                    <h4><i class="icon fa fa-warning"></i> Warning</h4>
					 <?php echo wd_validation_errors(); ?>
                  </div>
				  
				<input value="<?php echo $this->urlcrypt->encode($user->id); ?>" type="hidden" name="id"> 
				  
				<div class="form-group">
				  <label for="inputPassword3" class="col-sm-2 control-label">Email*</label>
				  <div class="col-sm-10">
					<input value="<?php set_value_edit_text(wd_set_value('email'),$list['email']); ?>" type="text" class="form-control" name="email" id="email" placeholder="Email" size="50">
				  </div>
				</div>
				  
				<div class="form-group">
				  <label for="inputPassword3" class="col-sm-2 control-label">Username*</label>
				  <div class="col-sm-10">
					<input disabled value="<?php set_value_edit_text(wd_set_value('username'),$list['username']); ?>" type="text" class="form-control" name="username" id="username" placeholder="Username" size="50">
				  </div>
				</div>  
				  
				<div class="form-group">
				  <label for="inputEmail3" class="col-sm-2 control-label">Name*</label>
				  <div class="col-sm-10">
					<input value="<?php set_value_edit_text(wd_set_value('first_name'),$list['first_name']); ?>" type="text" class="form-control" name="first_name" id="first_name" placeholder="Name" size="50">
				  </div>
				</div>
				<div class="form-group">
				  <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
				  <div class="col-sm-10">
					<input value="<?php set_value_edit_text(wd_set_value('phone'),$list['phone']); ?>" type="text" class="form-control" name="phone" id="phone" placeholder="Name" size="50">
				  </div>
				</div>
				  
				<div class="form-group">
				  <label for="inputPassword3" class="col-sm-2 control-label">Password*</label>
				  <div class="col-sm-10">
					<input value="" type="password" class="form-control" name="password" id="password" placeholder="Password" size="50">
				  </div>
				</div>
				  
				<div class="form-group">
				  <label for="inputPassword3" class="col-sm-2 control-label">Password Confirm*</label>
				  <div class="col-sm-10">
					<input value="" type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Confirm Password" size="50">
				  </div>
				</div>
				  
				
			  </div><!-- /.box-body -->
				
			  <span class="wd-box-helper"></span>		
			  <div class="wd-box-action">
				  <div class="col-sm-offset-2">
					  <div class="wd-box-action-btn">
						<button type="submit" class="btn ladda-button"  data-color="blue" data-style="expand-right" data-size="xs">Save</button>
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
	</div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

