<?php
	// If no id is specified in the url bar -> redirect back to cups.php
	if(!isset($_GET['id']) || empty($_GET['id'])) {
		header("Location: cups.php");
		exit;
	}

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	require_once('inc/functions.php'); // The file with all functions is required (can't be loaded more than once)
	require_once('../model/Cup.php');

	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content
	
	$cup = $controller->getCupEager($_GET['id']);
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-8 col-md-9 main-content">
			<?php
				echo "<h1>" . $cup->name . " " . $cup->year . "</h1>";
				echo "<p>" . $cup->description . "</p>";
			?>

			<div class="division">

			<?php

				foreach($cup->divisionList as $division) { 
					$url = $controller->getURL("view/division_details.php?id=") . $division->divisionId;
					echo '<h2><a href="' . $url . '">' . $division->name . '</a></h2>';
				}
			?>

			</div>

		</div>
	</div>
		<?php
			$controller->getSidebarRight(); // Gets the sidebar and loads it after the main content
		?>
</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>