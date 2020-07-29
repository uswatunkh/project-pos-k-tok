<?=$this->data['css']?>
<!-- Main content -->
<section class="content">
  <div class="row">
<div class="col-sm-12">
	<?php show_alert('success',$this->session->flashdata('success_message'));?>
	<?php show_alert('danger',$this->session->flashdata('danger_message'));?>
</div>	
	  <?php
	  	$x = '12'; $p="Page menu list";
		if ($privilege['U']=="1" || $privilege['C']=="1") { 
			$x = '6'; $p = "Drag and drop hierarchical list with mouse and touch compatibility";
	  		echo '<div class="col-md-6 loader" >';
	  		if ($privilege['C']==1) {
	  			echo $this->data['form'];
	  		}	
	  		echo "</div>";
		}
		if ($privilege['C']==0 && $privilege['U']==1) {	$x='12';}
	  ?>
	
	
	<div id="myModal"class="modal fade modal-primary">
		<div class="modal-dialog">
				<div class="modal-content">	</div>
		</div>
	</div>	

    

	<div class="col-md-<?=$x?> lmenu">
		<div class="box">			
			<div class="box-header" id="box-header">
				<p><?=$p?></p>
			</div>
		    <div class="box-body" >
			    <div class="dd" id="nestable2">
			     <?php echo $this->data['pagemenu']; ?>  				        
		        </div>
		        <div>
		        	<form  action="<?=base_url().admin_dir().this_module()?>/save_position" method="post">				
						<textarea style="display:none" name="menu-position" id="nestable2-output"></textarea>
						<?php
							echo ($this->data['pagemenu']!="")
								? '<button type="submit" class="btn   btn-u ladda-button"  data-color="blue" data-style="expand-right" data-size="xs" style="margin-top: 15px;font-size:13px">Simpan</button>'
								: '<center><span style=" color :darkviolet; font-size:1.5em; ">No Found Data!</span></center>';
						?>
					</form>
		        </div>
		    </div>
		</div>			
	</div>


  </div><!-- /.row -->
</section><!-- /.content -->




<!-- 

/* Generated via crud engine by indonesiait.com | 2016-08-11 05:26:38 */

-->