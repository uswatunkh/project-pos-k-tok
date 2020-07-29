<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo $this->config->item('assets');?>AdminLTE/dist/img/user.gif" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
       <p>
        <?php
        if (!$this->ion_auth->logged_in()){
          echo 'Anda belum Login';                                            
        }else{
          echo $user->first_name;
        }
        ?>
      </p>
      <a href="<?php echo backend_url()?>/auth/logout"><i class="fa  fa-power-off text-red"></i> Log Out</a>
    </div>
  </div>
  
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    
    <?php echo $this->rule->sidebar_menu();?>
    
    
    <!--            <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>-->
    <li class="header">SUPPORT</li>
    	<li><a href="<?php echo backend_url()?>support/"><i class="fa fa-life-bouy text-yellow"></i> <span>Warranty</span></a></li>
	<li class="header">USERS</li>
    	<li><a href="<?php echo backend_url()?>profile/edit"><i class="fa fa-circle-o text-yellow"></i> <span>Profile</span></a></li>
    	<li><a href="<?php echo backend_url()?>auth/logout"><i class="fa fa-power-off text-red"></i> <span>Logout</span></a></li>
  </ul>
</section>
<!-- /.sidebar -->
</aside>