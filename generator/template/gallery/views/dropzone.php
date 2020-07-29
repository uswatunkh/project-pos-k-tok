<style>

	@media screen and (max-width: 767px) {
		#hide-sm{
			display: none;
		}
	}

	.content-pane{
	    height: 70px!important;
	}
	.content-pane div{
	    clip: rect(0px, 430px, 70px, -100px)!important;
	}


	/* Mimic table appearance */
	div.table {
	  display: table;
	}
	div.table .file-row {
	  display: table-row;
	}
	div.table .file-row > div {
	  display: table-cell;
	  vertical-align: top;
	  border-top: 1px solid #ddd;
	  padding: 8px;
	}
	div.table .file-row:nth-child(odd) {
	  background: #f9f9f9;
	}

	#total-progress {
	  opacity: 0;
	  transition: opacity 0.3s linear;
	}

	#previews .file-row.dz-success .progress {
	  opacity: 0;
	  transition: opacity 0.3s linear;
	}
	#previews .file-row .delete {
	  display: none;
	  cursor: pointer;
	}

	#previews .file-row.dz-success .start,
	#previews .file-row.dz-success .cancel {
	  display: none;
	}
	#previews .file-row.dz-success .delete {
	  display: block;
	}
	.nopad{
		padding: 0;
	}
	.hide{
		display: none;
	}

</style>


<section class="content" id="container">
  <div class="row">	
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header" id="actions">
		  <h3 class="box-title"><?php if(isset($sub_title)) echo $sub_title; ?></h3>
		  
		   	<span class="tombol-title pull-right">
				
				<a class="btn btn-success" href="<?php 
					$h = ($this->uri->segment(4)!="") ? "/album/".$this->uri->segment(4) : "" ;
					echo base_url().admin_dir().this_module().$h;
				?>">
					<i class="glyphicon glyphicon-arrow-left"></i>
					Back
					
				</a>
				<!-- <span class="btn btn-s btn-success fileinput-button" onclick="cek_album()">
					<i class="glyphicon glyphicon-plus"></i>
					<span>Add</span>
				</span> -->
				<button type="reset" class="btn btn-s btn-warning cancel hide">
					<i class="glyphicon glyphicon-ban-circle"></i>
					<span>Clear</span>
				</button>
				<button type="submit" class="btn btn-s btn-primary start hide">
					<i class="glyphicon glyphicon-upload"></i>
					<span>Upload all</span>
				</button>	
			</span>

		</div><!-- /.box-header -->
			<div class="box-body" >
			<div class="col-sm-12" style="padding: 0 0 10px 0">
				<div class="col-sm-4 nopad">
					<div class="input-group" style="padding-bottom: 10px">
	                    <span class="input-group-addon fileinput-button" style="cursor: pointer;" onclick="cek_album()"><i  class="fa fa-book" ></i> Album</span>
					   	<input type="text"  placeholder="Album name" id="album" name="album" class="form-control" value="<?php echo str_replace("_", " ", $this->uri->segment(4) )?>">
	                </div>
	                <div class="input-group">
	                	<span class="form-control btn btn-info fileinput-button" onclick="cek_album()"><i class="fa fa-plus"></i>Add</span>
	                </div>
					
				</div> 
				<div class="col-sm-4 nopad pull-right">
					<span class="fileupload-process">
						<div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
							<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
						</div>
					</span>
				</div>
				
			</div>
					<div class="table table-striped table-responsive" class="files" id="previews">
						<div id="template" class="file-row">
							<!-- This is used as the file preview template -->
							<div>
								<span class="preview img img-responsive" ><img data-dz-thumbnail style="max-width: 100px" /></span>
							</div>
							<div id="hide-sm">
								<p class="name" data-dz-name></p>
								<strong class="error text-danger" data-dz-errormessage></strong>
							</div>
							<div>
								<p class="size" data-dz-size></p>
								<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
									<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
								</div>
							</div>
							<div style="width: 130px">
								<button class="btn btn-xs btn-primary start">
									<i class="glyphicon glyphicon-upload"></i>
									<span>Start</span>
								</button>
								<button data-dz-remove class="btn btn-xs btn-warning cancel">
									<i class="glyphicon glyphicon-ban-circle"></i>
									<span>Cancel</span>
								</button>
								<p data-dz-remove class="delete">
									<i class="glyphicon glyphicon-check"></i>
									<span>Finish</span>
								</p>
							</div>
						</div>
					</div>


		    </div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
	
  </div><!-- /.row -->
</section><!-- /.content -->
