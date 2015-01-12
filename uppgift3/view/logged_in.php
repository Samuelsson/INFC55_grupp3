<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object // The file with all functions is required (can't be loaded more than once)
	$controller->checkLoggedInCookie();
	$controller->getHeader(); // Loads the header before the main content
	

?>


	<!-- The Main Content
	====================================================================== -->

	<div class="container">
	<center>
	<h1>Du har loggats in</h1>
	</center>
	
		</form>

	</div> <!-- /container -->

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>