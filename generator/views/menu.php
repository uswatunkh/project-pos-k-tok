<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
              <li class="header">MAIN NAVIGATION</li>
			  <li><a href="<?php echo $this->base_url();?>index.php/install"><i class="fa  fa-flash text-yellow"></i> <span>Fresh Install</span></a></li>
			  <li><a href="#"><i class="fa  fa-database text-yellow"></i> <span>Restore DB</span></a></li>
              <li><a href="<?php echo $this->base_url();?>index.php/simple"><i class="fa  fa-flash text-yellow"></i> <span>Create CRUD</span></a></li>
              <li><a id="template" href="<?php echo $this->base_url();?>index.php/simple/template"><i class="fa fa-clone text-yellow"></i> Install Module</a></li>  
              <li class="header">About</li>
              <li><a href="#"><i class="fa fa-newspaper-o text-yellow"></i>
				  <?php 
				  $version = $this->getVersionControl();
				  
				  ?>
				  <span>Version <?php echo $version["framework_display_version"];?></span></a>
			  </li>
              <li class="header">User</li>
              <li><a href="<?php echo $this->base_url();?>index.php/login/logout"><i class="fa fa-power-off text-red"></i> <span>Logout</span></a></li>
    		</ul>
			
        </section>
        <!-- /.sidebar -->
      </aside>
