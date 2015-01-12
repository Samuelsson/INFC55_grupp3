<?php
	// Config file is always required

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	require_once('inc/functions.php'); // The file with all functions is required (can't be loaded more than once)
	require_once('../model/Cup.php');

	$controller = new Controller; // Creates a controller object
	//$controller->checkLoggedInCookie();
	$controller -> getHeader(); // Loads the header before the main content

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-8 col-md-9 main-content">
			<?php
				$cup = $controller->getCupEager($_GET['id']);
				echo "<h1>" . $cup->name . " " . $cup->year . "</h1>";
				
				foreach($cup->divisionList as $division){
					echo '<div>';
						echo '<h2>' . $division->name . '</h2>';
						echo "Deltagande lag:</br>";
					foreach ($division->teamList as $team) {
						echo $team->name . "</br>";
					}
						echo '<div class="table-responsive">';
							echo '<table class="table table-striped">';
								echo '<thead>';
									echo '<tr>';
										echo '<th>Datum</th>
											<th>Plan</th>
											<th>Lag</th>
											<th>Resultat</th>';
									echo '</tr>';
								echo '</thead>';
								echo '<tbody>';							
								echo '</tbody>';
							echo '</table>';
						echo '</div>';
					echo '</div>';
				
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