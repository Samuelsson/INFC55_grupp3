<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content

?>

	<!-- The Main Content
	====================================================================== -->

	<?php
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
		elseif (!isset($_GET['id']) || empty($_GET['id'])) {
			$redirectURL = $controller->getURL("view/cups.php");
			redirect_to($redirectURL);
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
	$controller->getFooter(); // Loads the footer after the main content
?>