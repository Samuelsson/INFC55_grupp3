<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object
	$controller->checkLoggedInCookie();
	$controller -> getHeader(); // Loads the header before the main content

?>

	<!-- The Main Content
	====================================================================== -->

	<?php
		if(isset($_POST['homeTeam'])) {
			$mob = $controller->getMatch($_GET['id']);
			$mob->homeScore = $_POST['homeTeam'];
			$mob->awayScore = $_POST['awayTeam'];
			$mob->status = "finished";
			$mob->save($controller);
		}

		if(isset($_GET['id']) && !empty($_GET['id']) ) {
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

				<h1>Matchresultat</h1>

				<div class="match-details">

					<table>
						<tbody>
							<tr>
								<!-- Home Team -->
								<td class="match-details-first-row"><?php echo $t . $homeTeam->teamId. '">' . $homeTeam->name . '</a>'; ?></td>
								<td><?php echo $match->homeScore; ?></td>
							</tr>
							<tr>
								<!-- Away Team -->
								<td class="match-details-first-row"><?php echo $t . $awayTeam->teamId. '">' . $awayTeam->name . '</a>'; ?></td>
								<td><?php echo $match->awayScore; ?></td>
							</tr>
						</tbody>
					</table>
				</div>

				<p>Ur <?php echo $d . $division->divisionId . '">' . $division->name . '</a>'; ?> spelad i <?php echo $c . $cup->cupId . '">' . $cup->name . '</a>'; ?></p>

			</div>
		</div>
	</div>


<?php 	
		if($controller->setSpecificAccess("3,7,9")) {
	?>
		<h2>Lagra resultat</h3>
			<form method="POST" action="<?php echo "match_details.php?id=" . $_GET['id']; ?>">
				<div class="form-group">
					<label for="homeTeam"><?php echo $homeTeam->name; ?></label>
					<input type="number" class="form-control" id="homeTeam" name="homeTeam" placeholder="Resultat" required>
				</div>

				<div class="form-group">
					<label for="awayTeam"><?php echo $awayTeam->name; ?></label>
					<input type="number" class="form-control" id="awayTeam" name="awayTeam" placeholder="Resultat" required>
				</div>


				<button type="submit" class="btn btn-default">Spara</button>
			</form>
	<?php 
		}
	?>
<?php
	$controller->getFooter(); // Loads the footer after the main content
?>