<html><head>
<title>K-Tok</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Londree aplikasi kasir untuk loundry">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo $this->config->item('assets').'AdminLTE/'; ?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $this->config->item('assets').'AdminLTE/'; ?>font-awesome-4.6.2/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo $this->config->item('assets').'AdminLTE/'; ?>ionicons-2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $this->config->item('assets').'AdminLTE/'; ?>dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo $this->config->item('assets').'AdminLTE/'; ?>plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/loading/jquery.loading.min.css">
	  
	<link rel="stylesheet" href="<?php echo $this->config->item('assets').'AdminLTE/'; ?>wd_custom/style.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <style>
    .login-box-msg{
      font-weight : bold;
      color : red;
      
    }
    html{
      overflow-x:hidden;
    }
  </style>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
      <h1>LOGIN USER</h1>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
      <p class="login-box-msg"><strong><?php echo $this->session->flashdata('alert') ?></strong></p>
      <div id="page-load">Mohon tunggu sebentar ....</div> 
  <form id='loginForm'action="<?=base_url()?>auth/login" method="post">
  <div class="form-group has-feedback">
	<input id="user" type="text" value="" name="user" class="form-control" placeholder="Email">
	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
	  <input id="password" type="password" value="" name="password" class="form-control" placeholder="Password">
	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
</div>
  <div class="row">
	<div class="col-xs-4">
	  <div class="checkbox icheck">
	  </div>
	</div><!-- /.col -->
	<div class="col-xs-4">
	  <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
	</div><!-- /.col -->
  <div class="col-xs-4">
    <div class="checkbox icheck">
    </div>
  </div><!-- /.col -->
  </div>
  </form>
  <div class="row">
  <div class="col-xs-4">
    <div class="checkbox icheck">
    </div>
  </div><!-- /.col -->
  <div class="col-xs-4">
    <a href="<?=base_url()?>daftar_akun"><button class="btn btn-primary btn-block btn-flat">Daftar Akun</button></a>
  </div><!-- /.col -->
  <div class="col-xs-4">
    <div class="checkbox icheck">
    </div>
  </div><!-- /.col -->
  </div>
  
		 
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    

    <script src="<?=base_url()?>assets/movable/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="<?=base_url()?>assets/movable/AdminLTE/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/movable/AdminLTE/js/jquery.validate.js"></script>
    <script src="<?=base_url()?>assets/movable/AdminLTE/js/messages_id.js"></script>
    <script src="<?=base_url()?>assets/loading/jquery.loading.min.js"></script>
<script>

$(document).ready( function(){

  $('#page-load').remove();
  $('#loginForm').fadeIn(500);

  $("#loginForm").validate({
    submitHandler : function(form) {
      $.ajax({
        url: $("#loginForm").attr('action'),
        type: 'post',
        data: $("#loginForm").serialize(),
        dataType: 'json',
        cache: false,
        beforeSend:function(x){
          $('.login-box-msg').html('<span class="fa fa-spin fa-spinner fa-lg"></span> ');
          $('html').loading({ message: 'Loading . . .' });

        },
        success:function (e) { 
          if(e=='ok'){
            window.location ='<?=base_url('dashboard')?>';
          }else{
            $('html').loading('stop');
            $('.login-box-msg').css('display','none').html(e).fadeIn(500).alert("login-box-msg");
          }
        }
      });
      return false;
    },

    errorPlacement : function(error, element) {
      error.appendTo(element.parent());
    }
  });

  

});
</script>
  
</body></html>
