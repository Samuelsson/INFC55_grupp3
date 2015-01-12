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
			$array = array("email" => "happ@y.s", "password" => "pass", "accessLevel" => "1");
			$controller->create("Users", $array);
		?>
		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>