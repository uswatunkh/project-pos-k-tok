          <section class="content"> 

          <div class="row">
            <div class="col-md-12 gap">
            <nav class="navbar navbar-default">
            <div class="container-fluid">
              <div class="navbar-header">
                <a class="navbar-brand" href="#">GRAFIK BISNIS USAHA LAUNDRY</a>
              </div>
              <ul class="nav navbar-nav">
                <?php foreach($dat_kios as $row){ ?>
                <li><a href="dashboard?id_kios=<?=$row->id?>">KIOS <?=strtoupper($row->nama)?></a></li>
                <?php } ?>                    
              </ul>
              <div class="navbar-header">

                <?php if($excel_kios !=""){
                  echo '
                    <a class="navbar-brand" href="dashboard/excel?id_kios='.$excel_kios.'"> <i class="fa fa-file-excel-o"></i> Export Excel</a>';
                    }

                else  { 
                  echo'
                      ';
                }
                  ?>
              </div>
            </div>
          </nav>
          </div>        
         </div>      
<!-- dgsd -->
         <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Transaksi</span>
              <span class="info-box-number"><?=$transaksi?></span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa  fa-calculator  "></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Transaksi Bulan Ini</span>
              <span class="info-box-number"><?=$transaksi_bulan_ini?></span>
            </div>
          </div>
        </div>

        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa  fa-money"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Omset Bulan ini</span>
              <span class="info-box-number"><?=rupiah($omset_k)?></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa  fa-dollar"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Saldo Anda</span>
              <span class="info-box-number"><?=$saldo?></span>
            </div>
          </div>
        </div>
        </div>

        <div class="row">          
      <section class="col-lg-6 connectedSortable">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title" style="font-weight:400;"><i class="fa fa-bar-chart"></i> Pendapatan Kios/Bulan</h3> 
            <span class="tombol-title pull-right">
                 <!-- <a id="btn_create" class="btn btn-s btn-info " href="detail?id_kios=<?=$row->id?>"> -->
                  <?php
                  if ($id_kios!="") { ?>
                  <a id="btn_create" class="btn btn-s btn-info " href="<?=base_url().$this->uri->segment(1).'/detail/'.'?id_kios='.$id_kios ?>">
                  <?php } ?>
                  <?php
                  if ($id_kios=="") { ?>
                  <a id="btn_create" class="btn btn-s btn-info " href="<?=base_url().$this->uri->segment(1).'/detail/' ?>">
                  <?php } ?>
                  <i class="ion-plus-round"></i>
                    Detail
                  </a>
              </span>                   
          </div>
          <div class="box-body">
            <div class="box" id="pendapatan"> Sedang memuat ... </div>
          </div>
        </div>
      </section>

      
      <section class="col-lg-6 connectedSortable">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title" style="font-weight:400;"><i class="fa fa-bar-chart"></i> Jumlah Transaksi</h3>
          </div>
          <div class="box-body">
            <div class="box" id="jml_transaksi"> Sedang memuat ... </div>
          </div>
        </div>
      </section>

    </div >
    <div class="row">

      <section class="col-lg-6 connectedSortable">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title" style="font-weight:400;"><i class="fa fa-bar-chart"></i> Layanan Yang Paling Banyak Digunakan</h3>
          </div>
          <div class="box-body">
            <div class="box" id="layanan_terbanyak"> Sedang memuat ... </div>
          </div>
        </div>
      </section>

      <section class="col-lg-6 connectedSortable">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title" style="font-weight:400;"><i class="fa fa-bar-chart"></i> Jumlah Transaksi per Pelanggan</h3>
            <span class="tombol-title pull-right">
              <h4 class="box-title" style="font-weight:100;">
                Jumlah Pelanggan : 
              <?php
              foreach($jml_costumer as $row){
                echo $row->jml_pelanggan;
              }
              ?>
            </h4>
            </span>
          </div>
          <div class="box-body">
            <div class="box" id="jml_pelanggan"> Sedang memuat ... </div>
          </div>
        </div>
      </section>

      </div>

      </section> 

<script type="text/javascript">
$(function () {

    $('#layanan_terbanyak').highcharts({
            chart: { type: 'column' },
            title: { text: 'Layanan Laundry Yang Paling Banyak Di Gunakan' },
            subtitle: { text: 'Top 7' },
            xAxis: { type: 'category' },
            yAxis: { title: { text: 'Jumlah Penggunaan' }  },
            legend: { enabled: false },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {

                        enabled: true,
                        format: '{point.y:,.0f}'
                    }
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:,.0f}</b> <br/>'
            },
            series: [{
                name: 'Total Topup',
                colorByPoint: true,
                data: <?=$this->data['jml_layanan_hc']?>
            }]
        });

        $('#jml_pelanggan').highcharts({
            chart: { type: 'column' },
            title: { text: 'Daftar transaksi/pelanggan' },
            subtitle: { text: 'Top 7' },
            xAxis: { type: 'category' },
            yAxis: { title: { text: 'Jumlah Transaksi' }  },
            legend: { enabled: false },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {

                        enabled: true,
                        format: '{point.y:,.0f}'
                    }
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:,.0f}</b> <br/>'
            },
            series: [{
                name: 'Total Topup',
                colorByPoint: true,
                data: <?=$this->data['jml_pelanggan_hc']?>
            }]
        });

        $('#jml_transaksi').highcharts({
        chart: { type: 'column' },
        title: { text: 'Jumlah Transaksi Tiap Bulan' },
        subtitle: { text: 'Top 7' },
        xAxis: { type: 'category' },
        yAxis: { title: { text: 'Jumlah Transaksi' }  },
        legend: { enabled: false },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:f}'
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}</b> <br/>'
        },
        series: [{
            name: 'Peserta',
            colorByPoint: true,
            data: <?=$this->data['jml_transaksi_hc']?>
        }]
    });
    
    $('#pendapatan').highcharts({
            chart: { type: 'column' },
            title: { text: 'Pendapatan Kios Tiap Bulan' },
            subtitle: { text: 'Top 7' },
            xAxis: { type: 'category' },
            yAxis: { title: { text: 'Pendapatan' }  },
            legend: { enabled: false },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {

                        enabled: true,
                        format: '{point.y:,.0f}'
                    }
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:,.0f}</b> <br/>'
            },
            series: [{
                name: 'Total Topup',
                colorByPoint: true,
                data: <?=$this->data['langgan_hc']?>
            }]
        });

});
        </script>

<script src="<?= base_url()?>/assets/movable/hightchart/highcharts.js"></script>
<script src="<?= base_url()?>/assets/movable/hightchart/modules/data.js"></script>      