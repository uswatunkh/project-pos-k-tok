<section class="content-header">
  <h1>
	<i class="fa fa-dashboard"></i> Fresh Install <small></small>
  </h1>
  <ol class="breadcrumb"><li>Home</li><li>Fresh Install</li></ol>
</section>


<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-info">
		<div class="box-header">
		  <h3 class="box-title">Fresh Install</h3>
		</div><!-- /.box-header -->
		 
		<form id="dt_form" action="<?php echo $this->base_url();?>index.php/install/fresh" class="form-horizontal" method="post">
			  <div class="box-body wd-form">
				<div class="row">
					<div class="col-sm-12">
						
						    <?php 
							$db_config_path = '../application/config/database.php';
							if(!is_writable($db_config_path)){?>
						    <div class="col-sm-12">
								<p class="error">Please make the application/config/database.php file writable first. <br>
									<strong>Example</strong>: <code>chmod 777 application/config/database.php</code> <br><br>
								</p>
						    </div>
								<?php } ?>
						
						<?php if(isset($message)) {echo '<p class="error">' . $message . '</p>';}?>
						<div class="form-group">
						  <label for="" class="col-sm-2 control-label">Hostname*</label>
						  <div class="col-sm-8">
							<input value="localhost" type="text" class="form-control" name="hostname" id="hostname" placeholder="Hostname" size="50">
						  </div>
						</div>

						<div class="form-group">
						  <label for="" class="col-sm-2 control-label">MySQL Username*</label>
							<div class="col-sm-10">
								<input value="root" type="text" class="form-control inline" name="username" id="username" placeholder="MySQL Username" size="50">
							</div>
						</div>
						
						<div class="form-group">
						  <label for="" class="col-sm-2 control-label">MySQL Password</label>
							<div class="col-sm-10">
								<input value="" type="password" class="form-control inline" name="password" id="password" placeholder="MySQL Password" size="50">
							</div>
						</div>
						<div class="form-group">
						  <label for="" class="col-sm-2 control-label">DB name*</label>
							<div class="col-sm-10">
								<input value="" type="text" class="form-control inline" name="database" id="database" placeholder="Database Password" size="50">
							</div>
						</div>
					</div> 
				</div>
				  
				
				
				
			  </div><!-- /.box-body -->
				
			  <span class="wd-box-helper"></span>		
			  <div class="wd-box-action">
				  <div class="col-sm-offset-2">
					  <div class="wd-box-action-btn">
						<button type="submit" class="btn btn-info">Install</button>
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


<script>
$(function() {
		var no = 2;
		$(".select2").select2();
	
     	
	
		
});
</script>

