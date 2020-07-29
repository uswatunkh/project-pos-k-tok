<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-info">
		<div class="box-header">
		  <h3 class="box-title"><?php echo $sub_title;?></h3>
		</div><!-- /.box-header -->
		 
		  	<form id="dt_form" action="<?php echo backend_url().this_module();?>/save_action" class="form-horizontal" method="post">
			  <div class="box-body wd-form">
			
			<?php show_alert('success',$this->session->flashdata('success_message'));?>
			<?php show_alert('danger',$this->session->flashdata('danger_message'));?>
				  
				  <div class="callout callout-warning validate-js-message">
                    <h4><i class="icon fa fa-warning"></i> Warning</h4>
					
					 <?php echo wd_validation_errors(); ?>
                  </div>
				  
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Name*</label>
				  <div class="col-sm-10">
					<input value="<?php echo wd_set_value('group_name'); ?>" type="text" class="form-control" name="group_name" id="group_name" placeholder="Group Name" size="50">
				  </div>
				</div>
				  
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Desciption</label>
				  <div class="col-sm-10">
					<input value="<?php echo wd_set_value('description'); ?>" type="text" class="form-control" name="description" id="description" placeholder="Description" size="50">
				  </div>
				</div>
				  
				<div class="form-group">
				  	<label class="col-sm-2 control-label">Role</label>
					 <div class="col-sm-10">
						<table class="table table-privileges col-sm-12">
						<tbody>
							<tr>
									<td class="col-sm-7"><b> Module </b></td>
									<td class="col-sm-1">
										Admin
									</td>
									<td class="col-sm-1">
										Read
									</td>
									<td class="col-sm-1">
										Create
									</td>
									<td class="col-sm-1">
										Update
									</td>
									<td class="col-sm-1">
										Delete
									</td>
							</tr>
							<?php 
							$i=0;
							foreach($module as $row){
							?>
								<tr>
									<td class="col-sm-7">
										<div class="checkbox checkbox-primary checkbox-circle"> 
											<input id_value="m-<?php echo $row['id']; ?>" type="hidden" value="<?php echo $row['module_status'];?>">
											<input type="checkbox" name="roles[]" id="roles-<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" no="<?php echo $row['id']; ?>" parent="<?php echo $row['parent']; ?>"/> 
											<label for="roles-<?php echo $row['id']; ?>"><b> <?php echo $row['tree']; ?></b> <?php if($row['module_status']=="0") echo "[parent menu]";?></label>
                                      	</div> 
									</td>
									<td class="col-sm-1">
										<div class="checkbox checkbox-primary checkbox-circle checkbox-only  <?php if($row['module_status']=="0" || $row['support'][0]=="0")echo "display-none";?>">  
											<input id_value="a-<?php echo $row['id']; ?>" type="hidden" value="0">
											<input type="checkbox" id="a-<?php echo $row['id']; ?>" value="admin[]" no="<?php echo $row['id']; ?>" parent="<?php echo $row['parent']; ?>"/>
											<label for="a-<?php echo $row['id']; ?>"></label>
                                      	</div> 
									</td>
									
									<td class="col-sm-1">
										<div class="checkbox checkbox-primary checkbox-circle checkbox-only <?php if($row['module_status']=="0" || $row['support'][1]=="0")echo "display-none";?>">  
											<input id_value="r-<?php echo $row['id']; ?>" type="hidden" value="0">
											<input type="checkbox"  id="r-<?php echo $row['id']; ?>" value="read[]" no="<?php echo $row['id']; ?>" parent="<?php echo $row['parent']; ?>"/>
											<label for="r-<?php echo $row['id']; ?>"></label>
                                      	</div>  
									</td>
									
									<td class="col-sm-1">
										<div class="checkbox checkbox-primary checkbox-circle checkbox-only <?php if($row['module_status']=="0" || $row['support'][2]=="0")echo "display-none";?>">  
											<input id_value="c-<?php echo $row['id']; ?>" type="hidden" value="0">
											<input type="checkbox" id="c-<?php echo $row['id']; ?>" value="create[]" no="<?php echo $row['id']; ?>" parent="<?php echo $row['parent']; ?>"/>
											<label for="c-<?php echo $row['id']; ?>"></label>
                                      	</div> 
									</td>
									
									<td class="col-sm-1">
										<div class="checkbox checkbox-primary checkbox-circle checkbox-only <?php if($row['module_status']=="0" || $row['support'][3]=="0")echo "display-none";?>">  
											<input id_value="u-<?php echo $row['id']; ?>" type="hidden" value="0">
											<input type="checkbox" id="u-<?php echo $row['id']; ?>" value="update[]" no="<?php echo $row['id']; ?>" parent="<?php echo $row['parent']; ?>"/>
											<label for="u-<?php echo $row['id']; ?>"></label>
                                      	</div>  
									</td>
									<td class="col-sm-1">
										<div class="checkbox checkbox-primary checkbox-circle checkbox-only <?php if($row['module_status']=="0" || $row['support'][4]=="0")echo "display-none";?>">  
											<input id_value="d-<?php echo $row['id']; ?>" type="hidden" value="0">
											<input type="checkbox" id="d-<?php echo $row['id']; ?>" value="delete[]" no="<?php echo $row['id']; ?>" parent="<?php echo $row['parent']; ?>"/>
											<label for="d-<?php echo $row['id']; ?>"></label>
                                      	</div> 
									</td>
									
								</tr>
							<?php
								$i++;
							}
							?>
							
						</tbody>

						</table>
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

