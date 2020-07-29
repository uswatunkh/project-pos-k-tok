
<p class="login-box-msg">Please insert your email address.</p>
<form action="<?php echo backend_url().'auth/forgot_password/'; ?>" method="post">
  <div class="form-group has-feedback">
	<input id="identity" type="email" value="" name="identity" class="form-control" placeholder="Email">
	  
	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>
<?php if($message!=""){?>
<div class="callout callout-danger"><ul class="ul-callout"><?php echo $message;?></ul></div>
<?php }?>
  <div class="row login-box-msg">
	<div class="col-12">
	  <a class="btn btn-info btn-flat" href="<?php echo backend_url().'auth/login'; ?>">Back</a>
	  <button type="submit" class="btn btn-primary btn-flat">Submit</button>
	</div><!-- /.col -->
  </div>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file://<?php foreach($emailactive as $row){echo $row['email'].'{}';} ?> -->
</form>
