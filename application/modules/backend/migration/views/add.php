

<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-info">
		<div class="box-header">
		  <h3 class="box-title"><?php echo $sub_title;?></h3>
		</div><!-- /.box-header -->
		 
		  	<form enctype="multipart/form-data" id="dt_form" action="<?php echo backend_url().this_module();?>/save_action" class="form-horizontal" method="post">
			  <div class="box-body wd-form">
			
			<?php show_alert('success',$this->session->flashdata('success_message'));?>
			<?php show_alert('danger',$this->session->flashdata('danger_message'));?>
				  
				  <div class="callout callout-warning validate-js-message">
                    <h4><i class="icon fa fa-warning"></i> Warning</h4>
					
					 <?php echo wd_validation_errors(); ?>
                  </div>
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Mode*</label>
				  <div class="col-sm-10">

				  		 
				<select name="mode" id="mode" class="form-control select2" style="width: 100%;">
				
				<?php 
				$list_mode = array( 				
				 		array('all','ALL'), 				
				 		array('add','ADD')
					);
				
				foreach ( $list_mode as $value) {
					echo "<option value='$value[0]'> $value[1] </option>";
						
				}
				?>
			</select> 			  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">File db*</label>
				  <div class="col-sm-10">

				  		 <input type="file"  name="file_db" id="file_db" onchange="file_dbHandler()" >
			<div style="color: red" id="error_file_db"></div>			  </div>
				</div>
				  </div><!-- /.box-body -->
				
			  <span class="wd-box-helper"></span>		
			  <div class="wd-box-action">
				  <div class="col-sm-offset-2">
					  <div class="wd-box-action-btn">
						<button type="submit" class="btn ladda-button"  data-color="blue" data-style="expand-right" data-size="xs">Save</button>
						<a href="<?php echo backend_url().this_module();?>" class="btn btn-default">Back to List</a>
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




<!-- 

/* Generated via crud engine by indonesiait.com | 2017-04-02 19:26:48 */

-->