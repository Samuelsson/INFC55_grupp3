<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content

?>

	<!-- The Main Content
	====================================================================== -->

	<?php
		if(isset($_GET['id'])) {
			$mid = $_GET['id'];
			$match = $controller->getMatchEager($mid);

			$division = $match->division;
			$cup = $division->cup;
			$homeTeam = $match->homeTeam;
			$awayTeam = $match->awayTeam;

			$c ='<a href="' . $controller->getURL("view/cup_details.php") . '?id=';	
			$d ='<a href="' . $controller->getURL("view/division_details.php") . '?id=';	
			$t ='<a href="' . $controller->getURL("view/team_details.php") . '?id=';	
		}
	?>


	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php echo $c . $cup->cupId . '">' . $cup->name . '</a> ' . $d . $division->divisionId . '">' . $division->name . '</a>'; ?>

				<div id="match">
					<?php 
					
						echo $t . $homeTeam->teamId. '">' . $homeTeam->name . '</a>' . $match->homeScore . ' -  '. $match->awayScore  . $t . $homeTeam->teamId .  '">' . $awayTeam->name . '</a></br>';
					

					?>
				</div>




			</div>
		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>