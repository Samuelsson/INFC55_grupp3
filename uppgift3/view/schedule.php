<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content

?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container-fluid">
		<div class="row">

			<div class="col-sm-8 col-md-9 cups main-content">
			</div>

			<?php
				$controller->getSidebarRight(); // Gets the sidebar and loads it after the main content
			?>

		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>