<script src="<?=$this->config->item('assets')?>superbox/js/jquery.superbox.js"></script>
<script>
function delFunction(link){

    $.post(link)
            .done(function(data) {
                $('#myModal').modal('show');
                $('.modal-content').html(data);
        });
    }

 $(".delete-form" ).click(function() { 
        
        var remote = $(this).attr("paman");
        
        $.post(remote)
            .done(function(data) {
                $('#myModal').modal('show');
                $('.modal-content').html(data);
        });
    });

$(function () {
	$('.box-body').SuperBox();
});

</script>
 <!-- 
 * Copyright (c) 2016 indonesiait
 * http://www.indonesiait.com
 * Author:Paman_han
 -->