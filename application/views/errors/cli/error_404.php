<!doctype html>
<html>
<meta charset="utf-8"> 
<meta content="initial-scale=1, minimum-scale=1, width=device-width" name="viewport"> 
<title>Oops!, The Page you requested was not found!</title> 

<link rel="stylesheet" href="<?php echo $this->config->item('assets')?>AdminLTE/bootstrap/css/bootstrap.min.css">
	
<link rel="stylesheet" href="<?php echo $this->config->item('assets') ?>AdminLTE/dist/css/AdminLTE.min.css">
<style>
	body {
		padding: 10px;
	}
	
	.container {
		max-width: 768px;
		margin-top: 10%;
	}
	
	html,
	code {
		font: 15px/22px arial, sans-serif
	}
	
	ins {
		color: #777;
		text-decoration: none
	}
	
	
	
	@media (max-width:766px){
		.ilustration {
			display: none;
		}
		
		.row {
			background: #FFFEFB;
			padding: 5px;
			border: 1px solid #CCC;
			border-radius: 5px;
		}
	}
	
</style>    
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<img class="ilustration" src="http://www.gentmotors.be/img/404-page-not-found.png" width="230"/>
			</div>
			<div class="col-sm-8">
				<h1> Oops! </h1> 
				<p><ins><i class="glyphicon glyphicon-exclamation-sign"></i> "404 Error" -The Page you requested was not found!</ins></p>
				<br>
				<p>We couldn't find what you were looking for. <ins> Unfortunately the page you were looking for could not be found. It may be temporarily unavailable, moved or no longer exist.</ins></p> 
				<br>
				<p>
					<a href="javascript:history.go(-1)" class="btn btn-info btn-flat">Go to Last Page</a>
				</p> 
			</div>
			
		</div>
	</div>
</body>

</html>