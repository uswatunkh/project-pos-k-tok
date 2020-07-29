
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title"><i class="fa fa-info-circle"> </i> Confirmation</h4>
</div>

<?php 
if ($function=='restore_exec') {
	$row=$row[0];

	if(count($row)>0){ ?> 
	  <div class="modal-body">
		  <div class="box-body no-padding">
	          <table class="table table-striped">
	          <?php
				if ($row['file']>0) {
					echo '<tr><td>
						<input class="mycheckbox" type="checkbox"  name="check" id="check" /> <b>Also include file[s]</b>
						</td></tr>';
				} ?>
	            <tr>
	            	<td>
	   					<span>Are you sure want to restore <?php echo $row[$field_show]; ?> ?</span>
	            	</td>
	            </tr>
					
	          </table>
	       </div><!-- /.box-body -->
		  
	  </div>

	  <div class="modal-footer">
	  	
			<div class="progress hidden">
				    <div id="progressor" class="progress-bar progress-bar-striped active" role="progressbar"></div>
			</div>

		  <a terget="_blank" href="<?php echo backend_url().$this->uri->segment('2')."/$function?confirm=1" ?>" class="backupDb btn btn-outline pull-left">Restore DB</a>
		  <button type="button" class="btn btn-outline pull-left " data-dismiss="modal">Close</button>
	  </div>

	<?php } else { ?>  
		<div class="modal-body">
			<div class="box-body no-padding" ><span>Please select your data row.</span></div><!-- /.box-body -->
		</div>
		<div class="modal-footer"><button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>		</div>
<?php 
	} 
	echo "
	<style>
		#myModal .modal-header, #myModal .modal-footer{
			background-color: #DB8B0B !important;
			border: 0;
		}
		#myModal .modal-body{
			background-color: #F39C12 !important;
		}
	</style>";

}elseif ($function=='save_action') {	?>	


	<div class="modal-body">
		  <div class="box-body no-padding" style="background: white; color: black;padding: 20px 10px!important">
				<input class="mycheckbox" type="checkbox"  name="check" id="check" /> <b>Also include file[s]</b>
				
	       </div><!-- /.box-body -->
		  
	</div>
	<div class="modal-footer">
		  <a href="<?php echo backend_url().$this->uri->segment('2')."/$function?confirm=1&table=$table" ?>" class="backupDb btn btn-outline pull-left">Backup DB</a>
		  <button type="button" class="btn btn-outline pull-left " data-dismiss="modal">Close</button>
	</div>

<?php } ?> 

<script>
$('.mycheckbox').iCheck({
    checkboxClass: 'icheckbox_square-<?php echo ($function=='save_action') ? 'blue' : 'red'; ?>',
    increaseArea: '20%' 
});

$(".mycheckbox").on('ifChanged ', function(){
	var href = '<?php echo backend_url().$this->uri->segment('2')."/$function?confirm=1" ?>';
			
	if($("#check").is(':checked')) {
	    $(".backupDb").attr('href',href+"&file=1");
	}else{
	    $(".backupDb").attr('href',href);
	}
});	
<?php	if ($function=='restore_exec') { ?>
$(".backupDb").click(function(){

	$(this).hide();
	$(".progress").removeClass("hidden");

    source = new EventSource( $(this).attr('href') );
    // source = new EventSource( "lo.php" );

    var progressor = document.getElementById('progressor');
     
    source.addEventListener('message' , function(e) {
        var result = JSON.parse( e.data );                 
        progressor.style.width = result.progress + "%";
        progressor.innerHTML =  result.message ;
         
        if(e.data.search('DONE') != -1){
            progressor.innerHTML = "Done";
            source.close();
        }
    });
     
    source.addEventListener('error' , function(e)
    {
        progressor.innerHTML = "Error";

        source.close();
    });
       
	return false;
});
<?php } ?>
	
</script>