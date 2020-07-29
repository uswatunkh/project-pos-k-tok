<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">Add Relation</h3>
				</div>
				<!-- /.box-header -->
				
				<!-- Modal HTML -->
				<div id="myModal"class="modal fade modal-primary">
					<div class="modal-dialog">
							<div class="modal-content">	
							</div>
					</div>
				</div>

				<form id="dt_form" action="<?php echo backend_url().this_module();?>/save_action" class="form-horizontal" method="post">
					<div class="box-body wd-form">
						<div class="callout callout-warning validate-js-message">
							<h4><i class="icon fa fa-warning"></i> Warning</h4>
							<?php echo wd_validation_errors(); ?>
						</div>
						<span class="label label-success">Primary Table :</span><br><br>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Table*</label>
							<div class="col-sm-10">
							<select name="primary_table" id="primary_table" class="form-control select2" style="width: 100%;">
								<?php 
									foreach($tables as $tables_rows){
										echo "<option value='".$tables_rows['TABLE_NAME']."' >".$tables_rows['TABLE_NAME']."</option>";
									}
								?>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Key*</label>
							<div class="col-sm-10">
							<select name="primary_id" id="primary_id" class="form-control select2" style="width: 100%;">
							</select>
							</div>
						</div>
						<span class="label label-success">Relation Table :</span><br><br>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Table*</label>
							<div class="col-sm-10">
							<select name="relation_table" id="relation_table" class="form-control select2" style="width: 100%;">
								<?php 
									foreach($tables as $tables_rows){
										echo "<option value='".$tables_rows['TABLE_NAME']."' >".$tables_rows['TABLE_NAME']."</option>";
									}
								?>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Key*</label>
							<div class="col-sm-10">
							<select name="relation_id" id="relation_id" class="form-control select2" style="width: 100%;">
							</select>
							</div>	
						</div>

					</div>
					<!-- /.box-body -->

					<span class="wd-box-helper"></span>
					<div class="wd-box-action">
						<div class="col-sm-offset-2">
							<div class="wd-box-action-btn">
								<button type="submit" class="btn ladda-button"  data-color="blue" data-style="expand-right" data-size="xs">Save Relation</button>
							</div>
						</div>
					</div>
					<!-- /.box-footer -->

					<div class="wd-box-required">
						<hr>
						<span class="required">*</span> Field Required
					</div>
					<!-- /.box-footer -->
				</form>
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
		<div class="col-md-6">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Relation Mapping</h3>

				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive">
				  <?php show_alert('success',$this->session->flashdata('success_message'));?>
						<?php show_alert('danger',$this->session->flashdata('danger_message'));?>
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Primary Table</th>
						<th>On Delete <br> <small>[click to change]</small></th>
                      <th width="45%">Relation Table <br> <small>[click to delete]</small></th>
                    </tr>
					<?php 
					$i=1;
					foreach($table_primary as $table_primary_rows){
						$label = "label-danger";
						$icon = "fa-lock";
						$update_set = "cascade";
						if($table_primary_rows['on_delete']=="cascade"){
							$label = "label-success";
							$icon = "fa-check";
							$update_set = "restrict";
						}
						
						echo '
						<tr>
						  <td>'.$i.'.</td>
						  <td>'.$table_primary_rows['primary_table'].' ('.$table_primary_rows['primary_id'].') </td>
						  <td>
						  	<a href="'.backend_url().this_module().'/update_action/?primary_table='.$table_primary_rows['primary_table'].'&on_delete='.$update_set.'" class="badge '.$label.'"> <i class="fa '.$icon.'"></i> '.$table_primary_rows['on_delete'].' </a>
							
						  </td>
						  <td>';
						
						$this->load->model('m_index');
						$table_relation = $this->m_index->get_table_relation($table_primary_rows['primary_table']);
						foreach($table_relation as $table_relation_rows){
							echo '<a id="'.$this->urlcrypt->encode($table_relation_rows['id']).'" href="#" class="badge relation_table bg-yellow">'.$table_relation_rows['relation_table'].'  ('.$table_relation_rows['relation_id'].') <i class="fa fa-remove"></i> </a> ';
						}
						echo '
						  </td>
						</tr>
						';
						$i++;
					}  
					?>
                  </table>
                </div><!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->