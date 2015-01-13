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
	
				foreach($cup->divisionList as $division) {
					echo '<div>';
						echo '<h2>' . $division->name . '</h2>';
						echo '<h3>Gruppspel</h3>';

						// Table for showing matches from the group stage.
						$playoffList = array();
						$matchList = $division->matchList;
						if(isset($matchList) && !empty($matchList)){
							echo '<div class="table-responsive">';
								echo '<table class="table table-striped">';
									echo '<thead>';
										echo '<tr>';
											echo '<th>Match-tid</th>
												<th>Plan</th>
												<th>Lag</th>
												<th>Resultat</th>';
										echo '</tr>';
									echo '</thead>';
									echo '<tbody>';
									
										foreach($matchList as $m) {
											if($m->type == 'Group') {
												echo '<tr>';
												//First column (start-time and end time) is not finished yet!
													echo '<td>' . substr($m->date, 0, -3) . '</td>';
													echo '<td>' . $m->fieldCode . '</td>';
													echo '<td>' . $m->homeTeam->name . ' - ' . $m->awayTeam->name . '</td>';
													echo '<td>' . $m->homeScore . ' - ' . $m->awayScore . '</td>';
												echo '</tr>';
											} else {
												$playoffList[] = $m;
											}
										}
									
												
									echo '</tbody>';
								echo '</table>';
							echo '</div>';
						} else {
							echo '<p>Här fanns det inga matcher än =/</p>';
						}
						//End group matches

						// Table for showing group result
						echo '<h3>Resultat</h3>';
						$results = $division->teamList;
						
						if(isset($results)){
							echo '<div class="table-responsive">';
								echo '<table class="table table-striped">';
									echo '<thead>';
										echo '<tr>';
											echo '<th>Placering</th>
												<th>Lag</th>
												<th>Vinster</th>
												<th>Oavgjorda</th>
												<th>Förluster</th>
												<th>Gjorda mål</th>
												<th>Insläppta mål</th>
												<th>Målskillnad</th>
												<th>Poäng</th>';
										echo '</tr>';
									echo '</thead>';
									echo '<tbody>';
										foreach($results as $t) {
											echo '<tr>';
											//First column (start-time and end time) is not finished yet!
												echo '<td>' .   '</td>';
												echo '<td>' . $t->name . '</td>';
												echo '<td>' . $t->wins . '</td>';
												echo '<td>' . $t->ties . '</td>';
												echo '<td>' . $t->losses . '</td>';
												echo '<td>' . $t->goalsScored . '</td>';
												echo '<td>' . $t->goalsConceded . '</td>';
												echo '<td>' . ($t->goalsScored-$t->goalsConceded) . '</td>';
												echo '<td>' . $t->points . '</td>';
											echo '</tr>';							
										}			
									echo '</tbody>';
								echo '</table>';
							echo '</div>';
						}
						// End group result

						// Table for showing the playoff stage
						echo '<h3>Slutspel</h3>';
						if(isset($playoffList) && !empty($playoffList)){
							echo '<div class="table-responsive">';
								echo '<table class="table table-striped">';
									echo '<thead>';
										echo '<tr>';
											echo '<th>Match-tid</th>
												<th>Typ</th>
												<th>Plan</th>
												<th>Lag</th>
												<th>Resultat</th>';
										echo '</tr>';
									echo '</thead>';
									echo '<tbody>';
									
										foreach($playoffList as $m){								
											echo '<tr>';
												echo '<td>' . substr($m->date, 0, -3) . '</td>';
												echo '<td>' . $m->type . '</td>';
												echo '<td>' . $m->fieldCode . '</td>';
												echo '<td>' . $m->homeTeam->name . ' - ' . $m->awayTeam->name . '</td>';
												echo '<td>' . $m->homeScore . ' - ' . $m->awayScore . '</td>';
											echo '</tr>';
										}
									
									echo '</tbody>';
								echo '</table>';
							echo '</div>';
						} else {
							echo '<p>Här fanns det inga matcher än =/</p>';
						}
						// End playoff stage


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