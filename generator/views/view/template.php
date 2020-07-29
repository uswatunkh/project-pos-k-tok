<?php 
$module_name=array();
$link = "./template";
if (file_exists($link)) {
$folder = new DirectoryIterator($link);
  
  foreach ($folder as $file) {
    $filen = $file->getFilename(); 
    $dot = substr($filen, 0,1); 
      if (!$file->isDot() and $dot!="." ){

        $ext = strrchr($filen, ".sql");
        if ($ext=='.sql') continue;
        
        $module_name[] = $filen;
      }
  }
} else{
  echo '
  <section class="content-header">
    <h1>
    <i class="fa fa-clone"></i> Template <small>simple module</small>
    </h1>
    <ol class="breadcrumb"><li>Home</li><li>Template/li></ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="alert alert-warning" style="margin-top: 10%;text-align: center;  margin-left: 20px;margin-right: 20px;">Template folder doesn\'t exists!</div>
      </div>
    </div>
  </section>';

exit;
}


?>



<style>
  .center{ text-align: center  }
  .success-msg{ color:darkgreen  }
  .warning-msg{ color:darkred }
</style>

<section class="content-header">
  <h1>
	<i class="fa fa-clone"></i> Template <small>simple module</small>
  </h1>
  <ol class="breadcrumb"><li>Home</li><li>Template/li></ol>
</section>

<section class="content">
  <div class="row">

<div class="col-md-6">
      <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Please choose the modules you need </h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
            <div class="status center" style="min-height: 20px;"></div>
              <table class="table table-condensed">
                <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Module</th>
                  <th></th>
                  <th class="center" style="width: 20px">Action</th>
                </tr>

<?php 
foreach ($module_name as $i => $name) {  
if ( file_exists(  "../application/modules/backend/".$name ) ) {
   $check = "<span class='badge bg-blue'>in use</span>";
   $hidden_reg = "hidden";
   $hidden_unreg = ""; 
}else{
  $check = "<span class='badge bg-yellow'>not use</span>" ;
    $hidden_reg = "";
    $hidden_unreg = "hidden"; 
}
    
?>                 
                <tr id="<?= str_replace(" ","", $name)?>">
                  <td><?=$i+1?></td>
                  <td><b ><?= ucfirst($name) ?></b></td>
                  <td id="<?= str_replace(" ","", $name)?>_v">
                  <?=$check?>
                  </td>
                  <td >
                  <a class="btn reg btn-xs bg-green <?=$hidden_reg?>">Install</a>
                  <a class="btn unreg btn-xs bg-red <?=$hidden_unreg?>">Uninstall</a></td>
                </tr>
<?php } ?>
                <tr>
                  <td></td>
                  <td style="width:10px"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody></table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->      

          
    </div>



<div class="col-md-6">
    <div class="box box-info">
    <div class="box-header">
      <h3 class="box-title">File Hierarchy of the Source Code Package</h3>
    </div><!-- /.box-header -->   
    <pre  style=" background: #333;color: #fff;position: relative;z-index: 30;margin-left: 20px;margin-right: 20px">
     <code class="language-bash" data-lang="bash">
  Root_folder/    
  ├── application/
  │   └── modules/
  │       └── backend
  │           └──(HERE YOUR TEMPLATE MODULE INSERTED)
  │
  ├── assets/
  │   └── AdminLTE/
  │       └──(Backend template)
  │
  ├── generator/
  │   └──template/
  │       └──(TEMPLATES MODULES BACKEND FOLDER)
  │
  ├── public/
  │   └──(FILE AND MEDIA FROM USER UPLOAD)        
     </code>
     </pre>       
        
    </div><!-- /.box -->
  </div><!-- /.col -->


  </div>
         

          

        </section>
<!-- Main content -->

<script>
$(function(){
  var reg="<?php echo $this->base_url();?>index.php/simple/register?data=";
	var unreg="<?php echo $this->base_url();?>index.php/simple/unregister?data=";
  
  $(".reg" ).click(function() {
    var tr = $(this).closest("tr");
    var id = $(tr).attr("id");   
		$("#"+id+"_v").load(reg+id);

    if($("#"+id+"_v>.success-msg").html!=""){
      $(this).addClass("hidden");
      $("#"+id+" td a.unreg").removeClass("hidden");
    }else{
      $(this).removeClass("hidden");
      $("#"+id+" td a.unreg").addClass("hidden");

    }		
		return false;
	});

  $(".unreg" ).click(function() {
    var tr = $(this).closest("tr");
    var id = $(tr).attr("id");  
    $("#"+id+"_v").load(unreg+id);  

    if($("#"+id+"_v>.success-msg").html!=""){
      $(this).addClass("hidden");
      $("#"+id+" td a.reg").removeClass("hidden");
    }else{
      $(this).removeClass("hidden");
      $("#"+id+" td a.reg").addClass("hidden");

    }  
    return false;
  });
});	

</script>


 <!-- 
 * Copyright (c) 2016 indonesiait
 * http://www.indonesiait.com
 * Author:Paman_han
 -->