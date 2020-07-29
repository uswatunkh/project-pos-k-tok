<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Main</title>
	  
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo $this->base_url();?>assets/AdminLTE/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $this->base_url().'assets/AdminLTE/'; ?>font-awesome-4.6.2/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo $this->base_url().'assets/AdminLTE/'; ?>ionicons-2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo $this->base_url().'assets/AdminLTE/'; ?>dist/css/AdminLTE.min.css">
	  
	<link rel="stylesheet" href="<?php echo $this->base_url().'assets/AdminLTE/'; ?>/plugins/select2/select2.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	  
	<!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $this->base_url();?>assets/AdminLTE/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo $this->base_url();?>assets/AdminLTE/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo $this->base_url();?>assets/AdminLTE/wd_custom/style.css">
	<link rel="stylesheet" href="<?php echo $this->base_url();?>assets/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	  
	  
	   <!-- jQuery 2.1.4 -->
    <script src="<?php echo $this->base_url();?>assets/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="<?php echo $this->base_url();?>assets/AdminLTE/plugins/jQuery/jquery.visible.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
//      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo $this->base_url();?>assets/AdminLTE/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo $this->base_url();?>assets/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?php echo $this->base_url();?>assets/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo $this->base_url();?>assets/AdminLTE/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $this->base_url();?>assets/AdminLTE/dist/js/app.min.js"></script>
	  
	
	  
	<!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo $this->base_url();?>assets/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
	  
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo $this->base_url();?>assets/AdminLTE/dist/js/demo.js"></script>
	<script src="<?php echo $this->base_url();?>assets/AdminLTE/wd_custom/script.js"></script>
	<script src="<?php echo $this->base_url();?>assets/AdminLTE/plugins/select2/select2.full.min.js"></script>
	    
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>C</b>G</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>CRUD</b>GENERATOR </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
        </nav>
      </header>
		<?php $this->view('views/menu'); ?>
		<div class="content-wrapper">
		
		
		<?php $this->view('views/view/'.$view); ?>
		</div>
		<?php 
		  $version = $this->getVersionControl();
		if($version["framework_copyright"]==date('Y')){
			$copyright = $version["framework_copyright"];
		}
		else{
			$copyright = $version["framework_copyright"]."-".date('Y');
		}
		 ?>
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
		  <b>Framework Version</b> <?php echo $version["framework_display_version"]; ?>
		  <small> - Last update: <?php echo $version["framework_last_update"]; ?></small>
		</div>
        <strong>Copyright &copy; <?php echo $copyright; ?> <a href="http://indonesiait.com">CV. Indonesia IT</a>.</strong> All rights reserved. 
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

 

	  
  </body>
</html>
