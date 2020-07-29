
      <section class="col-lg-12 ">
        <div class="box box-success">        
            <h3 class="box-title" style="font-weight:400;"><i class="fa fa-bar-chart"></i> DAFTAR KIOS</h3>
            <?php
            foreach($sql_toko as $row){
            	echo "NAMA KIOS : $row->nama || ID_KIOS : $row->id <br />";
            }
            ?>      
          <div class="box-body">
            <div class="box" >
          
            
            </div>
          </div>
        </div>
      </section>

<script type="text/javascript">
$(function () {

});
</script>

