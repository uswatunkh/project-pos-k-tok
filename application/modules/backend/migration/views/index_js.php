
<script>  
	$(function () {
		var responsiveHelper_dt_basic = undefined;
		var responsiveHelper_datatable_fixed_column = undefined;
		var responsiveHelper_datatable_col_reorder = undefined;
		var responsiveHelper_datatable_tabletools = undefined;

		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		
        var dt = $('#dt_basic').DataTable({
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          autoWidth: false,
		  buttons: [
			{
				extend: 'copy',
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
							columns :':visible'
						}
					},
					{
						extend: 'csv',
						text: 'csv',
						exportOptions: {
							columns :':visible'
						}
					},
					{
						extend: 'pdf',
						text: 'pdf',
						exportOptions: {
							columns :':visible'
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
		}
			
		
		  
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
		
      });
</script>




<!-- 

/* Generated via crud engine by indonesiait.com | 2017-03-31 00:57:07 */

-->