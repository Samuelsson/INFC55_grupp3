<?php

	// Checks if id is set
	if(!isset($_GET['id']) || empty($_GET['id'])) {
		header("Location: teams.php");
		exit;
	}

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	require_once('inc/functions.php'); // The file with all functions is required (can't be loaded more than once)

	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content
?>

	<!-- The Main Content
	====================================================================== -->

	<?php
		$tid = $_GET['id'];
		$team = $controller->getTeam($tid);
		$players = $controller->getPlayersByTeam($tid);
	?>

	<div class="container-fluid">
		<div class="row">

			<div class="col-md-12">

				<h1><?php echo $team->name; ?></h1>

				<p class="team-description"><?php echo $team->description; ?></p>

				<h2>Spelare</h2>

				<?php // Print all players in this team
					foreach ($players as $player) { ?>
					
						<div class="player-img">
							<img src="../img/player_noimg.png" alt="Bild p&aring; spelare"><br>
							<span><?php echo "$player[firstName] $player[lastName]"; ?></span><br>
							<span>Nummer <?php echo $player['number']; ?></span>
						</div>

					<?php }  
				?>

			</div>

		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>