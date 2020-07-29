<script src="<?=$this->config->item('assets')?>General/js/jquery.nestable.min.js"></script>
<script>
   
$(document).ready(function()
{


$('#href').keyup(function(){
    if($(this).val().length!=0){
        $('#base').show('fast');
    }else{
        $('#base').hide('fast');
    }
});

$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass: 'iradio_minimal-blue'
});


<?php
if($privilege['C']=="1"){  echo "CKEDITOR.replace('text');\n"; }
if($privilege['U']=="1"){  echo "\$('.btn-u').removeClass('hidden');\n";  } 
if($privilege['D']=="1"){  echo "\$('.btn-d').removeClass('hidden');\n"; }
?>

    
    $(".select2").select2();

    $(".edit-form" ).click(function() {        
        var link = $(this).attr("goto");   
        $(".loader").load(link);
        $(".callout").addClass('hidden');
<?php if($privilege['C']=="0" && $privilege['U']=="1") { ?>
        $(".lmenu").removeClass("col-md-12");
        $(".lmenu").addClass("col-md-6");
<?php } ?>
      
        return false;
    });    

    $(".btn-delete" ).click(function() { 
        var id = $(this).attr("id");
        var remote = "<?= backend_url().this_module() ?>/delete_action?id="+id;
        
        $.post(remote)
            .done(function(data) {
                $('#myModal').modal('show');
                $('.modal-content').html(data);
        });
    });
   

    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };  
<?php if ($privilege['U']==1) { ?>
    $('#nestable2').nestable({
        group: 1,
        maxDepth : 4
    })
    .on('change', updateOutput);

    updateOutput($('#nestable2').data('output', $('#nestable2-output')));

    $('#nestable-menu').on('click', function(e)
    {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });
<?php } ?>
});
</script>

 <!-- 
 * Copyright (c) 2016 indonesiait
 * http://www.indonesiait.com
 * Author:Paman_han
 -->