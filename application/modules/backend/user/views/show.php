

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
				  <label for="" class="col-sm-2 control-label">Nama</label>
				  <div class="col-sm-10"><input disabled value="<?php set_value_edit_text(wd_set_value('nama'),$list['nama']); ?>" type="text" class="form-control" name="nama" id="nama" placeholder="Nama" size="50">			  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Email</label>
				  <div class="col-sm-10"><input disabled value="<?php set_value_edit_text(wd_set_value('email'),$list['email']); ?>" type="text" class="form-control" name="email" id="email" placeholder="Email" size="50">			  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Alamat</label>
				  <div class="col-sm-10"><input disabled value="<?php set_value_edit_text(wd_set_value('alamat'),$list['alamat']); ?>" type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" size="50">			  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Password</label>
				  <div class="col-sm-10"><input disabled value="" type="password" class="form-control" name="password" id="password" placeholder="Password" size="50">			  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Jenis</label>
				  <div class="col-sm-10"><input disabled value="<?php set_value_edit_text(wd_set_value('jenis'),$list['jenis']); ?>" type="text" class="form-control" name="jenis" id="jenis" placeholder="Jenis" size="50">			  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Id_pemilik</label>
				  <div class="col-sm-10"><input disabled value="<?php set_value_edit_text(wd_set_value('id_pemilik'),$list['id_pemilik']); ?>" type="text" class="form-control" name="id_pemilik" id="id_pemilik" placeholder="Id_pemilik" size="50">			  </div>
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

/* Generated via crud engine by indonesiait.com | 2020-07-27 10:34:33 */

-->