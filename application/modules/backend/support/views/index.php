<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-info">
		<div class="box-header">
		  <h3 class="box-title"><?php echo $sub_title;?></h3>
		</div><!-- /.box-header -->
		 
		  	  <div class="box-body">
				  <div class="box-body">
					  <div class="row">
            <div class="col-md-6">
                  <table class="table table-bordered">
					  <?php $version = getVersionControl(); ?>
                  	  <tr>
						  <td style="width: 200px"><b>Pengembang</b></td>
						  <td><b><?php echo getoption('legal');?></b><small> (www.indonesiait.com)</small></td>
					  </tr>
					  <tr>
						  <td>Aplication Name</td>
						  <td><?=$app_name?></td>
					  </tr>
					  <tr>
						  <td>Lisensi</td>
						  <td><?=$lisensi?></td>
					  </tr>
					  <tr>
						  <td>Release Date</td>
						  <td><?=$release?></td>
					  </tr>
					  <tr>
						  <td>.INDOIT Framework Version </td>
						  <td><?php echo $version['framework_display_version'];?></td>
					  </tr>
					  <tr>
						  <td>Aplication Version</td>
						  <td><?php echo $version["display_version"]; ?></td>
					  </tr>
					  <tr>
						  <td>Last Update</td>
						  <td><?php echo $version["last_update"]; ?></td>
					  </tr>
					  <tr>
						  <td>Garansi</td>
						  <td><?=$garansi?></td>
					  </tr>
					  <tr>
						  <td>Ketentuan Garansi</td>
						  <td>
						  <ol>
							<li>Garansi hanya meliputi error code, dibuktikan dengan adanya screenshot error script.</li>
							<li>Garansi batal jika client telah memodifikasi script dari pengembang.</li>
							<li>Minor bug akan kami tangani maksimal 3 x 24jam.</li>
							<li>Segala bentuk penambahan fitur baru, akan dianggap sebagai change request dan akan dikenakan biaya tambahan.</li>
						</ol>
						  </td>
					  </tr>
					  <tr>
						  <td>Klaim Garansi</td>
						  <td>
							  Klaim Garansi atau request fitur baru dapat dilakukan dengan cara kirim email ke <b>support@indonesiait.com</b> atau <b>indoit.company@gmail.com</b>, customer service kami akan dengan senang hati membantu menyelesaikan masalah Anda.
						  </td>
					  </tr>
					  
					
					  
					  
					
                  </table>
				
				 </div>
			  </div>
                </div><!-- /.box-body -->
			  </div><!-- /.box-footer -->	
				
			 
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

