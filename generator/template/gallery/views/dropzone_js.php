<script src="<?=$this->config->item('assets')?>dropzone/dropzone.js"></script>
<script src="<?=$this->config->item('assets')?>dropzone/build.js"></script>
<script>


<?php 
if ($this->uri->segment(4)!="") { 
  echo "$('#album').attr('disabled','disabled'); ";
} 

?>
$(".paman-drop button").click(function(){
  $(".paman-drop").load("<?php echo base_url().admin_dir().this_module()."/drop" ?>");
});
var dt_thumb = $(".data-dz-thumbnail").attr("src");

var album =$("#album").val();
function cek_album(){
	
	if (album=="") {
    $.alert({ 
    title : '<i class="fa fa-info" style="color:red"></i> &nbsp; Alert!',
    content: 'Jika nama album tidak di isi, file akan di upload di direktori gallery',
    animation: 'zoom',
    closeAnimation: 'scale',          
    modal: true,
    confirmButtonClass: 'btn-info'    

    });
  }

  $(".hide").removeClass("hide");

}


  var Dropzone = require("enyo-dropzone");
  Dropzone.autoDiscover = false;

  // Dapatkan HTML Template dan menghapusnya dari dokumen
  var previewNode = document.querySelector("#template");
  previewNode.id = "";
  var previewTemplate = previewNode.parentNode.innerHTML;
  previewNode.parentNode.removeChild(previewNode);

  

  var myDropzone = new Dropzone(document.body, {

  	url: "<?php echo backend_url().this_module();?>/save_action/"+album, // mengatur url
    // paramName: "name",
    thumbnailWidth: 80,	
    thumbnailHeight: 80,
    parallelUploads: 20,
	  maxFilesize: 5, // Mb
	  acceptedFiles: "image/jpg, image/jpeg, image/png", // menentukan tipe file yang akan di upload
    previewTemplate: previewTemplate,
    autoQueue: false, // Pastikan bahwa file tidak antri sampai ditambahkan secara manual
    previewsContainer: "#previews", // menentukan elemen untuk menampilkan preview
    clickable: ".fileinput-button" // menentukan elemen pemicu untuk memilih file
  });

	$("#album").on("change",function(){
		album = $(this).val();
		myDropzone.options.url = "<?php echo backend_url().this_module();?>/save_action/"+album;		
	});

  myDropzone.on("addedfile", function(file) {
  	
    // menghubungkan tombol trart
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
  });

  // Update total progress bar pada saat proses upload
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
  });

  myDropzone.on("sending", function(file) {
    // menampilkan total progressbar
    document.querySelector("#total-progress").style.opacity = "1";
    // pada saat upload berlangsung, tombol start akan mati(disabled)
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
  });

  // progressbar akan di sembunyikan ketika prosess upload sudah selesai
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0";
  });

  // Membuat fungsi mengunggah semua gambar pada tombol start
	document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
  };
  // Membuat fungsi pembatalan semua gambar pada saat upload
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true);
  };


  
</script>
