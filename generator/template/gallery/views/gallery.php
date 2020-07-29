
<?php

$string = "This page is not configure";
	
if ($this->uri->segment(3)=="") { 
	echo "
		<style type='text/css'>
		.photo {
			background-attachment: local;
			background-position: center center  !important;
			background-repeat: repeat;
			backround-size:cover;
			height: 300px;
			width:230px;
			position: relative;		
			box-shadow: 4px 5px 8px grey;	
		}
		div.desc {
		    padding: 15px;
		    height: 70px;
		    width : 100%;
		    text-align: center;
		    margin-top: 230px;
		    position : absolute;
		    width: 100%
		    background: rgb(50, 50, 50); 
			background: rgba(20, 20, 25, .6);
			color : lemonchiffon;
			font-weight : bold;
			font-size:14px;
		}
		div.desc span{
			color : aqua;
		}
		.hitam{
			background: black !important;
		}
		.pad{
			padding: 15px;
		}
		
		.bottom-nol{
			margin-bottom: 0;
		}
	
		</style>";


	if (count($this->data['album'])==null) {
		$string = "<div class=''> <center> <span>FOUND NO DATA</span> </center></div>";
	}else{
		$string = "";
		$num = 1;
		foreach ($this->data['album'] as $album) {
			$data = $this->wd_db->get_data($this->table_gallery,array('album' => $album['album']));
			$amount = count($data);

			$album_dir = $album['album'];
			if ($album_dir!="") $album_dir="/".$album_dir;
			$folder = "public/gallery".$album_dir."/";
			if ($album['album']=="") $album['album'] = "root_folder";
			$dot = (strlen($album['album'])>25)? "...":"";
			$string .= "
			<div class='col-sm-6 col-md-4 col-lg-3 pad'>
				<a id='goto' href='".base_url().admin_dir().this_module()."/album/".$album['album']."'>
					<div id='$num' onmouseover='hover($num)' onmouseout='out($num)'>
						<div class='thumbnails photo' style=\"background-image: url('".base_url().$folder.$data[0]['file']."')\">
							<div class='desc' id='desc$num' >
								<span>".substr(str_replace("_", " ", $album['album']),0,25).$dot."</span>
								<br>Total $amount file[s]
							</div>
						</div>
					</div>
				</a>
			</div>";
			$num++;
		}
	}

	$a_link = array("/index/datatable","Datatable");


}else{

	$a_link = array("","Home");

	$album_name = $this->uri->segment(4);
	if ($album_name=='') {
		redirect(base_url().admin_dir().this_module(),'refresh');
	}else{
		$folder = ($album_name=="root_folder")?"public/gallery": "public/gallery/$album_name";
		if (!file_exists($folder)) {
			redirect(base_url().admin_dir().this_module(),'refresh');
		}else{
			echo '
			<link href="'.$this->config->item('assets').'superbox/css/superbox.css" rel="stylesheet">
			<style>
				.content-pane{ height: 50px!important; }
				.content-pane div{clip: rect(0px, 430px, 50px, -100px)!important;}
			</style>
			';
			$string = "";
			foreach ($this->data['album'] as $img) {
				$id = $this->urlcrypt->encode($img['id']);
				$visible = ($img['visible']==1)? 'Yes': 'No';
				
				if (	$privilege['D']=="1"	) {
					$dataId = "data-id='". backend_url('gallery/delete_action?id=').$id."&url=/album/$album_name'";
					$hide_del = '';
				} else{ 
					$dataId = '';
					$hide_del = "data-hidedel='hidden'";
				}
				
				if (	$privilege['U']=="1"	) {
					$dataEdit = "data-edit='".base_url().admin_dir().this_module()."/edit?id=$id' ";
					$hide_edit = '' ;
				}else{
					$dataEdit = '';
					$hide_edit = "data-hidedit='hidden'";
				}	
				$string .= "
					<div>
						<img 	$dataEdit	
								$hide_edit

								$dataId
								$hide_del

								data-look='".$visible."' 
								data-label='".str_replace("_", " ", $img['label'] )."'								
								style='max-height:200px'
								src='".base_url()."$folder/thumb/crop_".$img['file']."' 
								data-img='".base_url()."$folder/".$img['file']."' alt=''>
					</div>
				";
			}
		}
	}
}

$albumDir = $this->uri->segment(4);
$albumName = str_replace("_", " ", $albumDir);
?>


<section class="content">
  <?php 
	show_alert('success',$this->session->flashdata('success_message'));
  ?>
  <div class="row">
	
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
		  <h3 class="box-title"><?php if(isset($sub_title)) echo $sub_title; ?></h3>
		   	<span class="tombol-title pull-right">
				<a class='btn btn-s btn-success ' href='<?php echo base_url().admin_dir().this_module().$a_link[0] ?>'><i class='fa fa-eye'></i> <?= $a_link[1] ?></a>
				<?php if($privilege['C']=="1"){ ?>		    	
				<a class="btn btn-s btn-info" href='<?php echo base_url().admin_dir().this_module()."/drop/$albumDir" ?>'> 
					<i class="ion-plus-round"></i> 
					<?= ($albumDir!="")?"Add to Album":"Create New" ?>
				</a>
				<?php } ?>
			</span>
	
			<!-- Modal HTML -->
			<div id="myModal"class="modal fade modal-primary">
				<div class="modal-dialog">
						<div class="modal-content">	
						</div>
				</div>
			</div>	
    
		</div><!-- /.box-header -->
			<div class="box-body" style="<?php echo ($this->uri->segment(3)=="")?"" : "text-align: center"; ?>"> 
		   	 <?php echo str_replace("\n", " ", $string); ?>
		    </div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
	
  </div><!-- /.row -->
</section><!-- /.content -->


 <!-- 
 * Copyright (c) 2016 indonesiait
 * http://www.indonesiait.com
 * Author:Paman_han
 -->
