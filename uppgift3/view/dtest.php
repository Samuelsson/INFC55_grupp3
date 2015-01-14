<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content

?>

<?php
	$divisionId = 4;
	$doubleMeetings = TRUE;

	$teams = $controller->getTeamsForDivision($divisionId);

	



	$matchList = $controller->generateScheduleForDivision($divisionId, $doubleMeetings);


	
?>

	<div class="container-fluid">
		<div class="row">

			<div class="col-md-12">

				
		
				<?php
				
				foreach($teams as $t) {
					echo $t->name . '</br>';
				}
				
				foreach($matchList as $match) {
					echo $match->round . " " . $match->homeTeam->name . " - " . $match->awayTeam->name . "</br>";
				}

				?>



			</div>
		</div>
	</div>



<?php
	$controller->getFooter(); // Loads the footer after the main content
?>