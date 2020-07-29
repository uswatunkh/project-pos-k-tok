

<p class="login-box-msg">Please insert new password.</p>
<form action="<?php echo backend_url().'auth/reset_password/'.$code; ?>" method="post">
  <div class="form-group has-feedback">
	<input type="password" value="" name="new" value="" id="new" pattern="^.{8}.*$" class="form-control" placeholder="New Password (at least 8 characters long)">
	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>
	
  <div class="form-group has-feedback">
	<input type="password" name="new_confirm" value="" id="new_confirm" class="form-control" placeholder="Confirm New Password ">
	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>
	
 <?php echo form_input($user_id);?>
 <?php echo form_hidden($csrf); ?>
	
<?php if($message!=""){?>
<div class="callout callout-primary"><ul class="ul-callout"><?php echo $message;?></ul></div>
<?php }?>
  <div class="row login-box-msg">
	<div class="col-12">
	  <a class="btn btn-info btn-flat" href="<?php echo backend_url().'auth/login'; ?>">Back</a>
	  <button type="submit" class="btn btn-primary btn-flat">Submit</button>
	</div><!-- /.col -->
  </div>
</form>





		 