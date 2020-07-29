

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
				  <label for="" class="col-sm-2 control-label">Title*</label>
				  <div class="col-sm-10"><input value="<?php set_value_edit_text(wd_set_value('title'),$list['title']); ?>" type="text" class="form-control" name="title" id="title" placeholder="Title" size="50">			  
				</div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Href*</label>
				  <div class="col-sm-10"><input value="<?php set_value_edit_text(wd_set_value('href'),$list['href']); ?>" type="text" class="form-control" name="href" id="href" placeholder="Href" size="50">			  
				</div>
				</div>
	
				
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Status*</label>
				  <div class="col-sm-10">
					<?php				
					$list_status[0] = array('1','Active');				
					$list_status[1] = array('0','No');
					
					foreach ( $list_status as $value) {
						$check = set_value_edit_check(wd_set_value('status'),$list['status'], $value[0]);
						echo "<label class='radio'><input $check value='$value[0]' class='minimal' type='radio'  name='status' > $value[1] </label>";
					}
					?>
						  
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

/* Generated via crud engine by indonesiait.com | 2016-09-23 10:26:16 */

-->