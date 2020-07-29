<style>	.right{		text-align: right;	} </style>
<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-sm-6" >
	<div class="box loader">
	  Sedang memuat ...
		
	</div>

	</div><!-- /.col -->
	<div class="col-sm-6">
		<div class="box">
		  <div class="box-header">
		    <h3 class="box-title">Statistik Pengunjung</h3>
		  </div><!-- /.box-header -->
		  <div class="box-body no-padding">
		    <table class="table table-striped">
			     <tbody>
			     <tr>
			        <th style="width: 10px">#</th>
			        <th>Statistik</th>			        
			        <th style="width: 40px" class="right">Jumlah</th>
			      </tr>
			      <tr>
			        <td>1.</td>
			        <td>Hari ini</td>			        
			        <td class="right"><?= $this->data["this_day"]?></td>
			      </tr>
			      <tr>
			        <td>2.</td>
			        <td>Minggu ini</td>			        
			        <td class="right"><?= $this->data["this_week"]?></td>
			      </tr>
			      <tr>
			        <td>3.</td>
			        <td>Bulan ini</td>			        
			        <td class="right"><?= $this->data["this_month"]?></td>
			      </tr>
			      <tr>
			        <td>4.</td>
			        <td>Tahun ini</td>			        
			        <td class="right"><?= $this->data["this_year"]?></td>
			      </tr>
			      <tr style="color: darkred">
			        <td>5.</td>
			        <td>Total pengunjung</td>			        
			        <td class="right"><?= $this->data["all"]?></td>
			      </tr>
			    </tbody>
		    </table>
		  </div><!-- /.box-body -->
		</div>		
	</div>


  </div><!-- /.row -->
</section><!-- /.content -->




<!-- 

/* Generated via crud engine by indonesiait.com | 2016-08-11 05:26:38 */

->