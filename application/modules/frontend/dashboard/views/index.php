	<?php
        $id_user=$a_user['id'];
        $sql = $this->db->query("SELECT * FROM user WHERE id = ".$id_user." ")->row();
        if($sql->jenis == "kasir"){
      ?>
      <h1>DASHBOARD TOKO</h1>
      <?php }
       if($sql->jenis == "pemilik"){
      ?>
      <h1>DASHBOARD PEMILIK</h1>
      <?php } ?>  


