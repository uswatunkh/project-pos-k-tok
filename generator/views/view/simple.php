
<section class="content-header">
  <h1>
	<i class="fa fa-dashboard"></i> Step 1 <small>simple crud</small>
  </h1>
  <ol class="breadcrumb"><li>Home</li><li>Simple CRUD</li></ol>
</section>


<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-info">
		<div class="box-header">
		  <h3 class="box-title">Generate</h3> &nbsp;
		  <i>Please change backend folder to 777 then change 0775 to 0777 in core.php line 54 if this crud doesn't work on your computer! </i>
		</div><!-- /.box-header -->
		 
		<form id="dt_form" action="<?php echo $this->base_url();?>index.php/simple/generate" class="form-horizontal" method="post">
			  <div class="box-body wd-form">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						  <label for="" class="col-sm-4 control-label">Module Name*</label>
						  <div class="col-sm-8">
							<input value="" type="text" class="form-control" name="module" id="module" placeholder="Module Name">
						  </div>
						</div>

						<div class="form-group">
						  <label for="" class="col-sm-4 control-label">Primary Table*</label>
							<div class="col-sm-8">
								<input value="" type="text" class="form-control inline" name="primary_table" id="primary_table" placeholder="Table Name">
							</div>
						</div> 	
					</div>
					<div class="col-sm-6">
					</div>  
				</div>
				  
				<div class="row">  
					<div class="col-sm-6">
						<div class="form-group">
						  <label for="" class="col-sm-4 control-label">Output Location</label>
						  <div class="col-sm-8">
							<select name="location" class="form-control select2" style="width: 100%;">
								<option value="output/">Output Directory</option>
								<option value="../application/modules/backend/" selected>Appication Modules Directory</option>
							</select>	
						  </div>
						</div>

						<div class="form-group">
						  <label for="" class="col-sm-4 control-label">If Module Exists</label>
						  <div class="col-sm-8">
							<select name="exists" class="form-control select2" style="width: 100%;">
								<option value="0">Duplicate</option>
								<option value="1">Replace</option>
							</select>	
						  </div>
						</div>
						
						<div class="form-group">
						  <label for="" class="col-sm-4 control-label">Icon</label>
						  <div class="col-sm-2">
							  <div class="input-group">
								<input value="" class="form-control" name="icon" id="icon" placeholder="fa-circle-o" size="20" type="text">
								<span class="input-group-btn">
									<a class="btn btn-info btn-flat" href="<?php echo $this->base_url();?>assets/AdminLTE/icons.html" target="_blank">Find Icon</a>
								</span>
							 </div>  
						  </div>
						</div>


					</div>
					<div class="col-sm-6">
						<div class="form-group">
						  <label for="" class="col-sm-4 control-label">If Table not Exists</label>
						  <div class="col-sm-8">
							<select name="table_exist" class="form-control select2" style="width: 100%;">
								<option value="0">No Action</option>
								<option value="1" selected>Create</option>
							</select>	
						  </div>
						</div>

						<div class="form-group">
						  <label for="" class="col-sm-4 control-label">Insert on Module</label>
						  <div class="col-sm-8">
							<select name="insert_on_module" class="form-control select2" style="width: 100%;">
								<option value="0">No</option>
								<option value="1" selected>Yes</option>
							</select>	
						  </div>
						</div>
					</div>
				</div>
				<br>
					<div class="col-sm-12">
						<table class="table table-privileges col-sm-12">
						<tbody id="table_field">
							<tr>
									<td class="col-sm-2"><b> Field Column* </b></td>
									<td class="col-sm-1">Label</td>
									<td class="col-sm-2">Component</td>
									<td class="col-sm-2">Type Data</td>
									<td class="col-sm-2">Option</td>
									<td class="col-sm-1">Validation </td>
									<td class="col-sm-1">On List</td>
									<td class="col-sm-1">Del</td>
							</tr>
							<tr id="row_1">										
									<td class="col-sm-2">
									<input type="hidden" name="row_id[]" id="id_row_1" value="1">
									<input value="id" type="text" class="form-control" name="field[]" placeholder="Primary Field"></td>
									<td class="col-sm-2"><input value="" type="text" class="form-control" name="label[]" placeholder="Label Name"> </td>
									<td class="col-sm-1 component" id="select_row_1">
										<select name="component[]" class="form-control select2 component_id">
											<option value="text">Text Field</option>
											<option value="select">Select</option>
											<option value="password">Password</option>
											<option value="radio">Radio</option>
											<option value="checkbox">Checkbox</option>
											<option value="selectjoin">Select Join</option>
											<option value="textarea" >Text Area</option>
											<option value="ckeditor" >CK Editor</option>
											<option value="file" >File</option>
											<option value="image" >Image</option>
											<option value="datepicker">Datepicker</option>

										</select>
										<div>
											<div class="col-sm-8" style="padding-left:0">
											<input id="row_1_1" value="" type="text" class="form-control display-none select-input" name="select_row_1[]" placeholder="Key, Value">
											</div>
											<div class="col-sm-4">
											<span style="cursor:pointer" onclick="addSelect('row_1')" class="select-input display-none fa fa-plus"></span>
											</div>
										</div>
									</td>
									<td class="col-sm-1">
										<select name="typedata[]" class="form-control select2">
											<option value="varchar(20)">Free</option>
											<option value="int" selected>Integer</option>
											<option value="double" >Double</option>
											<option value="varchar(50)" >Varchar(50)</option>
											<option value="varchar(100)" >Varchart(100)</option>
											<option value="text" >Text</option>
										</select>										
									</td>
									<td class="col-sm-2 join">
										<input value="" type="text" class="form-control display-none join-table-input" name="join_table[]" placeholder="Join Table">
										<input value="" type="text" class="form-control display-none join-id-input" name="join_id[]" placeholder="Join ID">
										<input value="" type="text" class="form-control display-none join-select-input" name="join_select[]" placeholder="Select">
										<!-- File -->
										<input value="" type="text" class="form-control display-none f_file" name="file_type[]" placeholder="type name,name">
										<input value="" type="text" class="form-control display-none f_file" name="file_size[]" placeholder="File Size (Kb)">
										<input value="" type="text" class="form-control display-none f_img" name="file_thumb[]" placeholder="Thumb H,W(Px)">
									</td>
									<td class="col-sm-1"><input value="" type="text" class="form-control" name="validation[]" placeholder="Field Name"> </td>
									<td class="col-sm-1">
										<select name="onlist[]" class="form-control select2" >
											<option value="1">YES</option>
											<option value="0" selected>NO</option>
										</select>
									</td>
									<!-- <td class="col-sm-1"><button type="button" class="btn-del btn-xs btn btn-danger btn-flat "><i class="fa fa-close white"></i></button> </td> -->
							</tr>
							<tr id="row_2">									
									<td class="col-sm-2"><input type="hidden" name="row_id[]" id="id_row_2" value="2"><input value="" type="text" class="form-control" name="field[]" placeholder="Field Name"></td>
									<td class="col-sm-2"><input value="" type="text" class="form-control" name="label[]" placeholder="Label Name"> </td>
									<td class="col-sm-1 component" id="select_row_2">
										<select name="component[]" class="form-control select2 component_id">
											<option value="text">Text Field</option>
											<option value="select">Select</option>
											<option value="password">Password</option>
											<option value="radio">Radio</option>
											<option value="checkbox">Checkbox</option>
											<option value="selectjoin">Select Join</option>
											<option value="textarea" >Text Area</option>
											<option value="ckeditor" >CK Editor</option>
											<option value="file" >File</option>
											<option value="image" >Image</option>
											<option value="datepicker">Datepicker</option>
											<option value="email">Email</option>
											<option value="tag">Tag</option>
										</select>
										<input id="row_2_1" value="" type="text" class="form-control display-none select-input" name="select_row_2[]" placeholder="Key, Value">
										<span style="cursor:pointer" onclick="addSelect('row_2')" class="select-input display-none fa fa-plus"></span>
									</td>
									<td class="col-sm-1">
										<select name="typedata[]" class="form-control select2 type_id">
											<option value="varchar(20)">Free</option>
											<option value="int" >Integer</option>
											<option value="double" >Double</option>
											<option value="varchar(50)" >Varchar(50)</option>
											<option value="varchar(100)" >Varchart(100)</option>
											<option value="text" >Text</option>
											<option value="custom" >Custom</option>
										</select>
										<input id="type_row_21" value="" type="text" class="form-control display-none custom_type" name="custom[1]" placeholder="type(value)">
									</td>
									<td class="col-sm-2 join">
										<input value="" type="text" class="form-control display-none join-table-input" name="join_table[]" placeholder="Join Table">
										<input value="" type="text" class="form-control display-none join-id-input" name="join_id[]" placeholder="Join ID">
										<input value="" type="text" class="form-control display-none join-select-input" name="join_select[]" placeholder="Select">
										<!-- File -->
										<input value="" type="text" class="form-control display-none f_file" name="file_type[]" placeholder="type name,name">
										<input value="" type="text" class="form-control display-none f_file" name="file_size[]" placeholder="File Size (Kb)">
										<input value="" type="text" class="form-control display-none f_img" name="file_thumb[]" placeholder="Thumb H,W(Px)">
									</td>
									<td class="col-sm-1"><input value="" type="text" class="form-control" name="validation[]" placeholder="Field Name"> </td>
									<td class="col-sm-1">
										<select name="onlist[]" class="form-control select2" >
											<option value="1">YES</option>
											<option value="0">NO</option>
										</select>
									</td>
									<!-- <td class="col-sm-1"><button type="button" class="btn-del btn-xs btn btn-danger btn-flat "><i class="fa fa-close white"></i></button> </td> -->
							</tr>
														
						</tbody>

						</table>
					</div>
				
			  </div><!-- /.box-body -->
			
			  <span class="wd-box-helper"></span>		
			  <div class="wd-box-action">
				  <div class="col-sm-offset-2">
					  <div class="wd-box-action-btn">
						<button type="button" id="add" class=" btn btn-warning btn-add-field">Add Field</button> 
						<button type="submit" class="btn btn-info">Generate</button>
						</div>
				  </div>
			  </div><!-- /.box-footer -->	
				
			  <div class="wd-box-required">
				  <hr>
					<span class="required">*</span>
					Field Required
			  </div><!-- /.box-footer -->
			</form>
		  	
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

<script>
var num =2;
function remselect(key){
	$("#"+key).remove();
	
}

function addSelect(trId){
	alert('div'+trId+'_'+num);
	var div = "remselect('div"+trId+'_'+num+"')";
	$("#select_"+trId).append('<div id="div'+trId+'_'+num+'" class="select-list"><div class="col-sm-8" style="padding-left:0"><input id="'+trId+'_'+num+'" value="" type="text" class="form-control" name="select_'+trId+'[]" placeholder="Key, Value"></div><div class="col-sm-4"><span style="cursor:pointer" class="fa fa-minus" onclick="'+div+'"></span></div></div>');
	num++;
}

$(function() {
			
		var no = 2;
		$(".select2").select2();
	
     	$('#add').click(function () {
     		no++;
     		var javOnclick = "addSelect('row_"+no+"')";
			$("#table_field").append('<tr id=row_'+no+'></tr>');	
			$("#row_"+no).append('<td class="col-sm-2"><input type="hidden" name="row_id[]" id="id_row_'+no+'" value="'+no+'"><input value="" type="text" class="form-control" name="field[]" placeholder="Field Name"></td><td class="col-sm-2"><input value="" type="text" class="form-control" name="label[]" placeholder="Label Name"> </td>				<td class="col-sm-1 component" id="select_row_'+no+'">					<select name="component[]" class="form-control select2 component_id">						<option value="text">Text Field</option>						<option value="select">Select</option>						<option value="password">Password</option>						<option value="radio">Radio</option>		<option value="checkbox">Checkbox</option>				<option value="selectjoin">Select Join</option>						<option value="textarea" >Text Area</option>						<option value="ckeditor" >CK Editor</option><option value="file" >File</option>											<option value="image" >Image</option>			<option value="datepicker">Datepicker</option>		<option value="email">Email</option>	<option value="tag">Tag</option>		</select>					<input id="row_'+no+'1" value="" type="text" class="form-control display-none select-input" name="select_row_'+no+'[]" placeholder="Key, Value">	<span style="cursor:pointer" onclick="'+javOnclick+'" class=" select-input display-none fa fa-plus"></span>			</td>				<td class="col-sm-1">					<select name="typedata[]" class="form-control select2 type_id">						<option value="varchar(20)">Free</option>						<option value="int" >Integer</option>						<option value="double" >Double</option>						<option value="varchar(50)" >Varchar(50)</option>						<option value="varchar(100)" >Varchart(100)</option>						<option value="text" >Text</option>		<option value="custom" >Custom</option>			</select> <input id="type_row_'+no+'1" value="" type="text" class="form-control display-none custom_type" name="custom[]" placeholder="type(value)">				</td>				<td class="col-sm-2 join">					<input value="" type="text" class="form-control display-none join-table-input" name="join_table[]" placeholder="Join Table">					<input value="" type="text" class="form-control display-none join-id-input" name="join_id[]" placeholder="Join ID">					<input value="" type="text" class="form-control display-none join-select-input" name="join_select[]" placeholder="Select">										<input value="" type="text" class="form-control display-none f_file" name="file_type[]" placeholder="type name,name">										<input value="" type="text" class="form-control display-none f_file" name="file_size[]" placeholder="File Size (Kb)">										<input value="" type="text" class="form-control display-none f_img" name="file_thumb[]" placeholder="Thumb H,W(Px)">				</td>				<td class="col-sm-1"><input value="" type="text" class="form-control" name="validation[]" placeholder="Field Name"> </td>				<td class="col-sm-1">					<select name="onlist[]" class="form-control select2" >						<option value="1">YES</option>						<option value="0">NO</option>					</select>				</td>				<td class="col-sm-1"><button type="button" class="btn-del btn-xs btn btn-danger btn-flat"><i class="fa fa-close white"></i></button> </td>');
			$(".select2").select2();
			
			$("#idrow_"+no).val(no);
  		});
	
		
		$("tbody").on("click", ".btn-del", function() {
			var tr = $(this).closest("tr");
			var recordId = tr.attr("id");
			
			$("#"+recordId).remove();
		});

		$("tbody").on("change", ".type_id", function() {
			var tr = $(this).closest("tr");
			var recordId = tr.attr("id");
			
			var type_val = $("#"+recordId+" .type_id").val();
			if (type_val=="custom") {				
				$("#"+recordId+" .custom_type").show();
				$("#"+recordId+" .custom_type").attr("required","true");
			}else{
				$("#"+recordId+" .custom_type").hide();
				$("#"+recordId+" .custom_type").removeAttr("required");
			}

		});
	
		$("tbody").on("change", ".component_id", function() {
			var tr = $(this).closest("tr");
			var recordId = tr.attr("id");
			
			var component_val = $("#"+recordId+" .component_id").val();
			
			switch(component_val){
				case "select":
					$("#"+recordId+" .select-input").show();
					$("#"+recordId+" .join-table-input").hide();
					$("#"+recordId+" .join-id-input").hide();
					$("#"+recordId+" .join-select-input").hide();
					$("#"+recordId+" .select-list").remove();
					$("#"+recordId+" .f_file").hide();
					$("#"+recordId+" .f_img").hide();
					$("#"+recordId+" .f_file").removeAttr("required");
					$("#"+recordId+" .f_img").removeAttr("required");		
					break;
				case "radio":
					$("#"+recordId+" .select-input").show();
					$("#"+recordId+" .join-table-input").hide();
					$("#"+recordId+" .join-id-input").hide();
					$("#"+recordId+" .join-select-input").hide();
					$("#"+recordId+" .select-list").remove();
					$("#"+recordId+" .f_file").hide();
					$("#"+recordId+" .f_img").hide();
					$("#"+recordId+" .f_file").removeAttr("required");
					$("#"+recordId+" .f_img").removeAttr("required");
					break;
				case "checkbox":
					$("#"+recordId+" .select-input").show();
					$("#"+recordId+" .join-table-input").hide();
					$("#"+recordId+" .join-id-input").hide();
					$("#"+recordId+" .join-select-input").hide();
					$("#"+recordId+" .select-list").remove();
					$("#"+recordId+" .f_file").hide();
					$("#"+recordId+" .f_img").hide();
					$("#"+recordId+" .f_file").removeAttr("required");
					$("#"+recordId+" .f_img").removeAttr("required");
					break;
				case "selectjoin":
					$("#"+recordId+" .select-input").hide();
					$("#"+recordId+" .join-table-input").show();
					$("#"+recordId+" .join-id-input").show();
					$("#"+recordId+" .join-select-input").show();
					$("#"+recordId+" .select-list").remove();
					$("#"+recordId+" .f_file").hide();
					$("#"+recordId+" .f_img").hide();
					$("#"+recordId+" .f_file").removeAttr("required");
					$("#"+recordId+" .f_img").removeAttr("required");
					break;
				case "file":
					$("#"+recordId+" .select-input").hide();
					$("#"+recordId+" .join-table-input").hide();
					$("#"+recordId+" .join-id-input").hide();
					$("#"+recordId+" .join-select-input").hide();
					$("#"+recordId+" .select-list").remove();
					$("#"+recordId+" .f_file").show();
					$("#"+recordId+" .f_img").hide();
					$("#"+recordId+" .f_file").attr("required","true");
					$("#"+recordId+" .f_img").removeAttr("required");

					break;
				case "image":
					$("#"+recordId+" .select-input").hide();
					$("#"+recordId+" .join-table-input").hide();
					$("#"+recordId+" .join-id-input").hide();
					$("#"+recordId+" .join-select-input").hide();
					$("#"+recordId+" .select-list").remove();
					$("#"+recordId+" .f_file").show();
					$("#"+recordId+" .f_img").show();
					$("#"+recordId+" .f_file").attr("required","true");
					$("#"+recordId+" .f_img").attr("required","true");
					break;	
				default:
					$("#"+recordId+" .select-input").hide();
					$("#"+recordId+" .join-table-input").hide();
					$("#"+recordId+" .join-id-input").hide();
					$("#"+recordId+" .join-select-input").hide();
					$("#"+recordId+" .select-list").remove();
					$("#"+recordId+" .f_file").hide();
					$("#"+recordId+" .f_img").hide();
					$("#"+recordId+" .f_file").removeAttr("required");
					$("#"+recordId+" .f_img").removeAttr("required");
					break;
			}
			console.log(recordId);
		});
		
		//hilangkan 5
		$('#dt_form').submit(function() {
			var status = '<img class="loading" src="loading_detail.gif" alt="Loading..." />';
			$("#ajax").after(status);
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: $(this).serialize(),
				dataType: 'json',
				success: function(json) {

					// var cek = $.parseJSON(json)
					//   .done(function() {
					//     console.log( "second success" );
					//   })
					//   .fail(function() {
					//     location.reload();
					//   });
					console.log(json.message);
					alert(json.message);
//					
				}
			})
			return false;
		});
	
		
});

</script>