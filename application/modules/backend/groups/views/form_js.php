<script>
$(document).ready(function () {
var flag=1;
	
  $('.col-sm-7 .checkbox input:checkbox').change(function () {
	  flag = 0;
	  var input = $(this);
	  var recordId = input.attr("no");
	  var parentId = input.attr("parent");
	  
	  if ($("#roles-"+recordId).is(":checked")) {
		$("#a-"+recordId).prop( "checked", true );
		$("#c-"+recordId).prop( "checked", true );
		$("#r-"+recordId).prop( "checked", true );
		$("#u-"+recordId).prop( "checked", true );
		$("#d-"+recordId).prop( "checked", true );  
		  
		$("#roles-"+parentId).prop( "checked", true ); 
		$("#roles-"+parentId).trigger("change");
	  }
	  else{
		$("#a-"+recordId).prop( "checked", false );
		$("#c-"+recordId).prop( "checked", false );
		$("#r-"+recordId).prop( "checked", false );
		$("#u-"+recordId).prop( "checked", false );
		$("#d-"+recordId).prop( "checked", false );  
		  
		$("input:checkbox[parent='"+recordId+"']").prop( "checked", false );
		$("input:checkbox[parent='"+recordId+"']").trigger("change");
	  }
	  
	    $("#a-"+recordId).trigger("change");
		$("#c-"+recordId).trigger("change");
		$("#r-"+recordId).trigger("change");
		$("#u-"+recordId).trigger("change");
		$("#d-"+recordId).trigger("change");
  });
	
  $('.col-sm-1 .checkbox input:checkbox').click(function () {
	  	//untuk membatasi looping triger
		flag=1;  
  });
	
  $('.col-sm-1 .checkbox input:checkbox').change(function () {
	  var input = $(this);
	  var recordId = input.attr("no");
	  var id_value = input.attr("id");
	  var parentId = input.attr("parent");
	  
	  
	  if ($("#a-"+recordId).is(":checked") || $("#c-"+recordId).is(":checked") || $("#r-"+recordId).is(":checked") || $("#u-"+recordId).is(":checked") || $("#d-"+recordId).is(":checked")) {
		  $("#roles-"+recordId).prop( "checked", true );
		  
		  //Otomatis mengaktifkan akses read jika user checklist create update delete
		  if($("#a-"+recordId).is(":checked") || $("#c-"+recordId).is(":checked") || $("#u-"+recordId).is(":checked") || $("#d-"+recordId).is(":checked")){
			  $("#r-"+recordId).prop( "checked", true );
			  $("input[id_value='r-"+recordId+"']").val("1");
		} 
	  }
		
	  if (!$("#a-"+recordId).is(":checked") && !$("#c-"+recordId).is(":checked") && !$("#r-"+recordId).is(":checked") && !$("#u-"+recordId).is(":checked") && !$("#d-"+recordId).is(":checked")) {
		  $("#roles-"+recordId).prop( "checked", false );
		  
		  //Menghapus name Hidden Value jika tidak ada satupun privilage yang dipilih
		  $("input[id_value='m-"+recordId+"']").attr('name', "");
		  $("input[id_value='a-"+recordId+"']").attr('name', "");
		  $("input[id_value='r-"+recordId+"']").attr('name', "");
		  $("input[id_value='c-"+recordId+"']").attr('name', "");
		  $("input[id_value='u-"+recordId+"']").attr('name', "");
		  $("input[id_value='d-"+recordId+"']").attr('name', "");
	  }
	  
	  //Mengisi name Hidden Value 
	  if ($("input[id='"+id_value+"']").is(":checked")) {
		  $("input[id_value='"+id_value+"']").val("1");
		  $("input[id_value='m-"+recordId+"']").attr('name', "is_module[]");
		  $("input[id_value='a-"+recordId+"']").attr('name', "admin[]");
		  $("input[id_value='r-"+recordId+"']").attr('name', "read[]");
		  $("input[id_value='c-"+recordId+"']").attr('name', "create[]");
		  $("input[id_value='u-"+recordId+"']").attr('name', "update[]");
		  $("input[id_value='d-"+recordId+"']").attr('name', "delete[]");
	  }
	  else{
		  $("input[id_value='"+id_value+"']").val("0");
	  }
	  
	  if(flag==1){
		   $("#roles-"+parentId).prop( "checked", true ); 
	  	   $("#roles-"+parentId).trigger("change");
	  }
	 
  });
});
</script>

