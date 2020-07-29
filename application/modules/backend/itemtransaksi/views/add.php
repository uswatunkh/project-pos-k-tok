

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
				  <label for="" class="col-sm-2 control-label">Id transaksi</label>
				  <div class="col-sm-10">

				  		 
			<select name="id_transaksi" class="form-control select2" style="width: 100%;">
				<option value="">Please Select</option>
				<?php 
					foreach($tb_transaksi as $rows){
						echo "<option value='".$rows['id']."' ".set_value_select(wd_set_value('id_transaksi'),$rows['id'])."  >".$rows['id']."</option>";
					}
				?>
			</select>
						  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Id item barang</label>
				  <div class="col-sm-10">

				  		 
			<select name="id_item_barang" class="form-control select2" style="width: 100%;">
				<option value="">Please Select</option>
				<?php 
					foreach($tb_item_barang as $rows){
						echo "<option value='".$rows['id']."' ".set_value_select(wd_set_value('id_item_barang'),$rows['id'])."  >".$rows['nama']."</option>";
					}
				?>
			</select>
						  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Jml input</label>
				  <div class="col-sm-10">

				  		 <input value="<?php echo wd_set_value('jml_input'); ?>" type="text" class="form-control" name="jml_input" id="jml_input" placeholder="Jml input" size="50">			  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Harga</label>
				  <div class="col-sm-10">

				  		 <input value="<?php echo wd_set_value('harga'); ?>" type="text" class="form-control" name="harga" id="harga" placeholder="Harga" size="50">			  </div>
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

/* Generated via crud engine by indonesiait.com | 2020-07-25 02:47:44 */

-->