
<!-- Main content -->
<section class="content">
  <div class="row">
	<form action="" method="post">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
		  <h3 class="box-title"><?php if(isset($sub_title)) echo $sub_title; ?></h3>
		   	<span class="tombol-title pull-right">
				<a class="btn btn-s btn-success" href="<?= backend_url().this_module() ?>"> <i class="fa fa-eye"></i> Album view</a>	
				<?php if($privilege['C']=="1"){ ?>
		    	<a id="btn_create" class="btn btn-s btn-info " href="<?php echo backend_url().this_module().'/add'; ?>">
					<i class="ion-plus-round"></i>
  					Create
				</a>
				<?php }if($privilege['D']=="1"){ ?>
				<a id="btn_bulk_delete" class="btn btn-s btn-danger " remote="<?php echo backend_url().this_module().'/delete_action'; ?>" data-toggle="modal" data-target="#myModal">
					<i class="fa fa-trash"></i>
  					Bulk Delete
				</a>
				<?php } ?>
			</span>
	
			<!-- Modal HTML -->
			<div id="myModal"class="modal fade modal-primary">
				<div class="modal-dialog">
						<div class="modal-content">	
						</div>
				</div>
			</div>	
    
		</div><!-- /.box-header -->
		<div class="box-body">
		  <?php show_alert('success',$this->session->flashdata('success_message'));?>
		  <table id="dt_basic" class="table table-bordered table-striped dataTable dt-responsive">
				<thead>
					<tr>
						<th class="th_no" data-hide="phone"><input id="main_checkbox" name="main_checkbox" type="checkbox" value=""></th>
						<th class="th_no" data-hide="phone">No</th>
						<th data-class="expand">File</th>
						<th data-hide="phone,tablet">Label</th>
						<th data-hide="phone,tablet">Album</th>
						<th data-hide="phone,tablet">Visible</th>
						<th data-hide="phone,tablet">Uploader</th>						
						<th>Action</th>
					</tr>
				</thead>
			<tbody></tbody>
		  </table>
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
	</form>
  </div><!-- /.row -->
</section><!-- /.content -->




<!-- 

/* Generated via crud engine by indonesiait.com | 2016-08-09 05:55:51 */

-->