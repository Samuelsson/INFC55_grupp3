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


		<div class="col-md-12">

			<h1>Cuper</h1>

				<ul class="cups-list">
					<?php
						// This loops all the cups and display them in table view
						$cupList = $controller->getAllCups();

						foreach($cupList as $cup) {
							echo '<li><a href="';
							echo $controller->getURL("view/cup_details.php");
							echo '?id=' . $cup->cupId . '">' . $cup->name . " " . $cup->year . '</a></li>';
						}

					?>
				</ul>

		</div>

		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>