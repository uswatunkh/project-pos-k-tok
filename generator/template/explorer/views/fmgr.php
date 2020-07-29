<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>File explorer using elfinder</title>
	<!-- jQuery and jQuery UI (REQUIRED) -->
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->config->item('assets')?>jquery_ui/jquery-ui.css">
	<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> -->
	<script type="text/javascript" src="<?php echo $this->config->item('assets')?>jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->config->item('assets')?>jquery_ui/jquery-ui.min.js"></script>

	<!-- elFinder CSS (REQUIRED) -->
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->config->item('assets')?>elfinder/css/elfinder.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->config->item('assets')?>elfinder/css/theme.css">

	<!-- elFinder JS (REQUIRED) -->
	<script type="text/javascript" src="<?php echo $this->config->item('assets')?>elfinder/js/elfinder.min.js"></script>

	
	<!-- elFinder initialization (REQUIRED) -->
	<script type="text/javascript" charset="utf-8">
		$().ready(function() {

			var options = {
				resizable:true,
				url : '<?php echo backend_url().this_module()."/elfinder_init" ?>'
			};
			var $elfinder = $('#elfinder').elfinder(options);
			var $window = $(window);
			$window.resize(function(){
			    var win_height = $window.height()-20;
			    if( $elfinder.height() != win_height ){
			        $elfinder.height(win_height).resize();
			    }
			});

		});
	</script>
</head>
<body>		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>
</body>
</html>