

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
				  <label for="" class="col-sm-2 control-label">Judul*</label>
				  <div class="col-sm-10">

				  		 <input value="<?php echo wd_set_value('judul'); ?>" type="text" class="form-control" name="judul" id="judul" placeholder="Judul" size="50">			  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Deskripsi*</label>
				  <div class="col-lg-8 col-sm-10">

				  		 <textarea  name="deskripsi" id="deskripsi" class="textarea form-control" rows="5" placeholder="Deskripsi"><?php echo wd_set_value('deskripsi'); ?></textarea>			  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">File *</label>
				  <div class="col-sm-10">

				  		 <input type="file"  name="file" id="file" onchange="fileHandler()" >
			<div style="color: red" id="error_file"></div>			  </div>
				</div>		
				  </div><!-- /.box-body -->
				
			  <span class="wd-box-helper"></span>		
			  <div class="wd-box-action">
				  <div class="col-sm-offset-2">
					  <div class="wd-box-action-btn">
						<button type="submit" data-size="xs" data-style="expand-right" data-color="blue" class="btn ladda-button" >Save</button>
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

/* Generated via crud engine by indonesiait.com | 2016-11-19 05:37:23 */

-->