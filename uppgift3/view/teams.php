<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content

?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container-fluid">
		<div class="row">

			<div class="col-md-12">

				<h1>Alla lag</h1>

				<?php 
				$url = $controller->getURL("view/team_details.php?id=");

					foreach($controller->getAllTeams() as $t) { ?>
						<div class="team-image">
							<a href="<?php echo $url . $t->teamId ?>"><img src="../img/teams/<?php echo $t->teamId ?>.jpg" alt="Bild p&aring; laget"></a>
							<h4><a href="<?php echo $url . $t->teamId ?>"><?php echo $t->name; ?></a></h4>
						</div>

						<?php
					}

				?>
	
			</div>

		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>