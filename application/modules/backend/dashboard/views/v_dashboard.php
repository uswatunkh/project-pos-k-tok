<section class="content-header">
  <h1>
    <?php
    if (!isset($primary_title)) {
      echo "Judul Utama";
    } else {
      echo $primary_title;
    }
    ?>
    <small>
      <?php
      if (!isset($sub_primary_title)) {
        echo "Sub judul utama";
      } else {
        echo $sub_primary_title;
      }
      ?>
    </small>
  </h1>
  <ol class="breadcrumb">
    <?php echo $this->breadcrumb->output() ?>
  </ol>

</section>

<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner font_dinamic">
          <h3><?php echo number_format($online, 0, ',', '.'); ?></h3>
          <p>Online Users</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner font_dinamic">
          <h3><?php echo number_format($user_registrations, 0, ',', '.'); ?></h3>
          <p>User Registrations</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner font_dinamic">
          <h3 id="record_in_db"><?php echo number_format($record_in_db, 0, ',', '.'); ?></h3>
          <p>Record[s] on Database</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-list"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner font_dinamic">
          <h3><?php echo number_format($wd_modules, 0, ',', '.'); ?></h3>
          <p>Modules</p>
        </div>
        <div class="icon">
          <i class="ion ion-code-working"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div><!-- ./col -->
  </div><!-- /.row -->
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->

    <!-- Left col -->
    <section class="col-lg-6 connectedSortable">

      <!-- BAR CHART -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title" style="font-weight:400;"><i class="fa fa-bar-chart"></i> Data</h3>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="pieChart" style="height:230px"></canvas>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </section><!-- /.Left col -->


    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-6 connectedSortable">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title" style="font-weight:400;"><i class="fa fa-clock-o"></i> Latest login :</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="display: block;">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Last Login</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $no = 1;
                foreach ($latest_login as $latest_login) :
                  $username =  $latest_login['username'];

                  $time = unix_to_human($latest_login['last_login']);
                  $substrtime = substr($time, -8);

                  $unix = unix_to_human($latest_login['last_login']);
                  $time_elapsed_string = time_elapsed_string($unix);
                  $convert_date = convertDate(substr($unix, 0, 10), 'd m y');

                ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $username ?></td>
                    <td><span class="label label-success"><?php echo $convert_date ?> <?php echo $substrtime ?></span>
                      <span class="label label-warning"><?php echo $time_elapsed_string ?></span></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
      </div>
    </section><!-- right col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->