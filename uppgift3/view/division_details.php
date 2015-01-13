<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content

?>

	<!-- The Main Content
	====================================================================== -->

	<?php
		if(isset($_GET['id'])) {
			$did = $_GET['id'];
			$division = $controller->getDivisionEager($did);

			$cup = $division->cup;
			$matchList = $division->matchList;
			$teamList = $division->teamList;

			$playoffList = array();
		}
	?>

	<div class="container-fluid">
		<div class="row">

			<div class="col-sm-8 col-md-9 main-content">
				<h1><?php echo $cup->name . " " . $cup->year ?> </h1>
				<h2><?php echo $division->name ?></h2>
			
				<h3>Gruppspel</h3>
				<div>
					<?php
					if(isset($matchList) && !empty($matchList)){
					?>
						<div class="table-responsive">
							<table class="table table-striped">
								 <thead>
									 <tr>
										 <th>Match-tid</th>
										<th>Plan</th>
										<th>Lag</th>
										<th>Resultat</th>
									</tr>
								</thead>
								<tbody>
									<?php
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
									?>
												
								</tbody>
							</table>
						</div>
						<?php
						} else {
						?>
							<p>Det finns inget spelschema än =/</p>
						<?php
						}
						?>
				</div>

				<h3>Resultat</h3>
				<div>
					<?php
						if(isset($teamList) && !empty($teamList)){
					?>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Placering</th>
									<th>Lag</th>
									<th>Vinster</th>
									<th>Oavgjorda</th>
									<th>Förluster</th>
									<th>Gjorda mål</th>
									<th>Insläppta mål</th>
									<th>Målskillnad</th>
									<th>Poäng</th>
								</tr>
							</thead>
							<tbody>
							<?php	
							foreach($teamList as $t) {			
								echo '<tr>';
								//<!--First column (placement) is not finished yet! -->
								echo '<td>' . '</td>';
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
							?>		
							</tbody>
						</table>
					</div>
					<?php
						} else {
					?>
						<p>Det finns inget resultat än =/</p>
					<?php
						}
					?>
				</div>

				<h3>Slutspel</h3>
				<div>
					<?php
						if(isset($playoffList) && !empty($playoffList)){
					?>
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Match-tid</th>
										<th>Typ</th>
										<th>Plan</th>
										<th>Lag</th>
										<th>Resultat</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach($playoffList as $m){								
											echo '<tr>';
												echo '<td>' . substr($m->date, 0, -3) . '</td>';
												echo '<td>' . $m->type . '</td>';
												echo '<td>' . $m->fieldCode . '</td>';
												echo '<td>' . $m->homeTeam->name . ' - ' . $m->awayTeam->name . '</td>';
												echo '<td>' . $m->homeScore . ' - ' . $m->awayScore . '</td>';
											echo '</tr>';
										}
									?>
								</tbody>
							</table>
						</div>


					<?php
						} else {
					?>
						<p>Det finns inget slutspel än =/</p>
					<?php
						}
					?>

					<?php
					//Raderna nedan skriver ut namnet för vinnaren, tvåan och trean av divisionen.
					//Vinnaren av divisionen finns i variabeln $division->firstPlace som ska vara av typen Team
					echo '<p>Förstaplats: ' . $division->firstPlace->name . "</br>";
					//Tvåan finns $division->secondPlace
					echo 'Andraplats: ' . $division->secondPlace->name . "</br>";
					//Trean finns i $division->thirdPlace
					echo ' Tredjeplats: ' . $division->thirdPlace->name . '</p>';
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
