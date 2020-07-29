<?php

$file_name = "index_js.php";

$module_name =  $_POST['module'];
$module_name_no_space = preg_replace('/\s+/', '', $module_name);

$moduleDir = $this->moduleDir;

$primary_table = strtolower($_POST['primary_table']);
$fields = $_POST['field'];
$onlist = $_POST['onlist']; 

$string = "
<?php 
\$disabled = ``;
if(\$privilege[~U~]!=`1` && \$privilege[~D~]!=`1`){
	\$disabled = `disabled`;
}

\$action = ~<span class=`btn btn-default btn-view btn-xs`> View </span>~;

	\$action .= 
		~
		<div class=`btn-group`>
			<button type=`button` class=`btn btn-xs btn-default ~.\$disabled.~`>Action</button>

				<button type=`button` class=`btn btn-xs btn-default dropdown-toggle ~.\$disabled.~` data-toggle=`dropdown`>
				<span class=`caret`></span><span class=`sr-only`>Toggle Dropdown</span> </button>~;

if(\$privilege[~U~]==`1` || \$privilege[~D~]==`1`){
	\$action .= ~<ul class=`dropdown-menu` role=`menu`>~;

	if(\$privilege[~U~]==`1`){
		\$action .= ~<li><a class=`btn-edit` href=`#`>Edit</a></li>~;
	}

	if(\$privilege[~D~]==`1`){
		\$action .= ~<li><a class=`btn-delete` href=`#`>Delete</a></li>~;
	}

	\$action .=~</ul>
		~;
}

\$action .=~</div>~;

\$action = str_replace(PHP_EOL, ~~, \$action);
?>


<script>  
	
\$(function() {
	
	var responsiveHelper_dt_basic = undefined;
	var responsiveHelper_datatable_fixed_column = undefined;
	var responsiveHelper_datatable_col_reorder = undefined;
	var responsiveHelper_datatable_tabletools = undefined;

	var breakpointDefinition = {
		tablet : 1024,
		phone : 480
	};
	
	//wait till the page is fully loaded before loading table
	//dataTableSearch() is optional.  It is a jQuery plugin that looks for input fields in the thead to bind to the table searching
	var dt = \$(`#dt_basic`).DataTable({
		processing: true,
        serverSide: true,
		`lengthMenu`: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
		autoWidth:false,
		`language`: {
			`lengthMenu`: `Display _MENU_ `
		},
		buttons: [
			{
				extend: ~copy~,
				text: ~<i class=`fa fa-copy`></i> Copy~,
				header: false,
				exportOptions: {
					modifier: {
						selected: true
					},
					orthogonal: ~copy~
				}
        	},
			{
				extend: ~collection~,
                text: ~<i class=`fa fa-file-excel-o`></i> Export~,
                buttons: [
					{
						extend: ~excel~,
						text: ~excel~,
						exportOptions: {
							columns :~:visible~
						}
					},
					{
						extend: ~csv~,
						text: ~csv~,
						exportOptions: {
							columns :~:visible~
						}
					},
					{
						extend: ~pdf~,
						text: ~pdf~,
						exportOptions: {
							columns :~:visible~
						}
					}
                ]
			},
			{
				extend: ~print~,
				text: ~<i class=`fa fa-print`></i> Print~,
				autoPrint: false
        	},
			{
				extend: ~colvis~,
				text: ~<i class=`fa fa-eye-slash`></i> Show~
        	}
        ],
        ajax: {
            `url`: JS_BASE_URL + `<?php echo this_module();?>/dataTable`,
            `type`: `POST`
        },
        columns: [
			{ 
				data: `checkboxs`,
				orderable: false,
				searchable: false
			},
			{ 
				data: `number`,
				orderable: false,
				searchable: false
			},";


$component =  $_POST['component'];

$join_table = $_POST['join_table'];
$join_id = $_POST['join_id'];
$join_select = $_POST['join_select'];

$index=0;
foreach($fields as $fields_row){
	$fields_row = strtolower($fields_row);
	$fields_row = preg_replace('/\s+/', '', $fields_row);
	
	if($onlist[$index]=="0"){
		$index++;
		continue;
	}
	
	if($component[$index]=="selectjoin"){
		$join_table_val = strtolower($join_table[$index]);
		$join_table_val = preg_replace('/\s+/', '', $join_table_val);
		
		$join_select_val = strtolower($join_select[$index]);
		$join_select_val = preg_replace('/\s+/', '', $join_select_val);
		
		$string .="\n\t\t\t{ data: `".$join_table_val.".".$join_select_val."` },";
		
	}else{
		$string .="\n\t\t\t{ data: `".$primary_table.".".$fields_row."` },";
	}
	
	$index++;
}
$string .="\n\t\t\t{
				data: null,
				defaultContent: ~<?php echo \$action;?>~,
				orderable: false,
				searchable: false,
				width:~130px~
			}
        ],
		`preDrawCallback` : function() {
			// Initialize the responsive datatables helper once.
			if (!responsiveHelper_dt_basic) {
				responsiveHelper_dt_basic = new ResponsiveDatatablesHelper(\$(~#dt_basic~), breakpointDefinition);
			}
		},
		`rowCallback` : function(nRow) {
			responsiveHelper_dt_basic.createExpandIcon(nRow);
		},
		`drawCallback` : function(oSettings) {
			responsiveHelper_dt_basic.respond();
		}
	});
	
	new \$.fn.dataTable.DtServerColSearch(dt, {});
	
	\$(`#dt_basic tbody`).on(`click`, `.btn-view`, function() {
		var tr = \$(this).closest(`tr`);
		var recordId = tr.attr(`id`);
		window.location = JS_BASE_URL + `<?php echo this_module();?>/show?id=` + recordId;
	});
	
	\$(`#dt_basic tbody`).on(`click`, `.btn-edit`, function() {
		var tr = \$(this).closest(`tr`);
		var recordId = tr.attr(`id`);
		window.location =  JS_BASE_URL + `<?php echo this_module();?>/edit?id=` + recordId;
	});
	
	\$(`#dt_basic tbody`).on(`click`, `.btn-delete`, function(e) {
		e.preventDefault();				
		var tr = \$(this).closest(`tr`);
		var checkbox = [tr.attr(`id`)];
		
		var remote = JS_BASE_URL + `<?php echo this_module();?>/delete_action`;
		
		\$.post(remote, { checkbox })
			.done(function(data) {
				\$(~#myModal~).modal(~show~);
				\$(~.modal-content~).html(data);
		});
	});
		
	\$(~body~).on(~hidden.bs.modal~, ~.modal~, function () {
	  \$(this).removeData(~bs.modal~);
	});
	
	\$(~body~).on(~click~, ~#main_checkbox~, function () {
		if(\$(this).is(~:checked~)) {
			\$(~.wd_checkbox~).prop(~checked~, true);
         }
		else{
			\$(~.wd_checkbox~).prop(~checked~, false);
		}
	});
	
	\$(~#myModal~).on(~show.bs.modal~, function (e) {
		
	})
	
	\$(~body~).on(~click~, ~#btn_bulk_delete~, function (e) {
		e.preventDefault();
		
		var checkbox = \$(`#dt_basic tbody input:checkbox:checked`).map(function(){
		  return \$(this).val();
		}).get();
		
		var remote = \$(this).attr(~remote~);
		
		\$.post(remote, { checkbox })
			.done(function(data) {
				\$(~#myModal~).modal(~show~);
				\$(~.modal-content~).html(data);
		});
	});

});
	
</script>
";

$string = str_replace('`', '"', $string);
$string = str_replace('~', "'", $string);

$string .= "\n\n\n\n<!-- \n
/* Generated via crud engine by indonesiait.com | ".date('Y-m-d H:i:s')." */
\n-->";


$this->createDir($moduleDir."/views/");
$result = $this->createFile($string, $moduleDir."/views/" . $file_name);

?>