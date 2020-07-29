<?php

$file_name = "add.php";

$module_name =  $_POST['module'];
$module_name_no_space = preg_replace('/\s+/', '', $module_name);

$moduleDir = $this->moduleDir;

$primary_table = strtolower($_POST['primary_table']);
$fields = $_POST['field'];
$component = $_POST['component'];
$join_table = $_POST['join_table'];
$join_id = $_POST['join_id'];
$join_select = $_POST['join_select'];
$join_data = "";

$string = "

<!-- Main content -->
<section class=`content`>
  <div class=`row`>
	<div class=`col-xs-12`>
	  <div class=`box box-info`>
		<div class=`box-header`>
		  <h3 class=`box-title`><?php echo \$sub_title;?></h3>
		</div><!-- /.box-header -->
		 
		  	<form ".$enctype." id=`dt_form` action=`<?php echo backend_url().this_module();?>/save_action` class=`form-horizontal` method=`post`>
			  <div class=`box-body wd-form`>
			
			<?php show_alert(~success~,\$this->session->flashdata(~success_message~));?>
			<?php show_alert(~danger~,\$this->session->flashdata(~danger_message~));?>
				  
				  <div class=`callout callout-warning validate-js-message`>
                    <h4><i class=`icon fa fa-warning`></i> Warning</h4>
					
					 <?php echo wd_validation_errors(); ?>
                  </div>";

$index=0;
foreach($fields as $row){
	if($index==0){
		$index++;
		continue;
	}
	
	$label_array = $_POST['label'];
	
	$field = $row;
	// $field = strtolower($row);
	$field = preg_replace('/\s+/', '', $field);
	
	if($label_array[$index]!=""){
		$label = ucfirst(str_replace("_"," ",$label_array[$index]));
	}else{
		$label = ucfirst(str_replace("_"," ",$row));
	}
	
	
	$required = "";
	$validation = $_POST['validation'];
	
	$rule = explode('|',$validation[$index]);
	foreach($rule as $rule_row){
		if($rule_row=="required"){
			$required = "*";
		}
	}
	
	$string .= "
				<div class=`form-group`>
				  <label for=`` class=`col-sm-2 control-label`>".$label.$required."</label>
				  <div class=`col-sm-10`>\n
				  		 ";
	
	switch($component[$index]){
		case "text":
			$string .= "<input value=`<?php echo wd_set_value(~".$field."~); ?>` type=`text` class=`form-control` name=`".$field."` id=`".$field."` placeholder=`".$label."` size=`50`>";
			break;
		case "email":
			$string .= "<input value=`<?php echo wd_set_value(~".$field."~); ?>` type=`email` class=`form-control` name=`".$field."` id=`".$field."` placeholder=`".$label."` size=`50`>";
			break;	
		case "datepicker":
			$string .= "<input value=`<?php echo wd_set_value(~".$field."~); ?>` type=`text` class=`form-control` name=`".$field."` id=`".$field."` size=`10`>";
			break;
		case "password":
			$string .= "<input type=`password` class=`form-control` name=`".$field."` id=`".$field."` placeholder=`".$label."` size=`50`>
				<br>	<div id='al_".$field."' style='display:none;color: red;font-size: 20px'>Password not match !!</div>	
						<input type=`password` class=`form-control` name=`re_".$field."` id=`re_".$field."` placeholder=`Confirm ".$label."` size=`50`>";
			break;
		case "textarea":
			$string .= "<textarea  name=`".$field."` id=`".$field."` class=`textarea textarea-wcwg` placeholder=`".$label."`><?php echo wd_set_value(~".$field."~); ?></textarea>";
			break;
		case "ckeditor":
			$string .= "<textarea  name=`".$field."` id=`".$field."` class=`textarea` placeholder=`".$label."`><?php echo wd_set_value(~".$field."~); ?></textarea>";
			break;
		case "selectjoin":
			
			$string .= "
			<select name=`".$fields[$index]."` class=`form-control select2` style=`width: 100%;`>
				<option value=``>Please Select</option>
				<?php 
					foreach(\$tb_".$join_table[$index]." as \$rows){
						echo `<option value=~`.\$rows[~".$join_id[$index]."~].`~ `.set_value_select(wd_set_value(~".$fields[$index]."~),\$rows[~".$join_id[$index]."~]).`  >`.\$rows[~".$join_select[$index]."~].`</option>`;
					}
				?>
			</select>
			";
			break;
		case 'select':
			$string .= "
				<select name=`".$field."` id=`".$field."` class=`form-control select2` style=`width: 100%;`>
					<option value=``>Select</option>
				
				";

			$string .= "
				<?php 
				\$list_".$field." = array(";		
			$num = 0;			
			foreach ($component_list[$index] as $key => $row) {
				$sprt = ($num>0) ? "," : "";
				
				$string .="$sprt 				
				 		array(~".$component_list[$index][$key][0]."~,~".$component_list[$index][$key][1]."~)";
				++$num;
			}	
			$string .= "
					);
				
				foreach ( \$list_".$field." as \$value) {
					echo `<option value=~\$value[0]~> \$value[1] </option>`;
						
				}
				?>
			</select> ";
			break;
		case 'radio':
			$string .= "
			<?php 
				\$list_".$field." = array(";		
			$num = 0;			
			foreach ($component_list[$index] as $key => $row) {
				$sprt = ($num>0) ? "," : "";
				
				$string .="$sprt 				
				 		array(~".$component_list[$index][$key][0]."~,~".$component_list[$index][$key][1]."~)";
				++$num;
			}	
			$string .= "
					);
				
				foreach (\$list_".$field." as \$value) {
					echo `<label class=~ radio~><input value=~\$value[0]~ type=~radio~  class=~minimal~ name=~".$field."~ > \$value[1] </label>`;
				}
			?>
			";
			break;
		case 'checkbox':
		$string .= "
				<select name=`".$field."` id=`".$field."` class=`form-control select2` style=`width: 100%;`>
					";
			$string .= "
			<?php 
				\$list_".$field." = array(";		
			$num = 0;			
			foreach ($component_list[$index] as $key => $row) {
				$sprt = ($num>0) ? "," : "";
				
				$string .="$sprt 				
				 		array(~".$component_list[$index][$key][0]."~,~".$component_list[$index][$key][1]."~)";
				++$num;
			}	
			$string .= "
					);
				
				foreach ( \$list_".$field." as \$value) {
					echo `<option value=~\$value[0]~> \$value[1] </option>`;
						
				}
				?>
			</select> ";
			break;
		case 'tag':
		$string .= "
				<select name=`".$field."[]` id=`".$field."` multiple=`multiple` class=`form-control select2` style=`width: 100%;`> </select> ";
			break;	
		case "file":
			$string .= "<input type=`file`  name=`".$field."` id=`".$field."` onchange=`".$field."Handler()` >
			<div style=`color: red` id=`error_".$field."`></div>";
			break;
		case "image":
			$string .= "
					<div class=`img`>
		    			<img id=`preview_".$field."` class=`img-responsive` style=`display: none;` /> 
					</div>
					<div class=`col-sm-12` style=`padding-left: 0`>
						<input type=`file`  name=`".$field."` id=`".$field."` onchange=`".$field."Handler()` >
					</div>
					<div style=`color: red` id=`error_".$field."`></div>";
			break;
		default:
		 	$string .= "<input value=`<?php echo wd_set_value(~".$field."~); ?>` type=`text` class=`form-control` name=`".$field."` id=`".$field."` placeholder=`".$label."` size=`50`>";
 			break;
			
	}
	$string .= "			  </div>
				</div>
	";
	$index++;
}


$string .="			  </div><!-- /.box-body -->
				
			  <span class=`wd-box-helper`></span>		
			  <div class=`wd-box-action`>
				  <div class=`col-sm-offset-2`>
					  <div class=`wd-box-action-btn`>
						<button type=`submit` class=`btn ladda-button`  data-color=`blue` data-style=`expand-right` data-size=`xs`>Save</button>
						<a href=`<?php echo backend_url().this_module();?>` class=`btn btn-default`>Back to List</a>
					  </div>
				  </div>
			  </div><!-- /.box-footer -->	
				
			  <div class=`wd-box-required`>
				  <hr>
					<span class=`required`>*</span>
					Field Required
			  </div><!-- /.box-footer -->
			</form>
	  </div><!-- /.box -->
	</div><!-- /.col -->
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