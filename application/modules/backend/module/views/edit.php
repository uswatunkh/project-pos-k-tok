<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-info">
		<div class="box-header">
		  <h3 class="box-title">Edit Modules</h3>
		</div><!-- /.box-header -->
		 
		  	<form id="dt_form" action="<?php echo backend_url().this_module();?>/update_action" class="form-horizontal" method="post">
			  <div class="box-body wd-form">
			
			<?php show_alert('success',$this->session->flashdata('success_message'));?>
			<?php show_alert('danger',$this->session->flashdata('danger_message'));?>
				  
				  <div class="callout callout-warning validate-js-message">
                    <h4><i class="icon fa fa-warning"></i> Warning</h4>
					 <?php echo wd_validation_errors(); ?>
                  </div>
				  
				<input value="<?php echo $this->input->get('id'); ?>" type="hidden" name="id">
				  
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Title*</label>
				  <div class="col-sm-10">
					<input value="<?php set_value_edit_text(wd_set_value('title'),$list['title']); ?>" type="text" class="form-control" name="title" id="title" placeholder="Title" size="50">
				  </div>
				</div>
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Icon</label>
				  <div class="col-sm-2">
					<div class="input-group">  
					<input value="<?php set_value_edit_text(wd_set_value('icon'),$list['icon']); ?>" type="text" class="form-control" name="icon" id="icon" placeholder="Icon" size="20">
					<span class="input-group-btn">
						<a class="btn btn-info btn-flat" href="<?php echo backend_url().this_module();?>/icon" target="_blank">Find Icon</a>
					</span>
				  </div>
				  </div>  
				</div>
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">URL*</label>
				  <div class="col-sm-10">
					<input value="<?php set_value_edit_text(wd_set_value('url'),$list['url']); ?>" type="text" class="form-control" name="url" id="url" placeholder="URL" size="50">
				  </div>
				</div>
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Parent</label>
				  <div class="col-sm-10">
					  <?php //print_r($parent);?>
					<select name="parent" class="form-control select2" style="width: 100%;">
						<option value="0">Root</option>
						<?php 
							foreach($modules as $rows){
								echo "<option value='".$rows['id']."' ".set_value_edit_select(wd_set_value('parent'),$rows['id'],$list['parent'])." >".$rows['title']."</option>";
							}
						?>
                    </select>	
				  </div>
				</div>
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Position</label>
				  <div class="col-sm-10">
					 <select name="position" class="form-control select2" style="width: 100%;">
						<option value="0" >First</option>
                      	<?php 
							$last=0;
							foreach($modules as $rows){
								echo "<option value='".$rows['sort_order']."' ".set_value_edit_select_sort(wd_set_value('position'),$rows['sort_order'],$list['sort_order'])."  > After ".$rows['title']."</option>";
								if($last<$rows['sort_order']){
									$last=$rows['sort_order'];
								}
							}
						?>
						<option value="<?php echo $last+1; ?>">Last</option>
                      	
                    </select>	
				  </div>
				</div>
				  
				 <div class="form-group">
					 
				  <label for="" class="col-sm-2 control-label">Support</label>
				  	<div class="col-sm-10">
						<div class="box-rules">
							<span>Admin</span>
							<input value='1' name="a" type="checkbox" class="flat-red" <?php echo set_value_edit_check(wd_set_value('a'),'1', $list['support'][0]);?> >  
						</div>
						<div class="box-rules">
							<span>Read</span>
							<input value='1' name="r" type="checkbox" class="flat-red" <?php echo set_value_edit_check(wd_set_value('r'),'1', $list['support'][1]);?> >  
						</div>
						<div class="box-rules">
							<span>Create</span>
							<input value='1' name="c" type="checkbox" class="flat-red" <?php echo set_value_edit_check(wd_set_value('c'),'1', $list['support'][2]);?>  >  
						</div>
						<div class="box-rules">
							<span>Update</span>
							<input value='1' name="u" type="checkbox" class="flat-red" <?php echo set_value_edit_check(wd_set_value('u'),'1', $list['support'][3]);?> >  
						</div>
						<div class="box-rules">
							<span>Delete</span>
							<input value='1' name="d" type="checkbox" class="flat-red" <?php echo set_value_edit_check(wd_set_value('d'),'1', $list['support'][4]);?> >  
						</div>
					</div>
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

