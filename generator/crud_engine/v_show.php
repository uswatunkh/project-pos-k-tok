<?php

$file_name = "show.php";

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

$primary_field = strtolower($fields[0]);
$primary_field = preg_replace('/\s+/', '', $primary_field);

$string = "

<!-- Main content -->
<section class=`content`>
  <div class=`row`>
	<div class=`col-xs-12`>
	  <div class=`box box-info`>
		<div class=`box-header`>
		  <h3 class=`box-title`>Edit <?php echo \$sub_title;?></h3>
		</div><!-- /.box-header -->
		 
		  	<form id=`dt_form` action=`<?php echo backend_url().this_module();?>` class=`form-horizontal` method=`post`>
			  <div class=`box-body wd-form`>
			
			<?php show_alert(~success~,\$this->session->flashdata(~success_message~));?>
			<?php show_alert(~danger~,\$this->session->flashdata(~danger_message~));?>
				  
				  <div class=`callout callout-warning validate-js-message`>
                    <h4><i class=`icon fa fa-warning`></i> Warning</h4>
					
					 <?php echo wd_validation_errors(); ?>
                  </div>";


 $string .= "<input value=`<?php echo \$this->input->get(~id~); ?>` type=`hidden` name=`".$primary_field."`>";

$index=0;
foreach($fields as $row){
	if($index==0){
		$index++;
		continue;
	}
	
	$label_array = $_POST['label'];
	
	$field = strtolower($row);
	$field = preg_replace('/\s+/', '', $field);
	
	if($label_array[$index]!=""){
		$label = ucfirst($label_array[$index]);
	}else{
		$label = ucfirst($row);
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
				  <div class=`col-sm-10`>";
	switch($component[$index]){
		case "text":
			$string .= "<input disabled value=`<?php set_value_edit_text(wd_set_value(~".$field."~),\$list[~".$field."~]); ?>` type=`text` class=`form-control` name=`".$field."` id=`".$field."` placeholder=`".$label."` size=`50`>";
			break;
		case "email":
			$string .= "<input disabled value=`<?php set_value_edit_text(wd_set_value(~".$field."~),\$list[~".$field."~]); ?>` type=`email` class=`form-control` name=`".$field."` id=`".$field."` placeholder=`".$label."` size=`50`>";
			break;	
		case "datepicker":
			$string .= "<input disabled value=`<?php set_value_edit_text(wd_set_value(~".$field."~),\$list[~".$field."~]); ?>` type=`text` class=`form-control` name=`".$field."` id=`".$field."` placeholder=`".$label."` size=`10`>";
			break;
		case "password":
			$string .= "<input disabled value=`` type=`password` class=`form-control` name=`".$field."` id=`".$field."` placeholder=`".$label."` size=`50`>";
			break;	
		case "textarea":
			$string .= "<textarea disabled name=`".$field."` id=`".$field."` class=`textarea textarea-wcwg` placeholder=`".$label."`><?php set_value_edit_text(wd_set_value(~".$field."~),\$list[~".$field."~]); ?></textarea>";
			break;
		case "ckeditor":
			$string .= "<textarea disabled name=`".$field."` id=`".$field."` class=`textarea ` placeholder=`".$label."`><?php set_value_edit_text(wd_set_value(~".$field."~),\$list[~".$field."~]); ?></textarea>";
			break;
		case 'checkbox':
			$string .= "
				<select disabled name=`".$field."[]` id=`".$field."` multiple=`multiple` class=`form-control select2` style=`width: 100%;`>
									
				<?php";					
			$num = 0;
			foreach ($component_list[$index] as $key => $row) {
				$string .="				
				\$list_".$field."[".$key."] = array(~".$component_list[$index][$key][0]."~,~".$component_list[$index][$key][1]."~);";
				++$num;
			}	
			$string .= "\n
				\$new_list = explode(~,~, \$list[~".$field."~]) ;
				foreach ( \$list_".$field." as \$key => \$value) {
					\$list_".$field."[\$key][~check~][\$value[0]] = ~~;
					foreach (\$new_list as \$n_list) {						
						if (\$n_list==\$value[0]) {
							\$list_".$field."[\$key][~check~][\$value[0]] = ~selected~;							
						}
					}				
					echo `<option `.\$list_".$field."[\$key][~check~][\$value[0]].` value=~\$value[0]~> \$value[1] </option>`;
				}
				?>
				</select> ";
			break;
		case "file":
			$string .= "<input disabled value=`<?php set_value_edit_text(wd_set_value(~".$field."~),\$list[~".$field."~]); ?>` type=`text` class=`form-control` name=`".$field."` id=`".$field."` placeholder=`".$label."` size=`50`>";
			break;
		case "image":
			$string .= "
				<?php
				if (\$list[~".$field."~]=='') {
					\$img=\$this->config->item(`assets`).`General/not-found.png`;	
				}else{
					if (file_exists(`public/".$primary_table."_".$field."/`.\$list[~".$field."~])) {
						\$img=base_url().`public/".$primary_table."_".$field."/`.\$list[~".$field."~];
					}else{
						\$img=\$this->config->item(`assets`).`General/not-found.png`;
					}
				}
				?>
					<div class=`img`>
		    			<img id=`preview_".$field."` src=`<?=\$img?>` class=`img-responsive` style=`max-width:200px; max-height:200px` /> 
					</div>
				";	
			break;	
		case 'select':

			$string .= "
					<select disabled name=`".$field."` id=`".$field."` class=`form-control select2` style=`width: 100%;`>
						<option value=``>Select</option>

						<?php ";

					$num = 0;
					foreach ($component_list[$index] as $key => $row) {
						$string .="
						\$list_".$field."[".$key."] = array(~".$component_list[$index][$key][0]."~,~".$component_list[$index][$key][1]."~);";
						++$num;
					}	
					$string .= "		
						foreach ( \$list_".$field." as \$value) {
							\$selected = set_value_edit_select(wd_set_value(~".$field."~),\$list[~".$field."~], \$value[0]);
							echo `<option value=~\$value[0]~ \$selected > \$value[1] </option>`;

						}
						?>
					</select> ";
			break;
		case 'radio':
				$string .= "
					<?php";		
					$num = 0;
					foreach ($component_list[$index] as $key => $row) {
					$string .="				
					\$list_".$field."[".$key."] = array(~".$component_list[$index][$key][0]."~,~".$component_list[$index][$key][1]."~);";
					++$num;
					}	
					$string .= "
					
					foreach ( \$list_".$field." as \$value) {
						\$check = set_value_edit_check(wd_set_value(~".$field."~),\$list[~".$field."~], \$value[0]);
						echo `<input disabled \$check value=~\$value[0]~ type=~radio~ class=~minimal~ name=~".$field."~ > \$value[1] <br> `;
					}
					?>
			";
			break;
		case "selectjoin":
			
			$string .= "
			<select disabled name=`".$fields[$index]."` class=`form-control select2` style=`width: 100%;`>
				<option value=``>Please Select</option>
				<?php 
					foreach(\$tb_".$join_table[$index]." as \$rows){
						echo `<option value=~`.\$rows[~".$join_id[$index]."~].`~ `.set_value_edit_select(wd_set_value(~".$fields[$index]."~),\$rows[~".$join_id[$index]."~],\$list[~".$fields[$index]."~]).` >`.\$rows[~".$join_select[$index]."~].`</option>`;
					}
				?>
			</select>
			";
			break;
		default:
			$string .= "<input disabled value=`<?php set_value_edit_text(wd_set_value(~".$field."~),\$list[~".$field."~]); ?>` type=`text` class=`form-control` name=`".$field."` id=`".$field."` placeholder=`".$label."` size=`50`>";
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