<?php

$file_name = "index.php";

$module_name =  $_POST['module'];
$module_name_no_space = preg_replace('/\s+/', '', $module_name);

$moduleDir = $this->moduleDir;

$primary_table = strtolower($_POST['primary_table']);
$fields = $_POST['field'];
$onlist = $_POST['onlist'];
$labels = $_POST['label'];
$component = $_POST['component'];

$string = "
<!-- Main content -->
<section class=`content`>
  <div class=`row`>
	<form action=`` method=`post`>
	<div class=`col-xs-12`>
	  <div class=`box`>
		<div class=`box-header`>
		  <h3 class=`box-title`><?php if(isset(\$sub_title)) echo \$sub_title; ?></h3>
		   	<span class=`tombol-title pull-right`>
				<?php if(\$privilege[~C~]==`1`){ ?>
		    	<a id=`btn_create` class=`btn btn-s btn-info ` href=`<?php echo backend_url().this_module().~/add~; ?>`>
					<i class=`ion-plus-round`></i>
  					Create
				</a>
				<?php } ?>
				<?php if(\$privilege[~D~]==`1`){ ?>
				<a id=`btn_bulk_delete` class=`btn btn-s btn-danger ` remote=`<?php echo backend_url().this_module().~/delete_action~; ?>` data-toggle=`modal` data-target=`#myModal`>
					<i class=`fa fa-trash`></i>
  					Bulk Delete
				</a>
				<?php } ?>
			</span>
	
			<!-- Modal HTML -->
			<div id=`myModal`class=`modal fade modal-primary`>
				<div class=`modal-dialog`>
						<div class=`modal-content`>	
						</div>
				</div>
			</div>	
    
		</div><!-- /.box-header -->
		<div class=`box-body`>
		  <?php show_alert(~success~,\$this->session->flashdata(~success_message~));?>
		  <table id=`dt_basic` class=`table table-bordered table-striped dataTable dt-responsive`>
				<thead>
					<tr>
						<th class=`th_no` data-hide=`phone`><input id=`main_checkbox` name=`main_checkbox` type=`checkbox` value=``></th>
						<th class=`th_no` data-hide=`phone`>No</th>";
$index=0;
$expand = "expand";
foreach($fields as $fields_row){
	if($onlist[$index]=="0"){
		$index++;
		continue;
	}
	
	if($labels[$index]!=""){
		$label = ucfirst(str_replace("_"," ",$labels[$index]));
	}
	else{
		$label = ucfirst(str_replace("_"," ",$fields_row));
	}
	
	if ($component[$index]!="password") {
		if($expand=="expand"){
			$string .="\n\t\t\t\t\t\t<th data-class=`".$expand."`>".$label."</th>";
		}else{
			$string .="\n\t\t\t\t\t\t<th data-hide=`phone,tablet`>".$label."</th>";
		}
		
	}
		

	$index++;
	$expand = "";
}

$string .="						
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
";

$string = str_replace('`', '"', $string);
$string = str_replace('~', "'", $string);

$string .= "\n\n\n\n<!-- \n
/* Generated via crud engine by indonesiait.com | ".date('Y-m-d H:i:s')." */
\n-->";


$this->createDir($moduleDir."/views/");
$result = $this->createFile($string, $moduleDir."/views/" . $file_name);

?>