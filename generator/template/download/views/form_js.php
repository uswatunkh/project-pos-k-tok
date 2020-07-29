<script>
function fileHandler() {

	
    var oFile = $(' #file ')[0].files[0];
    $('  #error_file  ').hide();
     
	var arr1 = new Array;
    arr1 = oFile.name.split('\\');
    var len = arr1.length;
    var img1 = arr1[len - 1];
    var filext = img1.substring(img1.lastIndexOf(".") + 1);

    
    var rFilter = /^(pdf|zip|rar|doc|docx|xls|xlsx)$/i;

    if (! rFilter.test(filext)) {
        $(' #error_file ').html('Tipe file TIDAK di ijinkan').show();
        $('#file').replaceWith( $('#file').val("") );
        
        return;
    }

   
    if (oFile.size > 20480 * 1024) {
        $(' #error_file ').html('file size TERLALU BESAR').show();
        $('#file').replaceWith( $('#file').val("") );

        
        return;
    }else if(oFile.size < 1 * 1024){
        $(' #error_file ').html('file size TERLALU KECIL').show();
        $('#file').replaceWith( $('#file').val("") );
        
        
        return;
    }

	
}
	
$(function () {
// 		$(".textarea").wysihtml5();
// $(".select2").select2();

});
</script>




<!-- 

/* Generated via crud engine by indonesiait.com | 2016-11-19 05:50:58 */

->