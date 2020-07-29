

<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-info">
		<div class="box-header">
		  <h3 class="box-title">Edit <?php echo $sub_title;?></h3>
		</div><!-- /.box-header -->
		 
		  	<form  id="dt_form" action="<?php echo backend_url().this_module();?>/update_action" class="form-horizontal" method="post">
			  <div class="box-body wd-form">
			
			<?php show_alert('success',$this->session->flashdata('success_message'));?>
			<?php show_alert('danger',$this->session->flashdata('danger_message'));?>
				  
				  <div class="callout callout-warning validate-js-message">
                    <h4><i class="icon fa fa-warning"></i> Warning</h4>
					
					 <?php echo wd_validation_errors(); ?>
                  </div><input value="<?php echo $this->input->get('id'); ?>" type="hidden" name="id">
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Id_pelanggan</label>
				  <div class="col-sm-10">
			<select name="id_pelanggan" class="form-control select2" style="width: 100%;">
				<option value="">Please Select</option>
				<?php 
					foreach($tb_pelanggan as $rows){
						echo "<option value='".$rows['id']."' ".set_value_edit_select(wd_set_value('id_pelanggan'),$rows['id'],$list['id_pelanggan'])." >".$rows['nama']."</option>";
					}
				?>
			</select>
						  
				</div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Id_karyawan</label>
				  <div class="col-sm-10">
			<select name="id_karyawan" class="form-control select2" style="width: 100%;">
				<option value="">Please Select</option>
				<?php 
					foreach($tb_karyawan as $rows){
						echo "<option value='".$rows['id']."' ".set_value_edit_select(wd_set_value('id_karyawan'),$rows['id'],$list['id_karyawan'])." >".$rows['nama']."</option>";
					}
				?>
			</select>
						  
				</div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Tgl_transaksi</label>
				  <div class="col-sm-10"><input value="<?php set_value_edit_text(wd_set_value('tgl_transaksi'),$list['tgl_transaksi']); ?>" type="text" class="form-control" name="tgl_transaksi" id="tgl_transaksi" placeholder="Tgl_transaksi" size="10">			  
				</div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Total_harga</label>
				  <div class="col-sm-10"><input value="<?php set_value_edit_text(wd_set_value('total_harga'),$list['total_harga']); ?>" type="text" class="form-control" name="total_harga" id="total_harga" placeholder="Total_harga" size="50">			  
				</div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Bayar</label>
				  <div class="col-sm-10"><input value="<?php set_value_edit_text(wd_set_value('bayar'),$list['bayar']); ?>" type="text" class="form-control" name="bayar" id="bayar" placeholder="Bayar" size="50">			  
				</div>
				</div>
				  </div><!-- /.box-body -->
				
			  <span class="wd-box-helper"></span>		
			  <div class="wd-box-action">
				  <div class="col-sm-offset-2">
					  <div class="wd-box-action-btn">
						<button type="submit" class="btn ladda-button" data-color="blue" data-style="expand-right" data-size="xs">Save</button>
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

/* Generated via crud engine by indonesiait.com | 2020-07-25 02:44:38 */

-->