<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Database Error</title>
	<style type="text/css">
		body {
 		 background-color: #3c8dbc;
		}
		.error-template {padding: 40px 15px;text-align: center;}
		.error-actions {margin-top:15px;margin-bottom:15px;}
		.error-actions .btn { margin-right:10px; }
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="error-template">
				<h1>Oops!</h1>
				<h2><?php echo $heading; ?></h2>
				<div class="error-details">
					Sorry, an error has occured, <?php echo $message; ?><br>
				</div>
			</div>
		</div>
	</div>
</body>
</html>