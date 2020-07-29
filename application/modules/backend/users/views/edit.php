<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-info">
		<div class="box-header">
		  <h3 class="box-title">Edit <?php echo $sub_title;?></h3>
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
				  <label for="inputPassword3" class="col-sm-2 control-label">Email*</label>
				  <div class="col-sm-10">
					<input value="<?php set_value_edit_text(wd_set_value('email'),$list['email']); ?>" type="text" class="form-control" name="email" id="email" placeholder="Email" size="50">
				  </div>
				</div>
				  
				<div class="form-group">
				  <label for="inputPassword3" class="col-sm-2 control-label">Username*</label>
				  <div class="col-sm-10">
					<input disabled value="<?php set_value_edit_text(wd_set_value('username'),$list['username']); ?>" type="text" class="form-control" name="username" id="username" placeholder="Username" size="50">
				  </div>
				</div>  
				  
				<div class="form-group">
				  <label for="inputEmail3" class="col-sm-2 control-label">Name*</label>
				  <div class="col-sm-10">
					<input value="<?php set_value_edit_text(wd_set_value('first_name'),$list['first_name']); ?>" type="text" class="form-control" name="first_name" id="first_name" placeholder="Name" size="50">
				  </div>
				</div>
				<div class="form-group">
				  <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
				  <div class="col-sm-10">
					<input value="<?php set_value_edit_text(wd_set_value('phone'),$list['phone']); ?>" type="text" class="form-control" name="phone" id="phone" placeholder="Phone" size="50">
				  </div>
				</div>
				  
				<div class="form-group">
				  <label for="inputPassword3" class="col-sm-2 control-label">Password*</label>
				  <div class="col-sm-10">
					<input value="" type="password" class="form-control" name="password" id="password" placeholder="Password" size="50">
				  </div>
				</div>
				  
				<div class="form-group">
				  <label for="inputPassword3" class="col-sm-2 control-label">Password Confirm*</label>
				  <div class="col-sm-10">
					<input value="" type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Confirm Password" size="50">
				  </div>
				</div>
				  
				<div class="form-group">
				  	<label class="col-sm-2 control-label">User Privilege</label>
					 <div class="col-sm-10">
						<table class="table table-privileges col-sm-12">
						<tbody>
							<tr>
								<td class="col-sm-4"><b> Groups Privilege </b></td>
								<td class="col-sm-8"><b> Description</b> </td>
							</tr>
							<?php 
							$i=0;
							foreach($groups as $row){
								$checked = "";
								foreach($user_group as $user_group_row){
									if($row['id']==$user_group_row['group_id']){
										$checked = "checked";
										break;
									}
								}
								
								$disabled = "";
								$is_super_admin = "";
								$class = "";
								foreach($user_groups as $user_groups_row){
									if($user_groups_row['id']=="1"){
										$is_super_admin = "1";
									}
									   
									if(($user_groups_row['id']==$row['id']) && $user_groups_row['id']=="1"){
										$disabled = "onclick='return false;' onkeydown='return false;'";
										$class = "checkbox-disable";
										break;
									}elseif(($user_groups_row['id']==$row['id']) && $user_groups_row['id']=="2"){
										$disabled = "onclick='return false;' onkeydown='return false;'";
										$class = "checkbox-disable";
										break;
									}
								}
									   
								if($i!=0 || $is_super_admin=="1"){
							?>
								<tr>
									<td class="col-sm-4">
										<div class="checkbox checkbox-primary checkbox-circle <?php echo $class; ?>">
											<input <?php echo $disabled.' '.$checked;?> type="checkbox" name="groups[]" id="groups-<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>"/> 
											<label for="groups-<?php echo $row['id']; ?>"><b> <?php echo $row['name']; ?></b></label>
                                      	</div> 
									</td>
									<td class="col-sm-8">
										<div class="">  
											<label for=""><?php echo $row['description']; ?></label>
                                      	</div> 
									</td>
								</tr>
							<?php
								}
								$i++;
							}
							?>
							
						</tbody>

						</table>
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

