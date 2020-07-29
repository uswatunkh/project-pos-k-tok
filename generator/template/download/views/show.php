

<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-info">
		<div class="box-header">
		  <h3 class="box-title">Edit <?php echo $sub_title;?></h3>
		</div><!-- /.box-header -->
		 
		  	<form id="dt_form" action="<?php echo backend_url().this_module();?>" class="form-horizontal" method="post">
			  <div class="box-body wd-form">
			
			<?php show_alert('success',$this->session->flashdata('success_message'));?>
			<?php show_alert('danger',$this->session->flashdata('danger_message'));?>
				  
				  <div class="callout callout-warning validate-js-message">
                    <h4><i class="icon fa fa-warning"></i> Warning</h4>
					
					 <?php echo wd_validation_errors(); ?>
                  </div><input value="<?php echo $this->input->get('id'); ?>" type="hidden" name="id">
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Judul*</label>
				  <div class="col-sm-10"><input disabled value="<?php set_value_edit_text(wd_set_value('judul'),$list['judul']); ?>" type="text" class="form-control" name="judul" id="judul" placeholder="Judul" size="50">			  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Deskripsi*</label>
				  <div class="col-sm-10"><textarea disabled name="deskripsi" id="deskripsi" class="textarea textarea-wcwg" placeholder="Deskripsi"><?php set_value_edit_text(wd_set_value('deskripsi'),$list['deskripsi']); ?></textarea>			  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">File</label>
				  <div class="col-sm-10"><input disabled value="<?php set_value_edit_text(wd_set_value('file'),$list['file']); ?>" type="text" class="form-control" name="file" id="file" placeholder="File" size="50">			  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Date</label>
				  <div class="col-sm-10"><input disabled value="<?php set_value_edit_text(wd_set_value('date'),$list['date']); ?>" type="text" class="form-control" name="date" id="date" placeholder="Date" size="50">			  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Author</label>
				  <div class="col-sm-10">
			<select disabled name="author" class="form-control select2" style="width: 100%;">
				<option value="">Please Select</option>
				<?php 
					foreach($tb_wd_users as $rows){
						echo "<option value='".$rows['id']."' ".set_value_edit_select(wd_set_value('author'),$rows['id'],$list['author'])." >".$rows['username']."</option>";
					}
				?>
			</select>
						  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Downloader</label>
				  <div class="col-sm-10"><input disabled value="<?php set_value_edit_text(wd_set_value('downloader'),$list['downloader']); ?>" type="text" class="form-control" name="downloader" id="downloader" placeholder="Downloader" size="50">			  </div>
				</div>
				  </div><!-- /.box-body -->
				
			  <span class="wd-box-helper"></span>		
			  <div class="wd-box-action">
				  <div class="col-sm-offset-2">
					  <div class="wd-box-action-btn">						
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

/* Generated via crud engine by indonesiait.com | 2016-11-19 05:50:58 */

-->