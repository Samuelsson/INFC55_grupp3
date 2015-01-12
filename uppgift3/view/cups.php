<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	require_once('../model/Cup.php');

	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content

?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container-fluid">
		<div class="row">

			<?php
				$cupList = $controller->getAllCups();
			
				foreach($cupList as $cup) {
					echo '<a href="';
					echo $controller->getURL("view/cup_details.php");
					echo '?id=' . $cup->cupId . '">' . $cup->name . " " . $cup->year . '</a></br>';

				}


			?>
		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>