
 
 
      <section class='col-lg-12 '>
        <div class='box box-success'>        
            <h4 class='box-title' style='font-weight:400;'><i class='fa fa-bar-chart'></i> Profile</h4> 
                
          <div class='box-body'>
            <div class='box' >

            <style>
              .login-box-msg{
                position:center;
                font-weight : bold;
               color : red;
      
                  }
  </style>

            <!-- tampilan sukses update-->
            <div class='row'>
            <div class='col-lg-4' >
                                <div class='col-lg-3' >
                                    <?=$this->session->flashdata('message');?>
                                    </div>
                                </div>
                                </div>

          <!-- Order Form Start-->


                 
          
            <div class='row'>
                <div class='col-lg-3'></div>
                
                <form method='post' action='<?php echo base_url(). 'Profile/edit'; ?>' enctype='multipart/form-data'>
                <input type='hidden' id='id' name='id'>
                    <div class='col-lg-6'>
                        <div class='login-bg'>
                            <div class='row'>
                                <div class='col-lg-12'>
                                    <div class='logo'>
                                        <a href='#'><img src='img/logo/logo.png' alt='' />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class='row'>
                                <div class='col-lg-8'>
                                    <div class='login-input-head'>
                                        <p ><h4>Nama Pemilik</h4></p>
                                    </div>
                                </div>
                                <div class='col-lg-8'>
                                    <div class='login-input-area'>
                                    
                                    
                                        <input type='text' class='form-control' id='nama' name='nama' value=<?= $user['nama']?>  >
                                        <i class='fa fa-user login-user' aria-hidden='true'></i>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-8'>
                                    <div class='login-input-head'>
                                        <p><h4>Email Pemilik</h4></p>
                                    </div>
                                </div>
                                <div class='col-lg-8'>
                                    <div class='login-input-area'>
                                        <input class='form-control' type='email' id='email' name='email' value=<?= $user['email']?>>
                                        <i class='fa fa-envelope login-user' aria-hidden='true'></i>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-8'>
                                    <div class='login-input-head'>
                                        <p><h4>Alamat</h4></p>
                                    </div>
                                </div>
                                <div class='col-lg-8'>
                                    <div class='login-input-area'>
                                        <input type='text'  class='form-control' id='alamat' name='alamat' value=<?= $user['alamat']?>>
                                        <i class='fa fa-phone login-user' aria-hidden='true'></i>
                                    </div>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-lg-8'>
                                    <div class='login-input-head'>
                                        <p><h4>Password</h4></p>
                                    </div>
                                </div>
                                <div class='col-lg-8'>
                                    <div class='login-input-area'>
                                        <input class='form-control' type='password' id='password' name='password'  >
                                        <i class='fa fa-briefcase login-user' aria-hidden='true'></i>
                                        <p class="login-box-msg"><strong><?php echo $this->session->flashdata('alert') ?></strong></p>
                                        <p class="login-box-msg"><strong><?php echo $this->session->flashdata('alertDua') ?></strong></p>
                                    </div>
                                </div>
                            </div>

                           
                            
          
                           
                            
                            
                            <div class='row'>
                                <div class='col-lg-2'></div>
                                <div class='col-lg-8'>
                                    <div class='col-xs-4'>
                                    
                                    
                                   
                                    <button type='submit'  class='btn btn-primary btn-block btn-flat'  >EDIT</button>
                                     <p></p>
                                     
                                    </div>
                                </div>
                            </div>

                            


                        </div>
                   
                 </div>
                </form>
                
            </div>
           
            
           
   
    <!-- Order Form End-->

    
    




            
            </div>
          </div>
        </div>
      </section>




      <!-- start Edit Profil-->

      
      <div id='custom-width-modal' class='modal fade modal-primary' tabindex='-1' role='dialog' aria-labelledby='custom-width-modalLabel' aria-hidden='true' style='display: none;'>
    <div class='modal-dialog' style='width:40%;'>
        <div class='modal-content'>
            
        <form  method='post' action='<?php echo base_url(). 'Profile/edit'; ?>' name='frmBerita' enctype='multipart/form-data'>  
        <input type='hidden' id='id' name='id'>
        <div class='modal-body'>
                        <div class='box-body'>
                            <div class='row'>
                                <div class='col-lg-12'>
                               <!--     <div class='logo'>
                                        <a href='<?php echo base_url(); ?>horizontal/#'><img src='<?php echo base_url(); ?>horizontal/img/logo/logo.png' alt='' />
                                        </a>
                                    </div>-->
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-12'>
                                    <div class='login-title'>
                                        <center><h1>Edit</h1></center>
                                    </div>
                                </div>
                            </div>
                           
                            <div class='row'>
                                <div class='col-lg-4'>
                                    <div class='login-input-head'>
                                        <p ><h4>Nama Pemilik</h4></p>
                                    </div>
                                </div>
                                <div class='col-lg-8'>
                                    <div class='login-input-area'>
                                    
                                    
                                        <input class='form-control' type='text' id='nama' name='nama'  value=<?= $user['nama']?>  >
                                        <i class='fa fa-user login-user' aria-hidden='true'></i>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>
                                    <div class='login-input-head'>
                                        <p><h4>Email Pemilik</h4></p>
                                    </div>
                                </div>
                                <div class='col-lg-8'>
                                    <div class='login-input-area'>
                                        <input class='form-control'  type='email' id='email' name='email' value=<?= $user['email']?>>
                                        <i class='fa fa-envelope login-user' aria-hidden='true'></i>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>
                                    <div class='login-input-head'>
                                        <p><h4>Alamat</h4></p>
                                    </div>
                                </div>
                                <div class='col-lg-8'>
                                    <div class='login-input-area'>
                                        <input class='form-control' type='text' id='alamat' name='alamat'  value=<?= $user['alamat']?>>
                                        <i class='fa fa-phone login-user' aria-hidden='true'></i>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>
                                    <div class='login-input-head'>
                                        <p><h4>Password</h4></p>
                                    </div>
                                </div>
                                <div class='col-lg-8'>
                                    <div class='login-input-area'>
                                        <input class='form-control' type='text' id='password' name='password' value=<?= $user['password']?> >
                                        <i class='fa fa-briefcase login-user' aria-hidden='true'></i>
                                    </div>
                                </div>
                            </div>
                           
                            
                            <div class='row'>
                                <div class='col-lg-4'></div>
                                <div class='col-lg-8'>
                                <div class='modal-footer'>
                <button type='button' class='btn btn-default waves-effect' data-dismiss='modal'>Tutup</button>
                <button type='submit' class='btn btn-primary waves-effect waves-light'>Simpan</button>
            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>





            
          

<script type='text/javascript'>
$(function () {

});
</script>




