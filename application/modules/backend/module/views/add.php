<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title"><?php echo $sub_title; ?></h3>
				</div><!-- /.box-header -->

				<form id="dt_form" action="<?php echo backend_url() . this_module(); ?>/save_action" class="form-horizontal" method="post">
					<div class="box-body wd-form">

						<?php show_alert('success', $this->session->flashdata('success_message')); ?>
						<?php show_alert('danger', $this->session->flashdata('danger_message')); ?>

						<div class="callout callout-warning validate-js-message">
							<h4><i class="icon fa fa-warning"></i> Warning</h4>

							<?php echo wd_validation_errors(); ?>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Title*</label>
							<div class="col-sm-10">
								<input value="<?php echo wd_set_value('title'); ?>" type="text" class="form-control" name="title" id="title" placeholder="Title" size="50">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Icon</label>
							<div class="col-sm-2">
								<div class="input-group">
									<input placeholder="fa fa-circle-o" value="<?php echo wd_set_value('icon'); ?>" type="text" class="form-control" name="icon" id="icon" placeholder="Icon" size="20">
									<span class="input-group-btn">
										<a class="btn btn-info btn-flat" href="<?php echo backend_url() . this_module(); ?>/icon" target="_blank">Find Icon</a>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">URL*</label>
							<div class="col-sm-10">
								<input value="<?php echo wd_set_value('url'); ?>" type="text" class="form-control" name="url" id="url" placeholder="URL" size="50">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Parent</label>
							<div class="col-sm-10">
								<select name="parent" class="form-control select2" style="width: 100%;">
									<option value="0">Root</option>
									<?php
									foreach ($modules as $rows) {
										echo "<option value='" . $rows['id'] . "' " . set_value_select(wd_set_value('parent'), $rows['id']) . "  >" . $rows['title'] . "</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Position</label>
							<div class="col-sm-10">
								<select name="position" class="form-control select2" style="width: 100%;">
									<option value="0">First</option>
									<?php
									$i = 0;
									foreach ($modules as $rows) {
										echo "<option value='" . $rows['sort_order'] . "'  " . set_value_select(wd_set_value('position'), $rows['sort_order']) . " > After " . $rows['title'] . "</option>";
										$i++;
									}
									?>
									<option value="<?php echo $i; ?>">Last</option>

								</select>
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
										$is_super_admin = "";
										foreach ($user_groups as $user_groups_row) {
											if ($user_groups_row['id'] == "1") {
												$is_super_admin = "1";
											}
										}

										$i = 0;
										foreach ($groups as $row) {
											if ($i != 0 || $is_super_admin == "1") {
										?>
												<tr>
													<td class="col-sm-4">
														<div class="checkbox checkbox-primary checkbox-circle">
															<input type="checkbox" name="groups[]" id="groups-<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" />
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
						</div>


						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Support</label>
							<div class="col-sm-10">
								<div class="box-rules">
									<span>Admin</span>
									<input value='1' name="a" type="checkbox" class="flat-red" <?php echo set_value_check(wd_set_value('a'), '1'); ?>>
								</div>
								<div class="box-rules">
									<span>Read</span>
									<input value='1' name="r" type="checkbox" class="flat-red" <?php echo set_value_check(wd_set_value('r'), '1'); ?>>
								</div>
								<div class="box-rules">
									<span>Create</span>
									<input value='1' name="c" type="checkbox" class="flat-red" <?php echo set_value_check(wd_set_value('c'), '1'); ?>>
								</div>
								<div class="box-rules">
									<span>Update</span>
									<input value='1' name="u" type="checkbox" class="flat-red" <?php echo set_value_check(wd_set_value('u'), '1'); ?>>
								</div>
								<div class="box-rules">
									<span>Delete</span>
									<input value='1' name="d" type="checkbox" class="flat-red" <?php echo set_value_check(wd_set_value('d'), '1'); ?>>
								</div>
							</div>
						</div>




					</div><!-- /.box-body -->

					<span class="wd-box-helper"></span>
					<div class="wd-box-action">
						<div class="col-sm-offset-2">
							<div class="wd-box-action-btn">
								<button type="submit" class="btn ladda-button" data-color="blue" data-style="expand-right" data-size="xs">Save</button>
								<a href="<?php echo backend_url() . this_module(); ?>" class="btn btn-default">Back to List</a>
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