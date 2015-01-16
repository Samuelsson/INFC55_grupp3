<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object // The file with all functions is required (can't be loaded more than once)
	$controller->getHeader(); // Loads the header before the main content

?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container-fluid">
		<div class="row">
			<div class="logged-in">
				<h1>V&auml;lkommen!</h1>
				<h2>Du har loggats in.</h2>
			</div>
		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>