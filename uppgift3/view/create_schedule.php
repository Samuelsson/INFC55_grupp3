<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	require_once('../model/Team.php');
	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content


	// Page for assigning date, time and field for a division
	$matches = $controller->generateScheduleForDivision(4);

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="matches-form">
					<?php

						foreach($matches as $m) {
							echo '<div class="match">' . $m->homeTeam->name . ' - ' . $m->awayTeam->name . '</div>';

							echo '<div class="form-group">';

								echo '<label for="date">Datum</label>';
								echo '<input type="datetime-local" class="form-control" required>';
					
								echo '<label for="field">Plan</label>';
								echo '<input type="text" class="form-control" required>';
							echo '</div>';
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