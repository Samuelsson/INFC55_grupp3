<?php

	// Config file is always required
	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content

?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container">
		<div class="row">

			<div class="col-lg-12">
				<h1>Fyra Noll Fyra</h1>
				<p>Hmm, nu blev det lite galet. Prova att g&aring; tillbaka och prova igen.</p>
			</div>

		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>