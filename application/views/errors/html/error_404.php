<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
	function baseurl() {
      	$url_path = "http://"; 
		$url_path .= $_SERVER['SERVER_NAME']."";
		$url_path .= str_replace("index.php", "", $_SERVER['SCRIPT_NAME']);

		return $url_path;
    }
?>

<!doctype html>
<html lang="en"><head>
<meta charset="utf-8">
<title>404</title>
<meta name="author" content="bernX">
<meta name="keywords" content="404, css3, html5, template">
<meta name="description" content="Shipwrecked - Page Template">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Bootstrap CSS -->
<link type="text/css" media="all" href="<?php echo baseurl()?>assets/404/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Template CSS -->
<link type="text/css" media="all" href="<?php echo baseurl()?>assets/404/css/style.css" rel="stylesheet">
<!-- Responsive CSS -->
<link type="text/css" media="all" href="<?php echo baseurl()?>assets/404/css/responsive.css" rel="stylesheet">
<!-- Google Fonts -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,800italic,800,700italic,700,600italic,600,400italic,300" rel="stylesheet" type="text/css">
<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo baseurl()?>assets/404/img/favicon.png">
</head>

<body>
	<!-- Header -->
	<section>
		<div class="container">
			<div class="row">
				<div>
					<h1>404</h1>
					<h2>Page not found</h2>
					<p>It looks like you're lost...</p>
				</div>
			</div>
		</div>
	</section>
	<!-- end Header -->

	<!-- Illustration -->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="illustration">
						<div class="island"></div>
						<div class="char"></div>
						<div class="hand"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end Illustration -->

	<!-- Button -->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<a href="<?php echo baseurl() ?>"><div class="btn btn-action">Take me out of here</div></a>
				</div>
			</div>
		</div>
	</section>
	<!-- end Button -->

	<!-- Footer -->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<p>Copyright &copy; CV.Indonesia IT All Rights Reserved.</p>
				</div>
			</div>
		</div>
	</section>
	<!-- end Footer -->

	<!-- Scripts -->
	<script src="<?php echo baseurl()?>assets/404/js/jquery-1.11.2.min.js" type="text/javascript"></script>
	<script src="<?php echo baseurl()?>assets/404/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>



</body></html>
