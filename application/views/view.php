<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>K-Tok</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

      <!-- Bootstrap 3.3.5 -->
      <link rel="stylesheet" href="<?php echo $this->config->item('assets');?>AdminLTE/bootstrap/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="<?php echo $this->config->item('assets').'AdminLTE/'; ?>font-awesome-4.6.2/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="<?php echo $this->config->item('assets').'AdminLTE/'; ?>ionicons-2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="<?php echo $this->config->item('assets').'front.css'; ?>">
    <link rel="stylesheet" href="<?=base_url()?>assets/jconfirm/jquery-confirm.min.css">

      <!-- Theme style -->
      <link rel="stylesheet" href="<?php echo $this->config->item('assets');?>AdminLTE/dist/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="<?php echo $this->config->item('assets');?>AdminLTE/dist/css/skins/_all-skins.min.css">
      <link rel="stylesheet" href="<?php echo $this->config->item('assets');?>AdminLTE/wd_custom/style.css">
      <link rel="stylesheet" href="<?php echo $this->config->item('assets');?>AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

      <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<!--    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">-->

      <link rel="stylesheet" href="<?php echo $this->config->item('assets');?>AdminLTE/plugins/datatables/dataTables.bootstrap.css">
      <link rel="stylesheet" href="<?php echo $this->config->item('assets');?>AdminLTE/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">

      <link rel="stylesheet" href="<?php echo $this->config->item('assets');?>AdminLTE/plugins/datatables/extensions/export/buttons.dataTables.min.css">
      <link rel="stylesheet" href="<?php echo $this->config->item('assets');?>AdminLTE/plugins/datatables/extensions/export/buttons.bootstrap.min.css">

      <link rel="stylesheet" href="<?php echo $this->config->item('assets');?>AdminLTE/wd_custom/datatables.css">


<?php if(!$form_page) {?>
<link href="<?=base_url()?>assets/bootgrid/jquery.bootgrid.css" rel="stylesheet" type="text/css" >
<?php } ?>
      <!-- jQuery 2.1.4 -->
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"></script>
      <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/jQuery/jquery.visible.min.js"></script>
      <script src="<?=base_url()?>assets/jconfirm/jquery-confirm.min.js"></script>
      <!-- jQuery UI 1.11.4 -->
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script src="<?=base_url('assets/jquery.mtz.monthpicker.js') ?>"></script>
      <script>
          //      $.widget.bridge('uibutton', $.ui.button);
      </script>
      <!-- Bootstrap 3.3.5 -->
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/bootstrap/js/bootstrap.min.js"></script>

      <!-- daterangepicker -->
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/moment.min.js"></script>

      <!-- Slimscroll -->
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js"></script>
      <!-- FastClick -->
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/fastclick/fastclick.min.js"></script>
      <!-- AdminLTE App -->
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/dist/js/app.js"></script>

      <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
      <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

      <script src="<?php echo $this->config->item('assets');?>AdminLTE/dist/js/demo.js"></script>
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/wd_custom/script.js"></script>
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>

      <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/datatables/dataTables.bootstrap.js"></script>
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/datatable-responsive/datatables.responsive.min.js"></script>

      <script src="<?php echo $this->config->item('assets');?>AdminLTE/js/datatables.colsearch.js"></script>
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/datatables/extensions/export/dataTables.buttons.min.js"></script>
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/datatables/extensions/export/buttons.bootstrap.min.js"></script>
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/datatables/extensions/export/jszip.min.js"></script>
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/datatables/extensions/export/pdfmake.min.js"></script>
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/datatables/extensions/export/vfs_fonts.js"></script>
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/datatables/extensions/export/buttons.html5.min.js"></script>
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/datatables/extensions/export/buttons.print.min.js"></script>
      <script src="<?php echo $this->config->item('assets');?>AdminLTE/plugins/datatables/extensions/export/buttons.colVis.min.js"></script>
<style>
  label.error{ color: red }
  .nopadding { padding: 0 !important }
  /* Style the tab */
.tab {  
  border: 1px solid #ccc;
  background-color: #f1f1f1; 
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;  
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
.gap {
  max-width: : 800px; 
}
</style>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <a href="<?base_url('dashboard')?>" class="logo">
          <span class="logo-mini"><b>K-Tok</b></span>
          <span class="logo-lg"><b>K-Tok</b></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs"><?=$a_user['nama']?></span>
                  <i class="fa  fa-chevron-down"></i>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <p>
                      <?=$a_user['nama']?>
                      <!-- <small>Member since Nov. 2012</small> -->
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?=base_url('dashboard')?>" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a id="logout" href="#" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

     <?php $this->load->view('sidebar'); ?>

      <div class="content-wrapper">
        <section class="content-header">
          <h1><?=ucwords(str_replace('_', ' ', $this->uri->segment(1))) ?>            <small><?=$header_mini?></small>          </h1>
          <ol class="breadcrumb">
            <?php echo $this->breadcrumb->output()?>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content" >
          <div class="row">
            <?php if (isset($content)) $this->load->view($content); ?>
          </div>
        </section>        
        <!-- /.content -->

      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <!-- <div class="pull-right hidden-xs">          <b>Version</b> 2.3.0        </div> -->
        <strong>Copyright &copy; 2020 <a href="<?=base_url()?>">K-Tok</a>.</strong> All rights reserved.
      </footer>

    </div><!-- ./wrapper -->

    <?php
    if(isset($layout_includes['js']) AND count($layout_includes['js']) > 0): ?>
        <?php foreach($layout_includes['js'] as $js): ?>
            <?php if($js['options'] == NULL AND $js['options'] !== 'header'): ?>
                <script src="<?php echo $js['file']; ?>"></script>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php
    if(isset($layout_includes['inline']) AND count($layout_includes['inline']) > 0): ?>
        <?php foreach($layout_includes['inline'] as $inline): ?>
            <?php echo $inline['file']; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if(!$form_page){ ?>
    <script src="<?=base_url()?>assets/bootgrid/jquery.bootgrid.js" type="text/javascript"></script>
    <script>
    function confirm_delete(list,items,link){
      $.confirm({
        title: '<i class="text-warning fa fa-info-circle"></i> Konfirmasi Hapus!',
        content:  list+'<i>Seluruh data yang bersangkutan dengan ujian ini akan di hapus?</i>',
        buttons: {
          Ya: {
              text: 'OK',
              btnClass: 'btn-blue btn-xs',
              action: function(){ 
                $.ajax({
                  url: link,
                  type: 'post',
                  data: { item : items},
                  dataType: 'json',
                  success:function (e) { 
                    $.alert(e.ket, '<i class="text-info fa fa-info-circle"></i> '+e.status);
                    $("#data").bootgrid("reload");
                  }
                });
              }
          },
          Batal: { }
        }
      }); 
    }
    function deleteFromObject(keyPart, obj){
        for (var k in obj){
            if(~k.indexOf(keyPart)){
                delete obj[k];
            }
        }
    }
    </script>
<?php } ?>
  </body>
</html>
