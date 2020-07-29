
<!-- Main content -->
<section class="content">
  <link href="<?php echo base_url().'assets/css/filter.css'?>" rel="stylesheet">
<link href="<?php echo base_url().'assets/css/jquery.dataTables.min.css'?>" rel="stylesheet">
  <div class="row">
  <form action="" method="post">
  <div class="col-xs-12">
    <div class="box">
    <div class="box-header">
      <h3 class="box-title"><?php if(isset($sub_title)) echo $sub_title; ?></h3>
      <!-- Modal HTML -->
      <div id="myModal"class="modal fade modal-primary">
        <div class="modal-dialog">
            <div class="modal-content"> 
            </div>
        </div>
      </div>  
    <!-- dgd -->
    </div><!-- /.box-header -->
    <div class="box-body">
      <?php show_alert('success',$this->session->flashdata('success_message'));?>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>                        
            <th data-class="expand">Bulan</th>
            <th data-class="expand">Pendapatan</th>
            <th data-class="expand">Pengeluaran</th>
            <th data-class="expand">Pendapatan Bersih</th>                   
          </tr>
          <tbody>
            <?php
            $months = date("m");
            $bulans = $months - 1;
            for($i=0;$i<=$bulans;$i++){
              $total = $pendapatan[$i]-$pengeluaran[$i];
              $pend = "";
              $peng = "";
              //validasi pendapatan
              if($pendapatan[$i] == 0 || $pendapatan[$i] =="" || $pendapatan[$i] <=0){
                $pend .="0";
              }
              if($pendapatan >0){
                $pend .=$pendapatan[$i];
              }
              //validasi pengeluaran
              if($pengeluaran[$i] == 0 || $pengeluaran[$i] =="" || $pengeluaran[$i] <=0){
                $peng .="0";
              }
              if($pengeluaran >0){
                $peng .=$pengeluaran[$i];
              }
              ?>
              <tr>
                <td><?=$bulann[$i]?></td>
                <td><?php echo rupiah($pend) ?></td>
                <td><?php echo rupiah($peng) ?></td> 
                <?php
                if($total<=0){ 
                ?>
                <td>0</td>
                <?php } ?>
                <?php if($total>0){ ?>    
                <td><?=rupiah($total)?></td>
                <?php } ?>               
              </tr>
            <?php
            }
            ?>          
          </tbody>
        </thead>    
      </table>
    </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col -->
  </form>
  </div><!-- /.row -->
</section><!-- /.content -->




<!-- 

/* Generated via crud engine by indonesiait.com | 2018-08-15 09:48:38 */

-->