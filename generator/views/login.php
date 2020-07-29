<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Auth Check</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo $this->base_url().'assets/AdminLTE/'; ?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $this->base_url().'assets/AdminLTE/'; ?>font-awesome-4.6.2/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo $this->base_url().'assets/AdminLTE/'; ?>ionicons-2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $this->base_url().'assets/AdminLTE/'; ?>dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo $this->base_url().'assets/AdminLTE/'; ?>plugins/iCheck/square/blue.css">
	  
	<link rel="stylesheet" href="<?php echo $this->base_url().'assets/AdminLTE/'; ?>wd_custom/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo $this->core_url(); ?>"><b>Auth</b>Check</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
	 <p class="login-box-msg"><?php echo date("F j, Y, g:i a");?> | Insert Auth Code</p>
		<form action="<?php echo $this->base_url().'index.php/login/login'; ?>" method="post">
		  <div class="form-group has-feedback">
			  <input id="password" type="password" value="" name="password" class="form-control" placeholder="Password">
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
		</div>
		<?php
			$message = "";
			if($message!=""){?>
		<div class="callout callout-danger"><ul class="ul-callout"><?php echo $message;?></ul></div>
		<?php }?>
		  <div class="row">
			<div class="col-xs-12">
			  <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
			</div><!-- /.col -->
		  </div>
		</form>

	

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $this->base_url().'assets/AdminLTE/'; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo $this->base_url().'assets/AdminLTE/'; ?>bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo $this->base_url().'assets/AdminLTE/'; ?>plugins/iCheck/icheck.min.js"></script>
 </body>
</html>