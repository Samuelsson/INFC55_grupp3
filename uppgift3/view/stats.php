<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object
	$controller->checkLoggedInCookie();
	$controller->setAccessLevel(2);
	$controller -> getHeader(); // Loads the header before the main content

?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container-fluid">
		<div class="row">

		<?php 
		if($controller->setSpecificAccess("7,4,3,")) {
			echo "Sant!";
		}
		else 
			echo "Falskt!";

		echo $controller->accessLink("2,7", "test/test.php", "Test");

		$controller->delete("Users", "userId", "10");
		?>
		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>