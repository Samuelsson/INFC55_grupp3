<?php
	// Config file is always required

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	require_once('inc/functions.php'); // The file with all functions is required (can't be loaded more than once)
	require_once('../model/Cup.php');

	$controller = new Controller; // Creates a controller object
	$controller->checkLoggedInCookie();
	$controller -> getHeader(); // Loads the header before the main content

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-8 col-md-9 main-content">
			<?php
				$cup = $controller->getCupEager($_GET['id']);
				echo "<h1>" . $cup->name . " " . $cup->year . "</h1>";
				echo "<p>" . $cup->description . "</p>";
			?>

			<?php

				foreach($cup->divisionList as $division) { 
					$url = $controller->getURL("view/division_details.php?id=") . $division->divisionId;
			?>
				<!-- Below: No idea what is the best to have here -->
				<div class="col-sm-3 col-md-4 division">
					<a href="<?php echo $url ?>"><h2><?php echo $division->name; ?></h2></a>

				</div>

			<?php
				}
			?>

		</div>
	</div>
		<?php
			$controller->getSidebarRight(); // Gets the sidebar and loads it after the main content
		?>
</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>