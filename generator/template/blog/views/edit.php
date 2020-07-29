

<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-info">
		<div class="box-header">
		  <h3 class="box-title">Edit <?php echo $sub_title;?></h3>
		</div><!-- /.box-header -->
		 
		  	<form enctype="multipart/form-data" id="dt_form" action="<?php echo backend_url().this_module();?>/update_action" class="form-horizontal" method="post">
			  <div class="box-body wd-form">
			
			<?php show_alert('success',$this->session->flashdata('success_message'));?>
			<?php show_alert('danger',$this->session->flashdata('danger_message'));?>
				  
				  <div class="callout callout-warning validate-js-message">
                    <h4><i class="icon fa fa-warning"></i> Warning</h4>
					
					 <?php echo wd_validation_errors(); ?>
                  </div><input value="<?php echo $this->input->get('id'); ?>" type="hidden" name="id">
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Judul blog</label>
				  <div class="col-sm-10"><input value="<?php set_value_edit_text(wd_set_value('judul'),$list['judul']); ?>" type="text" class="form-control" name="judul" id="judul" placeholder="Judul blog" size="50">			  
				</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Tanggal</label>
					<div class="col-sm-10"><input value="<?php set_value_edit_text(wd_set_value('tgl'),$list['tgl']); ?>" type="text" class="form-control" name="tgl" id="tgl" placeholder="Tes" size="10">			  
					</div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Deskripsi *</label>
				  <div class="col-sm-10"><textarea required name="deskripsi" id="deskripsi" class="textarea " placeholder="Deskripsi"><?php set_value_edit_text(wd_set_value('deskripsi'),$list['deskripsi']); ?></textarea>			  
				</div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">File</label>
				  <div class="col-sm-10">
				<?php
				if ($list['file']=='') {
					$img=$this->config->item('assets')."General/not-found.png";	
				}else{
					if (file_exists("public/blog_file/".$list['file'])) {
						$img=base_url()."public/blog_file/thumb/crop_".$list['file'];
					}else{
						$img=$this->config->item('assets')."General/not-found.png";
					}
				}
				?>
					<div class="img">
		    			<img id="preview_file" src="<?=$img?>" class="img-responsive" style="max-width:200px; max-height:200px" /> 
					</div>
					<div class="col-sm-12" style="padding-left: 0">
						<input type="file"  name="file" id="file" onchange="fileHandler()" >
					</div>
					<div style="color: red" id="error_file"></div>			  
				</div>
				</div>
	
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Tag</label>
				  <div class="col-sm-10">
				<select name="tag[]" id="tag" multiple="multiple" class="form-control select2" style="width: 100%;">
									
				<?php
				$new_list = explode(',', $list['tag']) ;
				if ($list['tag']!="") {
					foreach ($new_list as $key => $value) {
						echo "<option selected value='$value'> $value </option>";
					}		
				}
				?>
				</select> 			  
				</div>
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

/* Generated via crud engine by indonesiait.com | 2016-08-13 10:10:58 */

-->