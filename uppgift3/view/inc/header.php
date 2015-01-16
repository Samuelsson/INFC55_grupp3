<!DOCTYPE html>

<!--
	INFC55 Group 3
	2014
-->

<?php 
	$con = new Controller;
?>

<html lang="en-us">
<head>

	<!-- Basics
	====================================================================== -->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="School assignment Group 3 - Assignment 3">
	<meta name="author" content="Group 3">
	<title>Supersport</title>

	<!-- Stylesheets
	====================================================================== -->
	<link rel="stylesheet" href="<?php echo $con->getURL("css/bootstrap.min.css");?>">
	<link rel="stylesheet" href="<?php echo $con->getURL("css/main.css");?>" <!-- The uncompiled LESS file is css/main.less -->

	<!-- Fonts
	====================================================================== -->
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300'>
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400'>

	<!-- Pre site Javascripts
	====================================================================== -->
	<script src="<?php echo $con->getURL("js/prescripts.js");?>"></script>
	
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Favicons
	====================================================================== -->
	<link rel="shortcut icon" href="<?php echo $con->getURL("img/favicons/favicon.ico");?>">

	<!-- Touch Icons for Smartphones and Tablets -->
	<link rel="icon" sizes="192x192" href="<?php echo $con->getURL("img/favicons/touch-icon-192x192.png");?>">
	<link rel="apple-touch-icon-precomposed" sizes="180x180" href="<?php echo $con->getURL("img/favicons/apple-touch-icon-180x180-precomposed.png");?>">
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo $con->getURL("img/favicons/apple-touch-icon-152x152-precomposed.png");?>">
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo $con->getURL("img/favicons/apple-touch-icon-120x120-precomposed.png");?>">
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo $con->getURL("img/favicons/apple-touch-icon-76x76-precomposed.png");?>">
	<link rel="apple-touch-icon-precomposed" href="<?php echo $con->getURL("img/favicons/apple-touch-icon-precomposed.png");?>">

</head>
<body>

	<!-- Header
	====================================================================== -->

	<header>
	</header>

	<!-- Navigation
	====================================================================== -->

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<a class="navbar-brand" href="<?php echo $con->getURL("index.php");?>">SUPERSPORT</a>
			</div>

			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo $con->getURL("index.php");?>">Hem</a></li>
				<li><a href="<?php echo $con->getURL("view/cups.php");?>">Cupper</a></li>
				<li><a href="<?php echo $con->getURL("view/teams.php");?>">Lag</a></li>
				<li><a href="<?php echo $con->getURL("view/schedule.php");?>">Spelschema</a></li>
				<?php
				global $LOGGED_IN;
				if(!$LOGGED_IN) { //Checks if Login or logged out should be displayed.
					echo "<li><a href='";
					echo $con->getURL("view/login.php"); 
					echo "'>Logga in</a></li>";
				}
				else {
					echo "<li><a href=\"". $con->getURL("view/admin.php"). "\">Administrera</a></li>";
					echo "<li><a href='";
					echo $con->getURL("view/login.php?logout"); 
					echo "'>Logga ut</a></li>";
				}

				?>
				</ul>
			</div>

		</div>
	</nav>
