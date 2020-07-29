<?php

$file_name = "form_js.php";

$module_name =  $_POST['module'];
$module_name_no_space = preg_replace('/\s+/', '', $module_name);

$moduleDir = $this->moduleDir;

$primary_table = strtolower($_POST['primary_table']);

$fileSizes = $_POST['file_size'];
$fileThumb = $_POST['file_thumb'];
$fileType  = $_POST['file_type'];

$fields    = $_POST['field'];
$component = $_POST['component'];

$string = "<script>";

$textarea = "";
$select = "";

foreach($component as $key => $component_row){
	$file_size  = explode(",", $fileSizes[$key]);
	$file_thumb = explode(",", $fileThumb[$key]);
	$file_type  = explode(",", $fileType[$key]);
	$id_preview = "";
	$var_image	= "";
	$split 		= "";
	$str_image 	= "";
	$i     		= 0;	

	if ($component_row=="file" || $component_row=="image") {				

		if ( $component_row=="image") {
			$str_image = "
			
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById(`".$fields[$key]."`).files[0]);

	oFReader.onload = function (oFREvent) {
		oImage.src = oFREvent.target.result;
		oImage.style.display=`block`;
		oImage.style.maxWidth = `".$file_thumb[1]."px`;
		oImage.style.maxHeight =`".$file_thumb[0]."px`;
	};
	";
			$id_preview = "$(`#preview_".$fields[$key]."`).hide();";
			$var_image	= "var oImage	= document.getElementById(`preview_".$fields[$key]."`);";
		}



		$string .= "
function ".$fields[$key]."Handler() {

	".$var_image."
    var oFile = \$(~ #".$fields[$key]." ~)[0].files[0];
    \$(~  #error_".$fields[$key]."  ~).hide();
     
	var arr1 = new Array;
    arr1 = oFile.name.split(~\\\~);
    var len = arr1.length;
    var img1 = arr1[len - 1];
    var filext = img1.substring(img1.lastIndexOf(`.`) + 1);

    
    var rFilter = /^(";

		foreach ($file_type as $type) {
			if ($i>0) { $split ="|"; }
			$i++;
			$type = strtolower($type);
			$type = str_replace(" ", "", $type);
			if ($type=="jpg" || $type=="jpeg") {
				$type ="jpg|jpeg";
			}
			$string .= $split.$type;	
		}

		$string .= ")\$/i;

    if (! rFilter.test(filext)) {
        \$(~ #error_".$fields[$key]." ~).html(~Tipe ".$component_row." TIDAK di ijinkan~).show();
        \$(~#".$fields[$key]."~).replaceWith( \$(~#".$fields[$key]."~).val(``) );
        ".$id_preview."
        return;
    }

   
    if (oFile.size > ".$file_size[1]." * 1024) {
        \$(~ #error_".$fields[$key]." ~).html(~".$component_row." size TERLALU BESAR~).show();
        \$(~#".$fields[$key]."~).replaceWith( \$(~#".$fields[$key]."~).val(``) );

        ".$id_preview."
        return;
    }else if(oFile.size < ".$file_size[0]." * 1024){
        \$(~ #error_".$fields[$key]." ~).html(~".$component_row." size TERLALU KECIL~).show();
        \$(~#".$fields[$key]."~).replaceWith( \$(~#".$fields[$key]."~).val(``) );
        
        ".$id_preview."
        return;
    }

	".$str_image."
}
";
	}elseif ($component_row=="password") {
			$string .= "
\$('#".$fields[$key]."').change(function(){		
	if(\$(this).val()!= ''){
		\$('#re_".$fields[$key]."').attr('required', 'required');
		\$('#dt_form').attr('onsubmit','return validateForm()');
	 	
	}else{
		\$('#re_".$fields[$key]."').removeAttr('required');
		\$('#dt_form').removeAttr('onsubmit');
		\$('#al_".$fields[$key]."').hide();
	}
	
});
	
function validateForm() {
	
	   if(\$('#".$fields[$key]."').val() != \$('#re_".$fields[$key]."').val()){
		\$('#al_".$fields[$key]."').show();
		   	return false;
		}
	
}";
		}

}

$string .="	\n$(function () {
		";

foreach($component as $key => $component_row){	
	if($component_row=="textarea"){
		if($textarea==""){
			$textarea = true;
			$string .= "\$(`.textarea`).wysihtml5();\n";
		}
	}elseif($component_row=="selectjoin" || $component_row=="select" || $component_row=="checkbox"){
		if($select==""){
			$select = true;
			$string .= "\$(`.select2`).select2();\n";
		}
	}elseif ($component_row=="tag") {
		$string .= "\$(`.select2`).select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });\n";
	}elseif ($component_row=="ckeditor") {
		$string .= " CKEDITOR.replace(~".$fields[$key]."~);
		";
	}elseif ($component_row=="datepicker") {
		$string .="
	\$('#".$fields[$key]."').datepicker({
    	format: 'yyyy-mm-dd',
    	autoclose:true
    });\n";
	}elseif ($component_row=="radio") {
		$string .="
	\$(~input[type=`checkbox`].minimal, input[type=`radio`].minimal~).iCheck({
      checkboxClass: ~icheckbox_minimal-blue~,
      radioClass: ~iradio_minimal-blue~
    });
		";
	}
}
$string .="
});
</script>
";

$string = str_replace('`', '"', $string);
$string = str_replace('~', "'", $string);

$string .= "\n\n\n\n<!-- \n
/* Generated via crud engine by indonesiait.com | ".date('Y-m-d H:i:s')." */
\n-->";
// echo $string;
// exit();
$this->createDir($moduleDir."/views/");
$result = $this->createFile($string, $moduleDir."/views/" . $file_name);

?>