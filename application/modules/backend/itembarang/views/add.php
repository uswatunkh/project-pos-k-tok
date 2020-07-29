

<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-info">
		<div class="box-header">
		  <h3 class="box-title"><?php echo $sub_title;?></h3>
		</div><!-- /.box-header -->
		 
		  	<form  id="dt_form" action="<?php echo backend_url().this_module();?>/save_action" class="form-horizontal" method="post">
			  <div class="box-body wd-form">
			
			<?php show_alert('success',$this->session->flashdata('success_message'));?>
			<?php show_alert('danger',$this->session->flashdata('danger_message'));?>
				  
				  <div class="callout callout-warning validate-js-message">
                    <h4><i class="icon fa fa-warning"></i> Warning</h4>
					
					 <?php echo wd_validation_errors(); ?>
                  </div>
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Id jenis barang</label>
				  <div class="col-sm-10">

				  		 
			<select name="id_jenis_barang" class="form-control select2" style="width: 100%;">
				<option value="">Please Select</option>
				<?php 
					foreach($tb_jenis_barang as $rows){
						echo "<option value='".$rows['id']."' ".set_value_select(wd_set_value('id_jenis_barang'),$rows['id'])."  >".$rows['nama']."</option>";
					}
				?>
			</select>
						  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Nama</label>
				  <div class="col-sm-10">

				  		 <input value="<?php echo wd_set_value('nama'); ?>" type="text" class="form-control" name="nama" id="nama" placeholder="Nama" size="50">			  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Stok</label>
				  <div class="col-sm-10">

				  		 <input value="<?php echo wd_set_value('stok'); ?>" type="text" class="form-control" name="stok" id="stok" placeholder="Stok" size="50">			  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Satuan</label>
				  <div class="col-sm-10">

				  		 <input value="<?php echo wd_set_value('satuan'); ?>" type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" size="50">			  </div>
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

/* Generated via crud engine by indonesiait.com | 2020-07-25 02:36:53 */

-->