<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php if(isset($layout_title))echo $layout_title; ?></title>
	  
	<meta name="description" content="<?php if(isset($meta_desc))echo $meta_desc; ?>"/>  
	  
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo $this->config->item('assets');?>AdminLTE/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $this->config->item('assets').'AdminLTE/'; ?>font-awesome-4.6.2/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo $this->config->item('assets').'AdminLTE/'; ?>ionicons-2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo $this->config->item('assets').'AdminLTE/'; ?>dist/css/AdminLTE.css">
	  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php 
		if(isset($layout_includes['css']) AND count($layout_includes['css']) > 0):
			foreach($layout_includes['css'] as $css): 
	?>
	<link rel="stylesheet" href="<?php echo $css['file']; ?>"<?php echo ($css['options'] === NULL ? '' : ' media="' . $css['options'] . '"'); ?>>
	<?php 
			endforeach;
		endif; 
	?>
	
	  
	<!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $this->config->item('assets');?>AdminLTE/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo $this->config->item('assets');?>AdminLTE/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('assets');?>AdminLTE/wd_custom/style.css">
	<link rel="stylesheet" href="<?php echo $this->config->item('assets');?>AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	  
	  
	<?php
	  if(isset($layout_includes['js']) AND count($layout_includes['js']) > 0): ?>
		<?php foreach($layout_includes['js'] as $js): ?>
			<?php if($js['options'] !== NULL AND $js['options'] == 'header'): ?>
				<script src="<?php echo $js['file']; ?>"></script>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>    
	  
	<script>
	   var JS_BASE_URL = '<?php echo backend_url();?>';
	</script>  
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?=base_url()?>backend" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>P</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>PANEL</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo $this->config->item('assets');?>AdminLTE/dist/img/user.gif" class="user-image" alt="User Image">
                  <span class="hidden-xs">
					
				<?php
					if (!$this->ion_auth->logged_in()){
						echo 'Not Logged';                                            
					}else{
						echo $user->first_name.' <i class="fa  fa-chevron-down"></i>'; 
					}
				?>
					  
				  </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo $this->config->item('assets');?>AdminLTE/dist/img/user.gif" class="img-circle" alt="User Image">
                    <p>
                    <?php
						if (!$this->ion_auth->logged_in()){
							echo 'Not Logged';                                            
						}else{
							echo $user->first_name.' '.$user->last_name;
							if ($this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'),$this->config->item('admin_group', 'ion_auth')))){
					
					?>
                    <small><a href="#" title="Autentikasi pengguna aplikasi ini"><i class="fa fa-key"></i> Autentikasi</a></small>
					<?php
					}}
					?> 
					<small>
					<?php
							echo "login as : ";
						foreach ($user_groups as $value) {
							echo ucwords(str_replace('_', ' ', $value["name"])).' | ';
						}
					?>
					</small>  
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo backend_url()?>profile/edit" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo backend_url()?>/auth/logout" class="btn btn-default btn-flat">Log out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
		<?php echo $this->load->view('templates/backend/menu'); ?>
		
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
				<section class="content-header">
				  <h1>
					<?php
					if(!isset($primary_title)){
						echo "Judul Utama";
					}else{
						echo $primary_title;    
					}                        
					?>
					<small>
					<?php 
					if(!isset($sub_primary_title)){
						echo "Sub judul utama";
					}else{
						echo $sub_primary_title;    
					}       
					?>
					</small>
				  </h1>
				  <ol class="breadcrumb">
					<?php echo $this->breadcrumb->output()?>
				  </ol>
					
				</section>
			
				<?php echo $this->load->view($view); ?>
		</div>
	  
	  <?php 
	  	$version = getVersionControl();
		if($version["copyright"]==date('Y')){
			$copyright = $version["copyright"];
		}
		else{
			$copyright = $version["copyright"]."-".date('Y');
		}
	  ?>
	  		
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
		  <b>Framework Version</b> <?php echo $version["framework_display_version"]; ?>
		  <?php 
			  if($version["git_version_number"]=="0"){
		  ?>
			  <small> - Last update: <?php echo $version["framework_last_update"]; ?></small>
		  <?php
			}
			else
			{
		  ?>
		   | 
          <b>CMS Version</b> <?php echo $version["display_version"]; ?> 
		  <small> - Last update: <?php echo $version["last_update"]; ?></small>
		  <?php
			}
		  ?>
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

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/jQuery/jquery.visible.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
//      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo $this->config->item('assets');?>AdminLTE/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- daterangepicker -->
    <script src="<?php echo $this->config->item('assets');?>AdminLTE/moment.min.js"></script>
    
	   <!-- Slimscroll -->
    <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $this->config->item('assets');?>AdminLTE/dist/js/app.js"></script>
	  
	<?php
	  if(isset($layout_includes['js']) AND count($layout_includes['js']) > 0): ?>
		<?php foreach($layout_includes['js'] as $js): ?>
			<?php if($js['options'] == NULL AND $js['options'] !== 'header'): ?>
				<script src="<?php echo $js['file']; ?>"></script>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?> 
	  
	<?php
	  if(isset($layout_includes['inline']) AND count($layout_includes['inline']) > 0): ?>
		<?php foreach($layout_includes['inline'] as $inline): ?>
				<?php echo $inline['file']; ?>
		<?php endforeach; ?>
	<?php endif; ?>   
	  
	  
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo $this->config->item('assets');?>AdminLTE/dist/js/demo.js"></script>
	<script src="<?php echo $this->config->item('assets');?>AdminLTE/wd_custom/script.js"></script>
  </body>
</html>
