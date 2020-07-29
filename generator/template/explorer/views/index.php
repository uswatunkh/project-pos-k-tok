<section class="content" id='load'>
  <div class="row">
	<form action="" method="post">
	<div class="col-xs-12">
	  <div class="box">
		<div style="padding:20px 0 0 10px">
			<span class='badge bg-yellow'> Location : <?= ($link!="")? $link : "Undefined folder" ?></span>			
			<p></p>
		</div>
	  		
		<div class="box-body table-responsive">
 			<table class="table table-hover">
                <tbody>
                <tr>
                  <th>Name</th>
                  <th>Type</th>
                  <th style="width: 100px">Size</th>
                </tr>
                
<?php
	
if ($link!="") {
	echo 		'<tr>
                	<td><a href="'.$backurl.'"><span class="fa fa-arrow-left"></span> Back </a></td>
                	<td colspan="2"></td>                	
                </tr>';	
	$folder = new DirectoryIterator($link);
	
	foreach ($folder as $file) {
		$filen = $file->getFilename(); 
		$dot = substr($filen, 0,1); 
	    if (!$file->isDot() and $dot!="." ){
	    	if ($file->getType()=="file") {
	    		$type = $file->getExtension();
				$icon = ($type=="jpg" || $type=="jpeg" || $type=="png" || $type=="tif" || $type=="svg") ? "fa-file-image-o" : "fa-file-o";
	    		$name = "<a href='".base_url()."$link/$filen' target='_blank'> <span class='fa $icon'></span> $filen  </a> ";
	    		$size = FileSizeConvert("$link/$filen");
	    	}else{
	    		$name = "<a href='".backend_url().this_module()."/file$folderpath/$filen'> <span class='fa fa-folder'></span> $filen  </a> ";
	    		$type = "<span class='badge bg-aqua'> Dir </span>";
	    		$size = "";
	    	}
	       echo "<tr>	                 
	                  <td> $name </td>
	                  <td> $type </td>
	                  <td> $size </td>
                </tr>";
	    }
	}
}else{
	echo '<tr> 	<td colspan="3" style="text-align:center;">Folder Not Found !</td>	</tr>';	
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
