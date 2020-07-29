<?php
public function laporankiloanbydate_post(){
		$date = new DateTime();
        $token = $this->post('token');
		$kios_id = $this->post('kios_id');
		$start = $this->post('start');
		$end = $this->post('end');
		
		
		$invalidMessage = array(
			"status" => false,
			"pesan" => "token tidak boleh kosong" ,
			"data" => null
		);
		
        if(!$token) {$this->response($invalidMessage, REST_Controller::HTTP_NOT_FOUND);}
        else
        {
            try {
                 $cek = JWT::decode($token, "trivia");
                 if ($date->getTimestamp() > $cek->exp) 
                 {
                     $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
					  );
					 
                      $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
                 }
                 else
                 { 
						 $query = $this->db->query("SELECT round(sum(item_transaksi.kuantitas),0) as jml FROM item_transaksi INNER JOIN transaksi ON item_transaksi.transaksi_id = transaksi.id INNER JOIN harga_layanan ON item_transaksi.harga_layanan_id = harga_layanan.id INNER JOIN layanan ON harga_layanan.layanan_id = layanan.id WHERE layanan.satuan ='kg' AND transaksi.kios_id=".$kios_id." AND harga_layanan.trash=0 AND  transaksi.tgl_transaksi between '".substr($start, 0, 10)." 00:00:00' and '".substr($end, 0, 10)." 23:59:59'  and transaksi.kios_id=".$kios_id." ")->result();
						 $output['status'] = true ;
						 $output['pesan'] = "sukses" ;
						 $i=0;
						 foreach($query as $row){
						 	$output['data'][$i]->jumlah_kiloan = $row->jml;
						 	$output['data'][$i]->waktu = "$start sampai $end";
						 	$i++;
						 }
						 $this->set_response($output, REST_Controller::HTTP_OK);
                     
                 }
            } catch (Exception $e) {
                 $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
				  );

				  $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
	}

	public function laporankiloanbyperiode_post(){
		$date = new DateTime();
        $token = $this->post('token');
		$kios_id = $this->post('kios_id');
		$filter = $this->post('filter');		
		
		$invalidMessage = array(
			"status" => false,
			"pesan" => "token tidak boleh kosong" ,
			"data" => null
		);
		
        if(!$token) {$this->response($invalidMessage, REST_Controller::HTTP_NOT_FOUND);}
        else
        {
            try {
                 $cek = JWT::decode($token, "trivia");
                 if ($date->getTimestamp() > $cek->exp) 
                 {
                     $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
					  );
					 
                      $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
                 }
                 else
                 { 
					 if($filter=="hari"){
						 $query = $this->db->query("SELECT round(sum(item_transaksi.kuantitas),0) as jml FROM item_transaksi INNER JOIN transaksi ON item_transaksi.transaksi_id = transaksi.id INNER JOIN harga_layanan ON item_transaksi.harga_layanan_id = harga_layanan.id INNER JOIN layanan ON harga_layanan.layanan_id = layanan.id WHERE layanan.satuan ='kg' AND transaksi.kios_id=".$kios_id." AND harga_layanan.trash=0 AND transaksi.tgl_transaksi like '".date('Y-m-d')."%' and transaksi.kios_id='$kios_id'")->result();
						 $output['status'] = true ;
						 $output['pesan'] = "sukses" ;
						 $i=0;
						 foreach($query as $row){
						 	$output['data'][$i]->jumlah_kiloan = $row->jml;
						 	$output['data'][$i]->waktu = "hari ini";
						 	$i++;
						 }
						 $this->set_response($output, REST_Controller::HTTP_OK);
					 }
					 
					 if($filter=="minggu" ){
						 $query = $this->db->query("SELECT round(sum(item_transaksi.kuantitas),0) as jml FROM item_transaksi INNER JOIN transaksi ON item_transaksi.transaksi_id = transaksi.id INNER JOIN harga_layanan ON item_transaksi.harga_layanan_id = harga_layanan.id INNER JOIN layanan ON harga_layanan.layanan_id = layanan.id WHERE layanan.satuan ='kg' AND transaksi.kios_id=".$kios_id." AND harga_layanan.trash=0 AND YEARWEEK(transaksi.tgl_transaksi, 1) = YEARWEEK(CURDATE(), 1) and transaksi.kios_id='$kios_id' ")->result();
						 $output['status'] = true ;
						 $output['pesan'] = "sukses" ;
						 $i=0;
						 foreach($query as $row){
						 	$output['data'][$i]->jumlah_kiloan = $row->jml;
						 	$output['data'][$i]->waktu = "minggu ini";
						 	$i++;
						 }
						 $this->set_response($output, REST_Controller::HTTP_OK);
					 }
					 
					 if($filter=="bulan"){
						 $query = $this->db->query("SELECT round(sum(item_transaksi.kuantitas),0) as jml FROM item_transaksi INNER JOIN transaksi ON item_transaksi.transaksi_id = transaksi.id INNER JOIN harga_layanan ON item_transaksi.harga_layanan_id = harga_layanan.id INNER JOIN layanan ON harga_layanan.layanan_id = layanan.id WHERE layanan.satuan ='kg' AND transaksi.kios_id=".$kios_id." AND harga_layanan.trash=0 AND transaksi.tgl_transaksi like '".date('Y-m')."%'  and transaksi.kios_id='$kios_id'")->result();
						 $output['status'] = true ;
						 $output['pesan'] = "sukses" ;
						 $i=0;
						 foreach($query as $row){
						 	$output['data'][$i]->jumlah_kiloan = $row->jml;
						 	$output['data'][$i]->waktu = "bulan ini";
						 	$i++;
						 }
						 $this->set_response($output, REST_Controller::HTTP_OK);
					 }
                     
                 }
            } catch (Exception $e) {
                 $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
				  );

				  $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
	}


	public function laporansatuanbydate_post(){
		$date = new DateTime();
        $token = $this->post('token');
		$kios_id = $this->post('kios_id');
		$start = $this->post('start');
		$end = $this->post('end');
		
		
		$invalidMessage = array(
			"status" => false,
			"pesan" => "token tidak boleh kosong" ,
			"data" => null
		);
		
        if(!$token) {$this->response($invalidMessage, REST_Controller::HTTP_NOT_FOUND);}
        else
        {
            try {
                 $cek = JWT::decode($token, "trivia");
                 if ($date->getTimestamp() > $cek->exp) 
                 {
                     $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
					  );
					 
                      $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
                 }
                 else
                 { 
						 $query = $this->db->query("SELECT round(sum(item_transaksi.kuantitas),0) as jml FROM item_transaksi INNER JOIN transaksi ON item_transaksi.transaksi_id = transaksi.id INNER JOIN harga_layanan ON item_transaksi.harga_layanan_id = harga_layanan.id INNER JOIN layanan ON harga_layanan.layanan_id = layanan.id WHERE layanan.satuan ='satuan' AND transaksi.kios_id=".$kios_id." AND harga_layanan.trash=0 AND  transaksi.tgl_transaksi between '".substr($start, 0, 10)." 00:00:00' and '".substr($end, 0, 10)." 23:59:59'  and transaksi.kios_id=".$kios_id." ")->result();
						 $output['status'] = true ;
						 $output['pesan'] = "sukses" ;
						 $i=0;
						 foreach($query as $row){
						 	$output['data'][$i]->jumlah_kiloan = $row->jml;
						 	$output['data'][$i]->waktu = "$start sampai $end";
						 	$i++;
						 }
						 $this->set_response($output, REST_Controller::HTTP_OK);
                     
                 }
            } catch (Exception $e) {
                 $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
				  );

				  $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
	}

	public function laporansatuanbyperiode_post(){
		$date = new DateTime();
        $token = $this->post('token');
		$kios_id = $this->post('kios_id');
		$filter = $this->post('filter');		
		
		$invalidMessage = array(
			"status" => false,
			"pesan" => "token tidak boleh kosong" ,
			"data" => null
		);
		
        if(!$token) {$this->response($invalidMessage, REST_Controller::HTTP_NOT_FOUND);}
        else
        {
            try {
                 $cek = JWT::decode($token, "trivia");
                 if ($date->getTimestamp() > $cek->exp) 
                 {
                     $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
					  );
					 
                      $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
                 }
                 else
                 { 
					 if($filter=="hari"){
						 $query = $this->db->query("SELECT round(sum(item_transaksi.kuantitas),0) as jml FROM item_transaksi INNER JOIN transaksi ON item_transaksi.transaksi_id = transaksi.id INNER JOIN harga_layanan ON item_transaksi.harga_layanan_id = harga_layanan.id INNER JOIN layanan ON harga_layanan.layanan_id = layanan.id WHERE layanan.satuan ='satuan' AND transaksi.kios_id=".$kios_id." AND harga_layanan.trash=0 AND transaksi.tgl_transaksi like '".date('Y-m-d')."%' and transaksi.kios_id='$kios_id'")->result();
						 $output['status'] = true ;
						 $output['pesan'] = "sukses" ;
						 $i=0;
						 foreach($query as $row){
						 	$output['data'][$i]->jumlah_kiloan = $row->jml;
						 	$output['data'][$i]->waktu = "hari ini";
						 	$i++;
						 }
						 $this->set_response($output, REST_Controller::HTTP_OK);
					 }
					 
					 if($filter=="minggu" ){
						 $query = $this->db->query("SELECT round(sum(item_transaksi.kuantitas),0) as jml FROM item_transaksi INNER JOIN transaksi ON item_transaksi.transaksi_id = transaksi.id INNER JOIN harga_layanan ON item_transaksi.harga_layanan_id = harga_layanan.id INNER JOIN layanan ON harga_layanan.layanan_id = layanan.id WHERE layanan.satuan ='satuan' AND transaksi.kios_id=".$kios_id." AND harga_layanan.trash=0 AND YEARWEEK(transaksi.tgl_transaksi, 1) = YEARWEEK(CURDATE(), 1) and transaksi.kios_id='$kios_id' ")->result();
						 $output['status'] = true ;
						 $output['pesan'] = "sukses" ;
						 $i=0;
						 foreach($query as $row){
						 	$output['data'][$i]->jumlah_kiloan = $row->jml;
						 	$output['data'][$i]->waktu = "minggu ini";
						 	$i++;
						 }
						 $this->set_response($output, REST_Controller::HTTP_OK);
					 }
					 
					 if($filter=="bulan"){
						 $query = $this->db->query("SELECT round(sum(item_transaksi.kuantitas),0) as jml FROM item_transaksi INNER JOIN transaksi ON item_transaksi.transaksi_id = transaksi.id INNER JOIN harga_layanan ON item_transaksi.harga_layanan_id = harga_layanan.id INNER JOIN layanan ON harga_layanan.layanan_id = layanan.id WHERE layanan.satuan ='satuan' AND transaksi.kios_id=".$kios_id." AND harga_layanan.trash=0 AND transaksi.tgl_transaksi like '".date('Y-m')."%'  and transaksi.kios_id='$kios_id'")->result();
						 $output['status'] = true ;
						 $output['pesan'] = "sukses" ;
						 $i=0;
						 foreach($query as $row){
						 	$output['data'][$i]->jumlah_kiloan = $row->jml;
						 	$output['data'][$i]->waktu = "bulan ini";
						 	$i++;
						 }
						 $this->set_response($output, REST_Controller::HTTP_OK);
					 }
                     
                 }
            } catch (Exception $e) {
                 $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
				  );

				  $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
	}
	
	public function laporanringkasantransaksibydate_post(){
		$date = new DateTime();
        $token = $this->post('token');
		$kios_id = $this->post('kios_id');
		$start = $this->post('start');
		$end = $this->post('end');
		
		
		$invalidMessage = array(
			"status" => false,
			"pesan" => "token tidak boleh kosong" ,
			"data" => null
		);
		
        if(!$token) {$this->response($invalidMessage, REST_Controller::HTTP_NOT_FOUND);}
        else
        {
            try {
                 $cek = JWT::decode($token, "trivia");
                 if ($date->getTimestamp() > $cek->exp) 
                 {
                     $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
					  );
					 
                      $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
                 }
                 else
                 { 
						 $list_transaksi = $this->db->query("SELECT transaksi.status as status, SUM(transaksi.total_harga) as total_harga from transaksi JOIN pelanggan on transaksi.pelanggan_id=pelanggan.id where transaksi.status_order = 0 AND transaksi.trash = 0 AND transaksi.tgl_transaksi between '".substr($start, 0, 10)." 00:00:01' and '".substr($end, 0, 10)." 23:59:59'  and kios_id='$kios_id' GROUP BY status ")->result();

						 $laporan_kg_satuan = $this->db->query("SELECT layanan.satuan as jenis_layanan,round(sum(item_transaksi.kuantitas),0) as jml FROM item_transaksi INNER JOIN transaksi ON item_transaksi.transaksi_id = transaksi.id INNER JOIN harga_layanan ON item_transaksi.harga_layanan_id = harga_layanan.id INNER JOIN layanan ON harga_layanan.layanan_id = layanan.id WHERE transaksi.kios_id=".$kios_id." AND harga_layanan.trash=0 AND  transaksi.tgl_transaksi between '".substr($start, 0, 10)." 00:00:00' and '".substr($end, 0, 10)." 23:59:59'  and transaksi.kios_id=".$kios_id." and transaksi.trash = 0 GROUP BY layanan.satuan ")->result();
						 $output['status'] = true ;
						 $output['pesan'] = "sukses";

						 $i=0;
						 foreach($list_transaksi as $row){
						    $output['list_transaksi'][$i]->status = $row->status;
						    $output['list_transaksi'][$i]->total_transaksi = $row->total_harga;
						    $output['list_transaksi'][$i]->waktu = "$start sampai $end";
						    $i++;
						 }

						 $a=0;
						 foreach($laporan_kg_satuan as $row){
						    $output['laporan_kg_satuan'][$a]->jenis_layanan = $row->jenis_layanan;
						    $output['laporan_kg_satuan'][$a]->jumlah = $row->jml;
						    $output['laporan_kg_satuan'][$a]->waktu = "$start sampai $end";
						    $a++;
						 }						 
						
						 //$output['laporan_kg_satuan'] = $laporan_kg_satuan;						 
						 $this->set_response($output, REST_Controller::HTTP_OK);
                     
                 }
            } catch (Exception $e) {
                 $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
				  );

				  $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
	}

	public function laporanringkasantransaksibyperiode_post(){
		$date = new DateTime();
        $token = $this->post('token');
		$kios_id = $this->post('kios_id');
		$filter = $this->post('filter');
		
		
		$invalidMessage = array(
			"status" => false,
			"pesan" => "token tidak boleh kosong" ,
			"data" => null
		);
		
        if(!$token) {$this->response($invalidMessage, REST_Controller::HTTP_NOT_FOUND);}
        else
        {
            try {
                 $cek = JWT::decode($token, "trivia");
                 if ($date->getTimestamp() > $cek->exp) 
                 {
                     $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
					  );
					 
                      $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
                 }
                 else
                 { 
					 if($filter=="hari"){

					 	 $list_transaksi = $this->db->query("SELECT transaksi.status as status, SUM(transaksi.total_harga) as total_harga from transaksi JOIN pelanggan on transaksi.pelanggan_id=pelanggan.id where transaksi.status_order = 0 AND transaksi.trash = 0 AND transaksi.tgl_transaksi like '".date('Y-m-d')."%'  and kios_id='$kios_id' GROUP BY status ")->result();

						 $laporan_kg_satuan = $this->db->query("SELECT layanan.satuan as jenis_layanan,round(sum(item_transaksi.kuantitas),0) as jml FROM item_transaksi INNER JOIN transaksi ON item_transaksi.transaksi_id = transaksi.id INNER JOIN harga_layanan ON item_transaksi.harga_layanan_id = harga_layanan.id INNER JOIN layanan ON harga_layanan.layanan_id = layanan.id WHERE transaksi.kios_id=".$kios_id." AND harga_layanan.trash=0 AND transaksi.tgl_transaksi like '".date('Y-m-d')."%'  and transaksi.kios_id=".$kios_id." and transaksi.trash = 0 GROUP BY layanan.satuan ")->result();
						 $output['status'] = true ;
						 $output['pesan'] = "sukses";

						 $i=0;
						 foreach($list_transaksi as $row){
						    $output['list_transaksi'][$i]->status = $row->status;
						    $output['list_transaksi'][$i]->total_transaksi = $row->total_harga;
						    $output['list_transaksi'][$i]->waktu = "Hari Ini";
						    $i++;
						 }

						 $a=0;
						 foreach($laporan_kg_satuan as $row){
						    $output['laporan_kg_satuan'][$a]->jenis_layanan = $row->jenis_layanan;
						    $output['laporan_kg_satuan'][$a]->jumlah = $row->jml;
						    $output['laporan_kg_satuan'][$a]->waktu = "Hari Ini";
						    $a++;
						 }						
						 $this->set_response($output, REST_Controller::HTTP_OK);
					 }
					 
					 if($filter=="minggu" ){

					 	$list_transaksi = $this->db->query("SELECT transaksi.status as status, SUM(transaksi.total_harga) as total_harga from transaksi JOIN pelanggan on transaksi.pelanggan_id=pelanggan.id where transaksi.status_order = 0 AND transaksi.trash = 0 AND YEARWEEK(transaksi.tgl_transaksi, 1) = YEARWEEK(CURDATE(), 1)  and kios_id='$kios_id' GROUP BY status ")->result();

						 $laporan_kg_satuan = $this->db->query("SELECT layanan.satuan as jenis_layanan,round(sum(item_transaksi.kuantitas),0) as jml FROM item_transaksi INNER JOIN transaksi ON item_transaksi.transaksi_id = transaksi.id INNER JOIN harga_layanan ON item_transaksi.harga_layanan_id = harga_layanan.id INNER JOIN layanan ON harga_layanan.layanan_id = layanan.id WHERE transaksi.kios_id=".$kios_id." AND harga_layanan.trash=0 AND YEARWEEK(transaksi.tgl_transaksi, 1) = YEARWEEK(CURDATE(), 1)  and transaksi.kios_id=".$kios_id." and transaksi.trash = 0 GROUP BY layanan.satuan ")->result();
						 $output['status'] = true ;
						 $output['pesan'] = "sukses";

						 $i=0;
						 foreach($list_transaksi as $row){
						    $output['list_transaksi'][$i]->status = $row->status;
						    $output['list_transaksi'][$i]->total_transaksi = $row->total_harga;
						    $output['list_transaksi'][$i]->waktu = "Minggu Ini";
						    $i++;
						 }

						 $a=0;
						 foreach($laporan_kg_satuan as $row){
						    $output['laporan_kg_satuan'][$a]->jenis_layanan = $row->jenis_layanan;
						    $output['laporan_kg_satuan'][$a]->jumlah = $row->jml;
						    $output['laporan_kg_satuan'][$a]->waktu = "Minggu Ini";
						    $a++;
						 }	
						 $this->set_response($output, REST_Controller::HTTP_OK);
					 }
					 
					 if($filter=="bulan"){

					 	$list_transaksi = $this->db->query("SELECT transaksi.status as status, SUM(transaksi.total_harga) as total_harga from transaksi JOIN pelanggan on transaksi.pelanggan_id=pelanggan.id where transaksi.status_order = 0 AND transaksi.trash = 0 AND transaksi.tgl_transaksi like '".date('Y-m')."%'  and kios_id='$kios_id' GROUP BY status ")->result();

						 $laporan_kg_satuan = $this->db->query("SELECT layanan.satuan as jenis_layanan,round(sum(item_transaksi.kuantitas),0) as jml FROM item_transaksi INNER JOIN transaksi ON item_transaksi.transaksi_id = transaksi.id INNER JOIN harga_layanan ON item_transaksi.harga_layanan_id = harga_layanan.id INNER JOIN layanan ON harga_layanan.layanan_id = layanan.id WHERE transaksi.kios_id=".$kios_id." AND harga_layanan.trash=0 AND transaksi.tgl_transaksi like '".date('Y-m')."%' and transaksi.kios_id=".$kios_id." and transaksi.trash = 0 GROUP BY layanan.satuan ")->result();
						 $output['status'] = true ;
						 $output['pesan'] = "sukses";

						 $i=0;
						 foreach($list_transaksi as $row){
						    $output['list_transaksi'][$i]->status = $row->status;
						    $output['list_transaksi'][$i]->total_transaksi = $row->total_harga;
						    $output['list_transaksi'][$i]->waktu = "Bulan Ini";
						    $i++;
						 }

						 $a=0;
						 foreach($laporan_kg_satuan as $row){
						    $output['laporan_kg_satuan'][$a]->jenis_layanan = $row->jenis_layanan;
						    $output['laporan_kg_satuan'][$a]->jumlah = $row->jml;
						    $output['laporan_kg_satuan'][$a]->waktu = "Bulan Ini";
						    $a++;
						 }

						 $this->set_response($output, REST_Controller::HTTP_OK);
					 }
                     
                 }
            } catch (Exception $e) {
                 $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
				  );

				  $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
	}
	
	
	public function laporantransaksibydate_post(){
		$date = new DateTime();
        $token = $this->post('token');
		$kios_id = $this->post('kios_id');
		$start = $this->post('start');
		$end = $this->post('end');
		
		
		$invalidMessage = array(
			"status" => false,
			"pesan" => "token tidak boleh kosong" ,
			"data" => null
		);
		
        if(!$token) {$this->response($invalidMessage, REST_Controller::HTTP_NOT_FOUND);}
        else
        {
            try {
                 $cek = JWT::decode($token, "trivia");
                 if ($date->getTimestamp() > $cek->exp) 
                 {
                     $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
					  );
					 
                      $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
                 }
                 else
                 { 
						 $query = $this->db->query("SELECT transaksi.id,pelanggan.nama,transaksi.total_harga,transaksi.tgl_transaksi,transaksi.status from transaksi JOIN pelanggan on transaksi.pelanggan_id=pelanggan.id where transaksi.status_order = 0 AND transaksi.trash = 0 AND transaksi.tgl_transaksi between '".substr($start, 0, 10)." 00:00:00' and '".substr($end, 0, 10)." 23:59:59'  and kios_id='$kios_id' ")->result();
						 $output['status'] = true ;
						 $output['pesan'] = "sukses" ;
						 $output['data'] = $query ;
						 $this->set_response($output, REST_Controller::HTTP_OK);
                     
                 }
            } catch (Exception $e) {
                 $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
				  );

				  $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
	}
	
	
	public function laporantransaksibyperiode_post(){
		$date = new DateTime();
        $token = $this->post('token');
		$kios_id = $this->post('kios_id');
		$filter = $this->post('filter');
		
		
		$invalidMessage = array(
			"status" => false,
			"pesan" => "token tidak boleh kosong" ,
			"data" => null
		);
		
        if(!$token) {$this->response($invalidMessage, REST_Controller::HTTP_NOT_FOUND);}
        else
        {
            try {
                 $cek = JWT::decode($token, "trivia");
                 if ($date->getTimestamp() > $cek->exp) 
                 {
                     $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
					  );
					 
                      $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
                 }
                 else
                 { 
					 if($filter=="hari"){
						 $query = $this->db->query("SELECT transaksi.id,pelanggan.nama,transaksi.total_harga,transaksi.tgl_transaksi,transaksi.status from transaksi JOIN pelanggan on transaksi.pelanggan_id=pelanggan.id where transaksi.status_order = 0 AND transaksi.trash = 0 AND transaksi.tgl_transaksi like '".date('Y-m-d')."%' and transaksi.kios_id='$kios_id'")->result();
						 $output['status'] = true ;
						 $output['pesan'] = "sukses" ;
						 $output['data'] = $query ;
						 $this->set_response($output, REST_Controller::HTTP_OK);
					 }
					 
					 if($filter=="minggu" ){
						 $query = $this->db->query("SELECT transaksi.id,pelanggan.nama,transaksi.total_harga,transaksi.tgl_transaksi,transaksi.status from transaksi JOIN pelanggan on transaksi.pelanggan_id=pelanggan.id where transaksi.status_order = 0 AND transaksi.trash = 0 AND YEARWEEK(transaksi.tgl_transaksi, 1) = YEARWEEK(CURDATE(), 1) and transaksi.kios_id='$kios_id' ")->result();
						 $output['status'] = true ;
						 $output['pesan'] = "sukses" ;
						 $output['data'] = $query ;
						 $this->set_response($output, REST_Controller::HTTP_OK);
					 }
					 
					 if($filter=="bulan"){
						 $query = $this->db->query("SELECT transaksi.id,pelanggan.nama,transaksi.total_harga,transaksi.tgl_transaksi,transaksi.status from transaksi JOIN pelanggan on transaksi.pelanggan_id=pelanggan.id where transaksi.status_order = 0 AND transaksi.trash = 0 AND transaksi.tgl_transaksi like '".date('Y-m')."%'  and transaksi.kios_id='$kios_id'")->result();
						 $output['status'] = true ;
						 $output['pesan'] = "sukses" ;
						 $output['data'] = $query ;
						 $this->set_response($output, REST_Controller::HTTP_OK);
					 }
                     
                 }
            } catch (Exception $e) {
                 $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
				  );

				  $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
	}
	
public function laporanpengambilanlaundry_post(){
		$date = new DateTime();
        $token = $this->post('token');
		$owner_id = $this->post('owner_id');

       
		$data = array(
			"status" => false,
			"pesan" => "token tidak boleh kosong" ,
			"data" => null
		);
		
        if(!$token) {$this->response($data, REST_Controller::HTTP_NOT_FOUND);}
        else
        {
            try {
                 if (!$this->cekToken($token)){
                    $data = array(
                        "status" => false,
                        "pesan" => "Expired token",
                        "data" => null);
                    $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
                } else {
                    $admin_id = $cek->id;
                    $tahun = date("Y");
                    $bulan = date("m");
                    $hari = date("d");

                    $query = $this->db->query("SELECT pelanggan.nama as nama_pelanggan,transaksi.id as no_nota FROM transaksi INNER JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id INNER JOIN admin ON transaksi.owner_id = admin.id WHERE YEAR(tgl_diambil)='$tahun' AND MONTH(tgl_diambil)='$bulan' AND DAY(tgl_diambil)='$hari' AND transaksi.status_kerja = 3 AND admin.id = $owner_id")->result_array();
                     $output['status'] = true ;
					 $output['pesan'] = "sukses";					
					 $i=0;
					 foreach($query as $row){					 	
					 	$output['data'][$i]->nama_pelanggan = $row["nama_pelanggan"];
					 	$output['data'][$i]->id_transaksi = $row["no_nota"];
					 	$i++;
					 }				 
                     $this->set_response($output, REST_Controller::HTTP_OK);
                 }
            } catch (Exception $e) {
                $data = array(
					"status" => false,
					"pesan" => "Invalid token" ,
					"data" => null
				);
				
                $this->set_response($data, REST_Controller::HTTP_BAD_REQUEST);
            }
        } 
	}
	
public function laporantransaksimemberbydate_post(){
		$date = new DateTime();
        $token = $this->post('token');
		$owner_id = $this->post('owner_id');
		$start = $this->post('start');
		$end = $this->post('end');
		
		
		$invalidMessage = array(
			"status" => false,
			"pesan" => "token tidak boleh kosong" ,
			"data" => null
		);
		
        if(!$token) {$this->response($invalidMessage, REST_Controller::HTTP_NOT_FOUND);}
        else
        {
            try {
                 $cek = JWT::decode($token, "trivia");
                 if ($date->getTimestamp() > $cek->exp) 
                 {
                     $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
					  );
					 
                      $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
                 }
                 else
                 { 
						 $admin_id = $cek->id;					 

					 $daftar_pelanggan = $this->db->query("SELECT pelanggan.nama as nama_pelanggan,count(transaksi.id) as total_transaksi FROM pelanggan INNER JOIN transaksi ON transaksi.pelanggan_id = pelanggan.id WHERE pelanggan.admin_id = ".$owner_id." AND transaksi.trash = 0 AND transaksi.tgl_transaksi between '".substr($start, 0, 10)." 00:00:00' and '".substr($end, 0, 10)." 23:59:59' GROUP BY pelanggan.id ORDER BY count(transaksi.id) DESC ")->result();
					 $output['status'] = true ;
					 $output['pesan'] = "sukses";
					 $output['data'] = $daftar_pelanggan ;					
								  			
					 
                     $this->set_response($output, REST_Controller::HTTP_OK);
                     
                 }
            } catch (Exception $e) {
                 $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
				  );

				  $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
	}
	
public function laporantransaksimemberbyperiode_post(){
		$date = new DateTime();
        $token = $this->post('token');
		$owner_id = $this->post('owner_id');
		$filter = $this->post('filter');
		
		
		$invalidMessage = array(
			"status" => false,
			"pesan" => "token tidak boleh kosong" ,
			"data" => null
		);
		
        if(!$token) {$this->response($invalidMessage, REST_Controller::HTTP_NOT_FOUND);}
        else
        {
            try {
                 $cek = JWT::decode($token, "trivia");
                 if ($date->getTimestamp() > $cek->exp) 
                 {
                     $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
					  );
					 
                      $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
                 }
                 else
                 { 
					 if($filter=="hari"){
					 	$daftar_pelanggan = $this->db->query("SELECT pelanggan.nama as nama_pelanggan,count(transaksi.id) as total_transaksi FROM pelanggan INNER JOIN transaksi ON transaksi.pelanggan_id = pelanggan.id WHERE pelanggan.admin_id = ".$owner_id." AND transaksi.trash = 0 AND transaksi.tgl_transaksi like '".date('Y-m-d')."%' GROUP BY pelanggan.id ORDER BY count(transaksi.id) DESC ")->result();
							 $output['status'] = true ;
							 $output['pesan'] = "sukses";
							 $output['data'] = $daftar_pelanggan ;						 
						 $this->set_response($output, REST_Controller::HTTP_OK);
					 }
					 
					 if($filter=="minggu" ){
					 	$daftar_pelanggan = $this->db->query("SELECT pelanggan.nama as nama_pelanggan,count(transaksi.id) as total_transaksi FROM pelanggan INNER JOIN transaksi ON transaksi.pelanggan_id = pelanggan.id WHERE pelanggan.admin_id = ".$owner_id." AND transaksi.trash = 0 AND YEARWEEK(transaksi.tgl_transaksi, 1) = YEARWEEK(CURDATE(), 1) GROUP BY pelanggan.id ORDER BY count(transaksi.id) DESC ")->result();
							 $output['status'] = true ;
							 $output['pesan'] = "sukses";
							 $output['data'] = $daftar_pelanggan ;						 
						 $this->set_response($output, REST_Controller::HTTP_OK);						 
					 }
					 
					 if($filter=="bulan"){
					 	$daftar_pelanggan = $this->db->query("SELECT pelanggan.nama as nama_pelanggan,count(transaksi.id) as total_transaksi FROM pelanggan INNER JOIN transaksi ON transaksi.pelanggan_id = pelanggan.id WHERE pelanggan.admin_id = ".$owner_id." AND transaksi.trash = 0 AND transaksi.tgl_transaksi like '".date('Y-m')."%' GROUP BY pelanggan.id ORDER BY count(transaksi.id) DESC ")->result();
							 $output['status'] = true ;
							 $output['pesan'] = "sukses";
							 $output['data'] = $daftar_pelanggan ;						 
						 $this->set_response($output, REST_Controller::HTTP_OK);					 
					 }
                     
                 }
            } catch (Exception $e) {
                 $data = array(
						"status" => false,
						"pesan" => "Expired token" ,
						"data" => null
				  );

				  $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
	}

public function laporantransaksimember_post(){
		$date = new DateTime();
        $token = $this->post('token');
		$kios_id = $this->post('kios_id');

       
		$data = array(
			"status" => false,
			"pesan" => "token tidak boleh kosong" ,
			"data" => null
		);
		
        if(!$token) {$this->response($data, REST_Controller::HTTP_NOT_FOUND);}
        else
        {
            try {
                 if (!$this->cekToken($token)){
                    $data = array(
                        "status" => false,
                        "pesan" => "Expired token",
                        "data" => null);
                    $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
                } else {
                    $admin_id = $cek->id;
                     $output['status'] = true ;
					 $output['pesan'] = "sukses";					

					 $ambil_kios = $this->db->query("SELECT * FROM kios WHERE id = ".$kios_id." ")->row_array();
					 $ambil_owner = $this->db->query("SELECT * FROM admin WHERE id = ".$ambil_kios["id_owner"]." ")->row_array();	

					 $daftar_pelanggan = $this->db->query("SELECT pelanggan.nama as nama_pelanggan,count(transaksi.id) as total_transaksi FROM pelanggan INNER JOIN transaksi ON transaksi.pelanggan_id = pelanggan.id WHERE pelanggan.admin_id = ".$ambil_owner['id']." AND transaksi.trash = 0 GROUP BY pelanggan.id ORDER BY count(transaksi.id) DESC ")->result();				
					 $output['data'] = $daftar_pelanggan;	  			
					 
                     $this->set_response($output, REST_Controller::HTTP_OK);
                 }
            } catch (Exception $e) {
                $data = array(
					"status" => false,
					"pesan" => "Invalid token" ,
					"data" => null
				);
				
                $this->set_response($data, REST_Controller::HTTP_BAD_REQUEST);
            }
        } 
	}
	
public function laporankeuanganbydate_post(){
		$date = new DateTime();
        $token = $this->post('token');
		$kios_id = $this->post('kios_id');
		$start = $this->post('start');
		$end = $this->post('end');

       
		$data = array(
			"status" => false,
			"pesan" => "token tidak boleh kosong" ,
			"data" => null
		);
		
        if(!$token) {$this->response($data, REST_Controller::HTTP_NOT_FOUND);}
        else
        {
            try {
                 if (!$this->cekToken($token)){
                    $data = array(
                        "status" => false,
                        "pesan" => "Expired token",
                        "data" => null);
                    $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
                } else {
                    $admin_id = $cek->id;              
					 
					 $output['status'] = true ;
					 $output['pesan'] = "sukses" ;
					 //pendapatan
					  $pendapatan = $this->db->query(
					 	"SELECT 
					 	COUNT(total_harga) as count, sum(transaksi.diskon) as diskon,
					 	sum(transaksi.total_harga) as total_harga, 
					 	IF(status = 'LUNAS','PENDAPATAN', status) as status 
					 	from transaksi						
					 	where status_order = 0
					 	and transaksi.status = 'LUNAS' 
					 	AND transaksi.kios_id='$kios_id' 
					 	and transaksi.trash = '0'
					 	and (tgl_masuk_uang between '".substr($start, 0, 10)." 00:00:00' and '".substr($end, 0, 10)." 23:59:59' )					 	"
					 )->row();
					 //setting untuk root count
					  $jml_c_pendapatan = $pendapatan->count;
					  $dapat = "";
					  $pendapatan_diskon = "";
					  $pendapatan_total = "";
					  if($jml_c_pendapatan == "" or $jml_c_pendapatan == 0){
					  	$dapat = "0";
					  	$pendapatan_diskon = "0";
					  	$pendapatan_total = "0";
					  }
					  else if($jml_c_pendapatan != "" or $jml_c_pendapatan !=0){
					  	$dapat = $pendapatan->count;
					  	$pendapatan_diskon = $pendapatan->diskon;
					  	$pendapatan_total = $pendapatan->total_harga;
					  }
					  $pendapatan->count = $dapat;
					  $pendapatan->status = "PENDAPATAN";
					  $pendapatan->diskon = $pendapatan_diskon;
					  $pendapatan->total_harga = $pendapatan_total;

					  $detail_pendapatan = $this->db->query("
							  SELECT l.layanan,round(sum(it.harga*it.kuantitas),0) as total 
							  from transaksi t 

								inner join item_transaksi it on t.id=it.transaksi_id 
								inner join harga_layanan hl on hl.id=it.harga_layanan_id 
								inner join layanan l on l.id=hl.layanan_id

								where t.status_order = 0 
								AND t.kios_id='$kios_id'
								and t.status='LUNAS'  
								and t.trash='0'
					 			and (tgl_masuk_uang between '".substr($start, 0, 10)." 00:00:00' and '".substr($end, 0, 10)." 23:59:59' ) 
								and status='LUNAS'
								GROUP BY l.layanan
							  
							  ")->result();
					  $pendapatan->detail_pendapatan = $detail_pendapatan;

					  //piutang
					  $piutang = $this->db->query(
					 	"SELECT 
					 	COUNT(total_harga) as count, sum(transaksi.diskon) as diskon,
					 	sum(transaksi.total_harga) as total_harga, 
					 	 status 
					 	from transaksi						
					 	where status_order = 0
					 	and transaksi.status = 'PIUTANG' 
					 	AND transaksi.kios_id='$kios_id' 
					 	and transaksi.trash = '0'
					 	and (tgl_transaksi between '".substr($start, 0, 10)." 00:00:00' and '".substr($end, 0, 10)." 23:59:59' )					 	"
					 )->row();
					 //setting untuk root count
					  $jml_c_piutang = $piutang->count;
					  $utang = "";
					  $piutang_diskon = "";
					  $piutang_total = "";
					  if($jml_c_piutang == "" or $jml_c_piutang == 0){
					  	$utang = "0";
					  	$piutang_diskon = "0";
					  	$piutang_total = "0";
					  }
					  else if($jml_c_piutang != "" or $jml_c_piutang != 0){
					  	$utang = $piutang->count;
					  	$piutang_diskon = $piutang->diskon;
					  	$piutang_total = $piutang->total_harga;
					  }
					  $piutang->count = $utang;
					  $piutang->status = "PIUTANG";
					  $piutang->diskon = $piutang_diskon;
					  $piutang->total_harga = $piutang_total;

					  $detail_piutang = $this->db->query("
							  SELECT l.layanan,round(sum(it.harga*it.kuantitas),0) as total from 
								transaksi t 
								inner join item_transaksi it on t.id=it.transaksi_id 
								inner join harga_layanan hl on hl.id=it.harga_layanan_id 
								inner join layanan l on l.id=hl.layanan_id

								where t.status_order = 0 
								and t.trash='0'
								AND t.kios_id='$kios_id'
								and t.status='PIUTANG'  
								and (tgl_transaksi between '".substr($start, 0, 10)." 00:00:00' and '".substr($end, 0, 10)." 23:59:59') and status='PIUTANG'
								GROUP BY l.layanan
							  
							  ")->result();
					  $piutang->detail_piutang = $detail_piutang;

					  //gaji
					  $gaji = $this->db->query("SELECT COUNT(nominal) as count,sum(nominal) as total_harga,type as status,type_pengeluaran_id FROM `pengeluaran` JOIN type_pengeluaran on pengeluaran.type_pengeluaran_id=type_pengeluaran.id WHERE pengeluaran.kios_id='$kios_id' and pengeluaran.type_pengeluaran_id = 1 and (tanggal between '".substr($start, 0, 10)." 00:00:00' and '".substr($end, 0, 10)." 23:59:59' ) GROUP BY type_pengeluaran_id")->row();
					  //setting untuk root count
					  $jml_c_gaji = $gaji->count;
					  $count_gaji = "";					  
					  $gaji_total = "";
					  if($jml_c_gaji == ""){
					  	$count_gaji = "0";					  	
					  	$gaji_total = "0";
					  }
					  else if($jml_c_gaji != ""){
					  	$count_gaji = $gaji->count;					  	
					  	$gaji_total = $gaji->total_harga;
					  }
					  $gaji->count = $count_gaji;
					  $gaji->status = "Gaji";					  
					  $gaji->total_harga = $gaji_total;
					  $gaji->type_pengeluaran_id = "1";

					  $detail_gaji = $this->db->query("
							  select catatan,nominal from pengeluaran where
							  type_pengeluaran_id = 1 and 
							  (tanggal between '".substr($start, 0, 10)." 00:00:01' and '".substr($end, 0, 10)." 23:59:59' )
							  and kios_id ='$kios_id'
							  ")->result();
					  $gaji->detail_gaji = $detail_gaji;

					  //operasional
					  $operasional = $this->db->query("SELECT COUNT(nominal) as count,sum(nominal) as total_harga,type as status,type_pengeluaran_id FROM `pengeluaran` JOIN type_pengeluaran on pengeluaran.type_pengeluaran_id=type_pengeluaran.id WHERE pengeluaran.kios_id='$kios_id' and pengeluaran.type_pengeluaran_id = 2 and (tanggal between '".substr($start, 0, 10)." 00:00:00' and '".substr($end, 0, 10)." 23:59:59' ) GROUP BY type_pengeluaran_id")->row();
					  //setting untuk root count
					  $jml_c_operasional = $operasional->count;
					  $count_operasional = "";					 
					  $operasional_total = "";
					  if($jml_c_operasional == ""){
					  	$count_operasional = "0";					  	
					  	$operasional_total = "0";
					  }
					  else if($jml_c_operasional != ""){
					  	$count_operasional = $operasional->count;					  	
					  	$operasional_total = $operasional->total_harga;
					  }
					  $operasional->count = $count_operasional;
					  $operasional->status = "Operasional";					  
					  $operasional->total_harga = $operasional_total;
					  $operasional->type_pengeluaran_id = "2";

					  $detail_operasional = $this->db->query("
							  select catatan,nominal from pengeluaran where
							  type_pengeluaran_id = 2 and 
							  (tanggal between '".substr($start, 0, 10)." 00:00:01' and '".substr($end, 0, 10)." 23:59:59' )
							  and kios_id ='$kios_id'
							  ")->result();
					  $operasional->detail_operasional = $detail_operasional;

					  //sewa
					  $sewa = $this->db->query("SELECT COUNT(nominal) as count,sum(nominal) as total_harga,type as status,type_pengeluaran_id FROM `pengeluaran` JOIN type_pengeluaran on pengeluaran.type_pengeluaran_id=type_pengeluaran.id WHERE pengeluaran.kios_id='$kios_id' and pengeluaran.type_pengeluaran_id = 3 and (tanggal between '".substr($start, 0, 10)." 00:00:00' and '".substr($end, 0, 10)." 23:59:59' ) GROUP BY type_pengeluaran_id")->row();
					  //setting untuk root count
					  $jml_c_sewa = $sewa->count;
					  $count_sewa = "";					 
					  $sewa_total = "";
					  if($jml_c_sewa == ""){
					  	$count_sewa = "0";					  	
					  	$sewa_total = "0";
					  }
					  else if($jml_c_sewa != ""){
					  	$count_sewa = $sewa->count;					  	
					  	$sewa_total = $sewa->total_harga;
					  }
					  $sewa->count = $count_sewa;
					  $sewa->status = "Sewa";					  
					  $sewa->total_harga = $sewa_total;
					  $sewa->type_pengeluaran_id = "3";

					  $detail_sewa = $this->db->query("
							  select catatan,nominal from pengeluaran where
							  type_pengeluaran_id = 3 and 
							  (tanggal between '".substr($start, 0, 10)." 00:00:01' and '".substr($end, 0, 10)." 23:59:59' )
							  and kios_id ='$kios_id'
							  ")->result();
					  $sewa->detail_sewa = $detail_sewa;

					  //lain-lain
					  $lain_lain = $this->db->query("SELECT COUNT(nominal) as count,sum(nominal) as total_harga,type as status,type_pengeluaran_id FROM `pengeluaran` JOIN type_pengeluaran on pengeluaran.type_pengeluaran_id=type_pengeluaran.id WHERE pengeluaran.kios_id='$kios_id' and pengeluaran.type_pengeluaran_id = 4 and (tanggal between '".substr($start, 0, 10)." 00:00:00' and '".substr($end, 0, 10)." 23:59:59' ) GROUP BY type_pengeluaran_id")->row();
					  //setting untuk root count
					  $jml_c_lain = $lain_lain->count;
					  $count_lain = "";					 
					  $lain_total = "";
					  if($jml_c_lain == ""){
					  	$count_lain = "0";					  	
					  	$lain_total = "0";
					  }
					  else if($jml_c_lain != ""){
					  	$count_lain = $lain_lain->count;					  	
					  	$lain_total = $lain_lain->total_harga;
					  }
					  $lain_lain->count = $count_lain;
					  $lain_lain->status = "Lain-Lain";					  
					  $lain_lain->total_harga = $lain_total;
					  $lain_lain->type_pengeluaran_id = "4";
					  $detail_lain_lain = $this->db->query("
							  select catatan,nominal from pengeluaran where
							  type_pengeluaran_id = 4 and 
							  (tanggal between '".substr($start, 0, 10)." 00:00:01' and '".substr($end, 0, 10)." 23:59:59' )
							  and kios_id ='$kios_id'
							  ")->result();
					  $lain_lain->detail_lain_lain = $detail_lain_lain;	  

					  $total_pengeluaran = $gaji->total_harga + $operasional->total_harga + $sewa->total_harga + $lain_lain->total_harga;

					  $laba_bersih = $pendapatan->total_harga - $total_pengeluaran;					  				

					 $output = array(
					     "status" => true,
					     "pesan" => "sukses",
					     "pendapatan" => $pendapatan,
					     "piutang" => $piutang,					     
					     "gaji" => $gaji,
					     "operasional" => $operasional,
					     "sewa" => $sewa,
					     "lain_lain" => $lain_lain,
					     "laba_bersih" => $laba_bersih
					);			
					 
                     $this->set_response($output, REST_Controller::HTTP_OK);
                 }
            } catch (Exception $e) {
                $data = array(
					"status" => false,
					"pesan" => "Invalid token" ,
					"data" => null
				);
				
                $this->set_response($data, REST_Controller::HTTP_BAD_REQUEST);
            }
        } 
	}		
	
public function laporankeuanganbyperiode_post(){
		$date = new DateTime();
        $token = $this->post('token');
		$kios_id = $this->post('kios_id');
		$bulan = $this->post('bulan');
		$tahun = $this->post('tahun');

       
		$data = array(
			"status" => false,
			"pesan" => "token tidak boleh kosong" ,
			"data" => null
		);
		
        if(!$token) {$this->response($data, REST_Controller::HTTP_NOT_FOUND);}
        else
        {
            try {
                 if (!$this->cekToken($token)){
                    $data = array(
                        "status" => false,
                        "pesan" => "Expired token",
                        "data" => null);
                    $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
                } else {
                    $admin_id = $cek->id;              
					 
					 $output['status'] = true ;
					 $output['pesan'] = "sukses" ;
					 //pendapatan
					  $pendapatan = $this->db->query(
					 	"SELECT 
					 	COUNT(total_harga) as count, sum(transaksi.diskon) as diskon,
					 	sum(transaksi.total_harga) as total_harga, 
					 	IF(status = 'LUNAS','PENDAPATAN', status) as status 
					 	from transaksi						
					 	where status_order = 0
					 	and transaksi.status = 'LUNAS' 
					 	AND transaksi.kios_id='$kios_id' 
					 	and transaksi.trash = '0'
					 	and (tgl_masuk_uang between '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-01 00:00:01' and '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-31 23:59:59' )					 	"
					 )->row();

					  //setting untuk root count
					  $jml_c_pendapatan = $pendapatan->count;
					  $dapat = "";
					  $pendapatan_diskon = "";
					  $pendapatan_total = "";
					  if($jml_c_pendapatan == ""){
					  	$dapat = "0";
					  	$pendapatan_diskon = "0";
					  	$pendapatan_total = "0";
					  }
					  else if($jml_c_pendapatan != ""){
					  	$dapat = $pendapatan->count;
					  	$pendapatan_diskon = $pendapatan->diskon;
					  	$pendapatan_total = $pendapatan->total_harga;
					  }
					  $pendapatan->count = $dapat;
					  $pendapatan->status = "PENDAPATAN";
					  $pendapatan->diskon = $pendapatan_diskon;
					  $pendapatan->total_harga = $pendapatan_total;

					  $detail_pendapatan = $this->db->query("
							  SELECT l.layanan,round(sum(it.harga*it.kuantitas),0) as total 
							  from transaksi t 

								inner join item_transaksi it on t.id=it.transaksi_id 
								inner join harga_layanan hl on hl.id=it.harga_layanan_id 
								inner join layanan l on l.id=hl.layanan_id

								where t.status_order = 0 
								AND t.kios_id='$kios_id'
								and t.status='LUNAS'  
								and t.trash='0'
					 			and (tgl_masuk_uang between '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-01 00:00:01' and '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-31 23:59:59' ) 
								and status='LUNAS'
								GROUP BY l.layanan
							  
							  ")->result();
					  $pendapatan->detail_pendapatan = $detail_pendapatan;

					  //piutang
					  $piutang = $this->db->query(
					 	"SELECT 
					 	COUNT(total_harga) as count, sum(transaksi.diskon) as diskon,
					 	sum(transaksi.total_harga) as total_harga, 
					 	 status 
					 	from transaksi						
					 	where status_order = 0
					 	and transaksi.status = 'PIUTANG' 
					 	AND transaksi.kios_id='$kios_id' 
					 	and transaksi.trash = '0'
					 	and (tgl_transaksi between '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-01 00:00:01' and '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-31 23:59:59' )					 	"
					 )->row();
					  //setting untuk root count
					  $jml_c_piutang = $piutang->count;
					  $utang = "";
					  $piutang_diskon = "";
					  $piutang_total = "";
					  if($jml_c_piutang == ""){
					  	$utang = "0";
					  	$piutang_diskon = "0";
					  	$piutang_total = "0";
					  }
					  else if($jml_c_pendapatan != ""){
					  	$utang = $piutang->count;
					  	$piutang_diskon = $piutang->diskon;
					  	$piutang_total = $piutang->total_harga;
					  }
					  $piutang->count = $utang;
					  $piutang->status = "PIUTANG";
					  $piutang->diskon = $piutang_diskon;
					  $piutang->total_harga = $piutang_total;

					  $detail_piutang = $this->db->query("
							  SELECT l.layanan,round(sum(it.harga*it.kuantitas),0) as total from 
								transaksi t 
								inner join item_transaksi it on t.id=it.transaksi_id 
								inner join harga_layanan hl on hl.id=it.harga_layanan_id 
								inner join layanan l on l.id=hl.layanan_id

								where t.status_order = 0 
								and t.trash='0'
								AND t.kios_id='$kios_id'
								and t.status='PIUTANG'  
								and (tgl_transaksi between '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-01 00:00:01' and '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-31 23:59:59' ) and status='PIUTANG'
								GROUP BY l.layanan
							  
							  ")->result();
					  $piutang->detail_piutang = $detail_piutang;

					  //gaji
					  $gaji = $this->db->query("SELECT COUNT(nominal) as count,sum(nominal) as total_harga,type,type_pengeluaran_id FROM `pengeluaran` JOIN type_pengeluaran on pengeluaran.type_pengeluaran_id=type_pengeluaran.id WHERE pengeluaran.kios_id='$kios_id' and pengeluaran.type_pengeluaran_id = 1 and (tanggal between '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-01 00:00:01' and '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-31 23:59:59' ) GROUP BY type_pengeluaran_id")->row();
					  //setting untuk root count
					  $jml_c_gaji = $gaji->count;
					  $count_gaji = "";					  
					  $gaji_total = "";
					  if($jml_c_gaji == ""){
					  	$count_gaji = "0";					  	
					  	$gaji_total = "0";
					  }
					  else if($jml_c_pendapatan != ""){
					  	$count_gaji = $gaji->count;					  	
					  	$gaji_total = $gaji->total_harga;
					  }
					  $gaji->count = $count_gaji;
					  $gaji->status = "Gaji";					  
					  $gaji->total_harga = $gaji_total;
					  $gaji->type_pengeluaran_id = "1";

					  $detail_gaji = $this->db->query("
							  select catatan,nominal from pengeluaran where
							  type_pengeluaran_id = 1 and (tanggal between '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-01 00:00:01' and '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-31 23:59:59' )
							  and kios_id ='$kios_id'
							  ")->result();
					  $gaji->detail_gaji = $detail_gaji;

					  //operasional
					  $operasional = $this->db->query("SELECT COUNT(nominal) as count,sum(nominal) as total_harga,type,type_pengeluaran_id FROM `pengeluaran` JOIN type_pengeluaran on pengeluaran.type_pengeluaran_id=type_pengeluaran.id WHERE pengeluaran.kios_id='$kios_id' and pengeluaran.type_pengeluaran_id = 2 and (tanggal between '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-01 00:00:01' and '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-31 23:59:59' ) GROUP BY type_pengeluaran_id")->row();
					  //setting untuk root count
					  $jml_c_operasional = $operasional->count;
					  $count_operasional = "";					 
					  $operasional_total = "";
					  if($jml_c_operasional == ""){
					  	$count_operasional = "0";					  	
					  	$operasional_total = "0";
					  }
					  else if($jml_c_pendapatan != ""){
					  	$count_operasional = $operasional->count;					  	
					  	$operasional_total = $operasional->total_harga;
					  }
					  $operasional->count = $count_operasional;
					  $operasional->status = "Operasional";					  
					  $operasional->total_harga = $operasional_total;
					  $operasional->type_pengeluaran_id = "2";

					  $detail_operasional = $this->db->query("
							  select catatan,nominal from pengeluaran where
							  type_pengeluaran_id = 2 and (tanggal between '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-01 00:00:01' and '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-31 23:59:59' )
							  and kios_id ='$kios_id'
							  ")->result();
					  $operasional->detail_operasional = $detail_operasional;

					  //sewa
					  $sewa = $this->db->query("SELECT COUNT(nominal) as count,sum(nominal) as total_harga,type,type_pengeluaran_id FROM `pengeluaran` JOIN type_pengeluaran on pengeluaran.type_pengeluaran_id=type_pengeluaran.id WHERE pengeluaran.kios_id='$kios_id' and pengeluaran.type_pengeluaran_id = 3 and (tanggal between '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-01 00:00:01' and '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-31 23:59:59' ) GROUP BY type_pengeluaran_id")->row();
					   //setting untuk root count
					  $jml_c_sewa = $sewa->count;
					  $count_sewa = "";					 
					  $sewa_total = "";
					  if($jml_c_sewa == ""){
					  	$count_sewa = "0";					  	
					  	$sewa_total = "0";
					  }
					  else if($jml_c_sewa != ""){
					  	$count_sewa = $sewa->count;					  	
					  	$sewa_total = $sewa->total_harga;
					  }
					  $sewa->count = $count_sewa;
					  $sewa->status = "Sewa";					  
					  $sewa->total_harga = $sewa_total;
					  $sewa->type_pengeluaran_id = "3";

					  $detail_sewa = $this->db->query("
							  select catatan,nominal from pengeluaran where
							  type_pengeluaran_id = 3 and (tanggal between '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-01 00:00:01' and '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-31 23:59:59' )
							  and kios_id ='$kios_id'
							  ")->result();
					  $sewa->detail_sewa = $detail_sewa;

					  //lain-lain
					  $lain_lain = $this->db->query("SELECT COUNT(nominal) as count,sum(nominal) as total_harga,type,type_pengeluaran_id FROM `pengeluaran` JOIN type_pengeluaran on pengeluaran.type_pengeluaran_id=type_pengeluaran.id WHERE pengeluaran.kios_id='$kios_id' and pengeluaran.type_pengeluaran_id = 4 and (tanggal between '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-01 00:00:01' and '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-31 23:59:59' ) GROUP BY type_pengeluaran_id")->row();
					  //setting untuk root count
					  $jml_c_lain = $lain_lain->count;
					  $count_lain = "";					 
					  $lain_total = "";
					  if($jml_c_lain == ""){
					  	$count_lain = "0";					  	
					  	$lain_total = "0";
					  }
					  else if($jml_c_lain != ""){
					  	$count_lain = $lain_lain->count;					  	
					  	$lain_total = $lain_lain->total_harga;
					  }
					  $lain_lain->count = $count_lain;
					  $lain_lain->status = "Lain-Lain";					  
					  $lain_lain->total_harga = $lain_total;
					  $lain_lain->type_pengeluaran_id = "4";
					  $detail_lain_lain = $this->db->query("
							  select catatan,nominal from pengeluaran where
							  type_pengeluaran_id = 4 and 
							  (tanggal between '".substr($start, 0, 10)." 00:00:01' and '".substr($end, 0, 10)." 23:59:59' )
							  and kios_id ='$kios_id'
							  ")->result();
					  $lain_lain->detail_lain_lain = $detail_lain_lain;					  
					  $detail_lain_lain = $this->db->query("
							  select catatan,nominal from pengeluaran where
							  type_pengeluaran_id = 4 and (tanggal between '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-01 00:00:01' and '".sprintf("%02d", $tahun)."-".sprintf("%02d", $bulan)."-31 23:59:59' )
							  and kios_id ='$kios_id'
							  ")->result();
					  $lain_lain->detail_lain_lain = $detail_lain_lain;	  

					  $total_pengeluaran = $gaji->total_harga + $operasional->total_harga + $sewa->total_harga + $lain_lain->total_harga;

					  $laba_bersih = $pendapatan->total_harga - $total_pengeluaran;					  				

					 $output = array(
					     "status" => true,
					     "pesan" => "sukses",
					     "pendapatan" => $pendapatan,
					     "piutang" => $piutang,					     
					     "gaji" => $gaji,
					     "operasional" => $operasional,
					     "sewa" => $sewa,
					     "lain_lain" => $lain_lain,
					     "laba_bersih" => $laba_bersih
					);			
					 
                     $this->set_response($output, REST_Controller::HTTP_OK);
                 }
            } catch (Exception $e) {
                $data = array(
					"status" => false,
					"pesan" => "Invalid token" ,
					"data" => null
				);
				
                $this->set_response($data, REST_Controller::HTTP_BAD_REQUEST);
            }
        }  
	}
?>