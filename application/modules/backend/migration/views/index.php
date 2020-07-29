
<!-- Main content -->
<section class="content">
  <div class="row">
	<form action="" method="post">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
		  <h3 class="box-title"><?php if(isset($sub_title)) echo $sub_title; ?></h3>
		   	<span class="tombol-title pull-right">
				<a id="btn_create" class="btn btn-s btn-info " href="<?php echo backend_url().this_module().'/generate_db'; ?>">
					<i class="ion-plus-round"></i>
  					Pull Current Database
				</a>
				
				<a id="btn_upload" class="btn btn-s btn-primary " href="<?php echo backend_url().this_module().'/add'; ?>">
					<i class="fa fa-cloud-upload"></i>
  					Upload Database (.sql)
				</a>
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
						<th class="th_no" data-hide="phone">No</th>
						<th data-class="expand">File Name</th>
						<th data-hide="phone,tablet">Date</th>
						<th data-hide="phone,tablet">Mode</th>
						<th data-hide="phone,tablet">Status</th>						
						<th>Action</th>
					</tr>
				</thead>
			<tbody>
				<?php 
				$no = 1;
				foreach($db_file as $row){
					$label = "label label-primary";
					if($row['mode']=='all'){
						$label = "label label-success";
					}
					
					echo "
					<tr id='".$row['file']."'>
						<td>".$no."</td>
						<td data-class='expand'><a href='".base_url()."db/".$row['file']."'>".$row['file']."</a></td>
						<td data-hide='phone,tablet'>".$row['date']."</td>
						<td data-hide='phone,tablet'><span class='".$label."'>".$row['mode']."</span></td>
						<td data-hide='phone,tablet'>".$row['status']."</td>
						<td data-hide='phone,tablet'>
							<a class='btn btn-default btn-xs' href='".backend_url().this_module()."/restore/".$row['file']."'> <i class='fa fa-play'></i> Re-execute </a>
							<a target='_blank' class='btn btn-default btn-xs' href='".backend_url().this_module()."/view/".$row['file']."'> <i class='fa fa-eye'></i> View </a>
							<a class='btn btn-default btn-xs btn-delete' href='#'>  <i class='fa fa-trash'></i>  Delete</a>
						</td>
					</tr>
					";
					$no++;
				}
				?>
			</tbody>
		  </table>
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
	</form>
  </div><!-- /.row -->
</section><!-- /.content -->




<!-- 

/* Generated via crud engine by indonesiait.com | 2017-03-31 00:57:07 */

-->