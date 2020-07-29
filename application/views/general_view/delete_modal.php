<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title"><i class="fa fa-info-circle"> </i>  Delete Confirmation</h4>
  </div>

<?php if(count($delete_row)>0){ ?> 
  <div class="modal-body">
	  <div class="box-body no-padding">
		          <table class="table table-striped">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
					</tr>
					<?php 
					$no = 1;
					$detele_button = "restrict";
					foreach($delete_row as $row){
						echo "
						<tr>
						  <td>".$no."</td>
						  <td>".$row[$field_show]."<br>";
						
						for($i=0;$i<count($dependenci_table[$no-1]["relation"]);$i++){
							$bold="font-weight:400";
							$bg = "bg-grey";
							$star = "";
							if($dependenci_table[$no-1]["on_delete"][$i]=="restrict"){
								$bg = "bg-info";
								$bold = "font-weight:700";
								$star = "*";
							}
							echo " <span class='badge ".$bg."' style='".$bold."'>  ".$dependenci_table[$no-1]["relation"][$i].$star." </span>";
						}
						
						$detele_button = $relation_status[$no-1];
						if(count($dependenci_table[$no-1]["relation"])>0){
							if($relation_status[$no-1]=="cascade"){
								echo "<br> <span class='lbl-del bg-yellow'>WARNING: If you click Delete button, you will lose the data on table[s] above</span><br>";
							}
							else{
								echo "<br> <span class='lbl-del bg-red'> Sorry, Admin not accept you to delete this data if the data already used on table[s]* above</span>";
							}
						}
						
						
						echo "
						   
						  </td>
						</tr>
						";
						$no++;
					}	
					?>
                  </table>
		  <?php 
		  if($detele_button=="cascade" || $detele_button==""){
		  ?>
		  <span>Are you sure you want to delete <?php echo $no-1; ?> record(s) above?</span>
		  <?php }?>
		   
       </div><!-- /.box-body -->
	  
  </div>
  <div class="modal-footer">
	  <?php 
	  if($detele_button=="cascade" || $detele_button==""){
	  ?>
	  <a href="<?php echo backend_url().$this->uri->segment('2')."/delete_action?confirm=1&table=$table&custom=$custom" ?>" class="btn btn-outline pull-left">Delete</a>
	  <?php }?>
	  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
  </div>

<?php } else { ?>  

	<div class="modal-body">
	  <div class="box-body no-padding">
		   <span>Please select your data row.</span>
       </div><!-- /.box-body -->
	  
  </div>
  <div class="modal-footer">
	  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
  </div>

<?php } ?> 