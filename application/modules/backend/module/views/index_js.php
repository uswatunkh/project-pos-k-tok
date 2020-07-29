<style>
<?php 
	foreach($table_module as $row){
		$id = $this->urlcrypt->encode($row['id']);
		echo '
			#'.$id.' .btn-table{ display: block !important }
		';
	}

 ?>
	
</style>
<?php 

$disabled = "";
if($privilege['U']!="1" && $privilege['D']!="1"){
	$disabled = "disabled";
}

$action = '<span class="btn btn-default btn-view btn-xs"> View </span>';

	$action .= 
		'
		<div class="btn-group">
			<button type="button" class="btn btn-xs btn-default '.$disabled.'">Action</button>

				<button type="button" class="btn btn-xs btn-default dropdown-toggle '.$disabled.'" data-toggle="dropdown">
				<span class="caret"></span><span class="sr-only">Toggle Dropdown</span> </button>';

if($privilege['U']=="1" || $privilege['D']=="1"){
	$action .= '<ul class="dropdown-menu" role="menu">';

	if($privilege['U']=="1"){
		$action .= '<li><a class="btn-edit" href="#">Edit</a></li>';
	}

	if($privilege['D']=="1"){
		$action .= '
		<li><a class="btn-delete" href="#">Delete</a></li>
		<li class="btn-table" style="display:none"><a href="#">Delete all data</a></li>'
		;
	}

	$action .='</ul>
		';
}

$action .='</div>';

$action = str_replace(PHP_EOL, '', $action);
?>

<script>  
	
$(function() {
	
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
	var dt = $("#dt_basic").DataTable({
		processing: true,
        serverSide: true,
		"lengthMenu": [ [100], [100] ],
		// "lengthMenu": [ [25, 50, 100], [25, 50, 100] ],
		"order": [[ 6, "asc" ]],
		autoWidth:false,
		"language": {
			"lengthMenu": "Display _MENU_ "
		},
		buttons: [
			{
				extend: 'copyHtml5',

				text: '<i class="fa fa-copy"></i> Copy',

				header: false,

				exportOptions: {

					modifier: {

						selected: true

					},

					orthogonal: 'copy'

				}
        	},
			{
				extend: 'collection',
                text: '<i class="fa fa-file-excel-o"></i> Export',
                buttons: [
					{
						extend: 'excel',

						text: 'excel',

						exportOptions: {

							columns: ':visible'

						}
					},
					{
						extend: 'csv',

						text: 'csv',

						exportOptions: {

							columns: ':visible'

						}
					},
					{
						extend: 'pdf',

						text: 'pdf',

						exportOptions: {

							columns: ':visible'

						}
					}
                ]
			},
			{
				extend: 'print',
				text: '<i class="fa fa-print"></i> Print',
				autoPrint: false
        	},
			{
				extend: 'colvis',
				text: '<i class="fa fa-eye-slash"></i> Show'
        	}
        ],
        ajax: {
            "url": JS_BASE_URL + "<?php echo this_module();?>/dataTable",
            "type": "POST"
        },
        columns: [
			{ 
				data: "checkboxs",
				orderable: false,
				searchable: false
			},
			{ 
				data: "number",
				orderable: false,
				searchable: false
			},
			{ data: "m.id" },
			{ data: "m.title" },
			{ data: "m.icon" },
        	{ data: "m.url" },
			{ data: "m.sort_order"},
			{ data: "m.parent"},
			{ data: "m.only_super"},
			{
				data: null,
				defaultContent: '<?php echo $action;?>',
				orderable: false,
				searchable: false,
				width:'130px'
			}
        ],
		"preDrawCallback" : function() {
			// Initialize the responsive datatables helper once.
			if (!responsiveHelper_dt_basic) {
				responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
			}
		},
		"rowCallback" : function(nRow) {
			responsiveHelper_dt_basic.createExpandIcon(nRow);
		},
		"drawCallback" : function(oSettings) {
			responsiveHelper_dt_basic.respond();
			<?php 
			foreach($no_delete as $row){
				$id = $this->urlcrypt->encode($row['id']);
				echo '
					$("#'.$id.' input[type=checkbox]").attr("name", "");
					$("#'.$id.' input[type=checkbox]").attr("id", "");
					$("#'.$id.' input[type=checkbox]").attr("class", "");
					$("#'.$id.' input[type=checkbox]").attr("disabled", true);
					$("#'.$id.' td ul li a").remove(".btn-delete");
				';
			}

			?>
			dt.column(2).visible( false );
			dt.column(6).visible( false );
			dt.column(7).visible( false );
			dt.column(8).visible( false );
		}
	});
	
	new $.fn.dataTable.DtServerColSearch(dt, {});
	
	$("#dt_basic tbody").on("click", ".btn-view", function() {
		var tr = $(this).closest("tr");
		var recordId = tr.attr("id");
		window.location = JS_BASE_URL + "<?php echo this_module();?>/show?id=" + recordId;
		console.log(recordId);
	});
	
	$("#dt_basic tbody").on("click", ".btn-edit", function() {
		var tr = $(this).closest("tr");
		var recordId = tr.attr("id");
		window.location =  JS_BASE_URL + "<?php echo this_module();?>/edit?id=" + recordId;
		console.log(recordId);
	});
	
	$("#dt_basic tbody").on("click", ".btn-delete", function(e) {
		e.preventDefault();				
		var tr = $(this).closest("tr");
		var checkbox = [tr.attr("id")];
		
		var remote = JS_BASE_URL + "<?php echo this_module();?>/delete_action";
		
		$.post(remote, { checkbox })
			.done(function(data) {
				$('#myModal').modal('show');
				$('.modal-content').html(data);
		});
	});
	$("#dt_basic tbody").on("click", ".btn-table", function(e) {
		e.preventDefault();				
		var tr = $(this).closest("tr");
		var checkbox = [tr.attr("id")];
		
		var remote = JS_BASE_URL + "<?php echo this_module();?>/delete_action/all";
		
		$.post(remote, { checkbox })
			.done(function(data) {
				$('#myModal').modal('show');
				$('.modal-content').html(data);
		});
	});
		
	$('body').on('hidden.bs.modal', '.modal', function () {
	  $(this).removeData('bs.modal');
	});
	
	$('body').on('click', '#main_checkbox', function () {
		if($(this).is(':checked')) {
			$('.wd_checkbox').prop('checked', true);
         }
		else{
			$('.wd_checkbox').prop('checked', false);
		}
	});
	
	$('#myModal').on('show.bs.modal', function (e) {
		
	})
	
	$('body').on('click', '#btn_bulk_delete', function (e) {
		e.preventDefault();
		
		var checkbox = $("#dt_basic tbody input:checkbox:checked").map(function(){
		  return $(this).val();
		}).get();
		
		var remote = $(this).attr('remote');
		
		$.post(remote, { checkbox })
			.done(function(data) {
				$('#myModal').modal('show');
				$('.modal-content').html(data);
		});
	});

});

	
	
</script>