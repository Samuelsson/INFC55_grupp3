<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	require_once('../model/Team.php');
	$controller = new Controller; // Creates a controller object
	$controller->checkLoggedInCookie(); //Checking login status
	$controller -> getHeader(); // Loads the header before the main content


	if ( isset($_POST) && !empty($_POST) ) {
		print_r($_POST);

		/*
		redirect till division_details
		*/

	} elseif( isset($_GET['id']) && !empty($_GET['id']) ) {
		$divisionId = $_GET['id'];

		
		$matches = array();
		$scheduleGenerated = $controller->isScheduleGenerated($divisionId); // Check if the schedule already has been created.
		$groupstageDone = $controller->isStageDone($divisionId, 'groupstageDone'); //groupstage
		$semifinalsDone = $controller->isStageDone($divisionId, 'semifinalsDone'); //semifinals
		$finalsDone = $controller->isStageDone($divisionId, 'finalsDone'); // finals
		
		if ($scheduleGenerated == 0) { // 0 equals false. Therefore we generate it and show it.
			echo "generating schedule";
			$matches = $controller->generateScheduleForDivision($divisionId);
		} elseif ($scheduleGenerated == 1){ //1 equals true. If it already has been created we instead check if the groupstage and semifinals are done
			echo "schedule done";
			if($groupstageDone == 1 && $semifinalsDone == 0) { //if the groupstage is completed, but the semifinals isn't, we get the semifinals.
				echo "groupstage done";
				$count = count($controller->getTeamsForDivision);
				echo $count;
				if($count >= 4) {
					$matches = $controller->calculateSemifinals($divisionId);
				} else {
					echo "Inte tillräckligt många lag för slutspel.";
				}
			} else if ($semifinals == 1 && $finalsDone == 0 ) { //if the semifinals are done, but not the finals, we get the final game and the third-medal-game
				echo "semifinals done";
				$matches = $controller->calculateFinals($divisionId);
			} else if ($finals == 1 ){
				echo "finals done";
				/*
				$redirectURL = $controller->getURL("index.php");
				redirect_to($redirectURL);
				*/
			}
		}	else {
			echo 'Okänt fel';
		} 
	}


	// Page for assigning date, time and field for a division
	


?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="matches-form">
					<?php

					if(isset($matches) && !empty($matches) && is_array($matches) ){
						?>
						<form role="form" action="create_Schedule.php" method="POST">	
							<?php	
							foreach($matches as $m) {
								?>
								<div class="match">
									<label for="match"><?php echo $m->type . ': ' . $m->homeTeam->name . ' - ' . $m->awayTeam->name; ?> </label>

									<div class="form-group" id="match">
										<label for="date">Datum</label>
										 <input type="datetime-local" class="form-control" required>
							
										<label for="field">Plan</label>
										<input type="text" class="form-control" required>
									</div>
								</div>
							<?php
							}
							?>
						<input id="divisionId" name="divisionId" type="hidden" class="form-control" value="<?php echo $cup->cupId ?>">
						<button type="submit" class="btn btn-default">Lägg till</button>
					</form>
					<?php		
					}
					?>
			</div>
		</div>
	</div>
</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>


<script type="text/javascript">
	$(function()) {

		//TODO- methods for gathering the values added

	}



</script>