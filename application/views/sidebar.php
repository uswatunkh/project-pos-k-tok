<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION?></li>
      <?php
        $id_user=$a_user['id'];
        $sql = $this->db->query("SELECT * FROM user WHERE id = ".$id_user." ")->row();
        if($sql->jenis == "kasir"){
          $toko = $this->db->query("SELECT toko.id,toko.nama FROM toko INNER JOIN kasir_toko ON toko.id = kasir_toko.id_toko WHERE kasir_toko.id_user = ".$sql->id." ")->row();
      ?>
      <li class="<?=active_menu('dashboard')?>">
        <a href="<?=base_url('dashboard')?>">
          <i class="fa fa-dashboard text-yellow"></i><span>Dashboard</span> 
        </a>
      </li>
      <li class="<?=active_menu('transaksi')?>">
        <a href="<?=base_url('transaksi?id_toko='.$toko->id.'')?>">
          <i class="fa fa-user text-yellow"></i> <span>Transaksi</span>
        </a>
      </li>

        <li class="<?=active_menu('pelanggan')?>">
        <a href="<?=base_url('pelanggan?id_toko='.$toko->id.'')?>">
          <i class="fa fa-user text-yellow"></i> <span>Pelanggan</span>
        </a>
      </li>    

      <?php }
       if($sql->jenis == "pemilik"){
        $sql_kios = $this->db->query("SELECT id,nama FROM toko WHERE id_pemilik = ".$id_user." ")->result();
        $sql_kasir = $this->db->query("SELECT id,nama FROM user WHERE id_pemilik = ".$id_user." ")->result()
      ?>
      <li class="<?=active_menu('dashboard')?>">
        <a href="<?=base_url('dashboard')?>">
          <i class="fa fa-dashboard text-yellow"></i><span>Dashboard</span> 
        </a>
      </li>

      <li class="<?=active_menu('profile')?>">
        <a href="<?=base_url('profile')?>">
          <i class="fa fa-user text-yellow"></i> <span>Profile</span>
        </a>
      </li>

      <li class="treeview <?=active_menu('Kasir')?>">
        <a href="#">
          <i class="fa fa-calculator text-yellow"></i>
          <span>Kasir</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=base_url('kasir/tambah_kasir')?>">Tambah Kasir</a></li>
          <?php foreach($sql_kasir as $kasir){ ?>
          <li><a href="<?=base_url('kasir?id_kasir='.$kasir->id.'')?>"><?php echo $kasir->nama?></a></li>
          <?php } ?>
        </ul>
      </li>

      <li class="treeview <?=active_menu('Transaksi')?>">
        <a href="#">
          <i class="fa fa-calculator text-yellow"></i>
          <span>Transaksi</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <?php foreach($sql_kios as $toko){ ?>
          <li><a href="<?=base_url('transaksi?id_toko='.$toko->id.'')?>"><?php echo $toko->nama?></a></li>
          <?php } ?>
        </ul>
      </li>     

      <li class="<?=active_menu('toko')?>">
        <a href="<?=base_url('toko?id_user='.$id_user.'')?>">
          <i class="fa fa-user text-yellow"></i> <span>Toko</span>
        </a>
      </li>

      <li class="treeview <?=active_menu('Pelanggan')?>">
        <a href="#">
          <i class="fa fa-calculator text-yellow"></i>
          <span>Pelanggan</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <?php foreach($sql_kios as $toko){ ?>
          <li><a href="<?=base_url('pelanggan?id_toko='.$toko->id.'')?>"><?php echo $toko->nama?></a></li>
          <?php } ?>
        </ul>
      </li>

      <li class="treeview <?=active_menu('Barang')?>">
        <a href="#">
          <i class="fa fa-calculator text-yellow"></i>
          <span>Barang</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <?php foreach($sql_kios as $toko){ ?>
          <li><a href="<?=base_url('barang?id_toko='.$toko->id.'')?>"><?php echo $toko->nama?></a></li>
          <?php } ?>
        </ul>
      </li>

      <li class="treeview <?=active_menu('Karyawan')?>">
        <a href="#">
          <i class="fa fa-calculator text-yellow"></i>
          <span>Karyawan</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <?php foreach($sql_kios as $toko){ ?>
          <li><a href="<?=base_url('karyawan?id_toko='.$toko->id.'')?>"><?php echo $toko->nama?></a></li>
          <?php } ?>
        </ul>
      </li>

      <li class="treeview <?=active_menu('Laporan Keuangan')?>">
        <a href="#">
          <i class="fa fa-calculator text-yellow"></i>
          <span>Laporan Keuangan</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <?php foreach($sql_kios as $toko){ ?>
          <li><a href="<?=base_url('laporan_keuangan?id_toko='.$toko->id.'')?>"><?php echo $toko->nama?></a></li>
          <?php } ?>
        </ul>
      </li>

      <li class="treeview <?=active_menu('Laporan Karyawan')?>">
        <a href="#">
          <i class="fa fa-calculator text-yellow"></i>
          <span>Laporan Karyawan</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <?php foreach($sql_kios as $toko){ ?>
          <li><a href="<?=base_url('laporan_karyawan?id_toko='.$toko->id.'')?>"><?php echo $toko->nama?></a></li>
          <?php } ?>
        </ul>
      </li>
      <?php } ?>     

      <li><a id="logout-sidebar" href="#"><i class="fa fa-power-off text-red"></i> <span>Logout</span></a></li>
    </ul>

  </section>
  <!-- /.sidebar -->
</aside>
<script>
    $('#logout').click(function(e){
      e.preventDefault();
      $.confirm({
          title: 'Konfirmasi Logout!',
          content: 'Yakin ingin keluar?',
          buttons: {
            keluar: {
                btnClass: 'btn-orange',
                action: function(){
                   window.location= "<?=base_url('auth/logout')?>";
                }
            },
            batal: { btnClass: 'btn-blue' }
          }
      });
    });

</script>
<script>
    $('#logout-sidebar').click(function(e){
      e.preventDefault();
      $.confirm({
          title: 'Konfirmasi Logout!',
          content: 'Yakin ingin keluar?',
          buttons: {
            keluar: {
                btnClass: 'btn-orange',
                action: function(){
                   window.location= "<?=base_url('auth/logout')?>";
                }
            },
            batal: { btnClass: 'btn-blue' }
          }
      });
    });

</script>