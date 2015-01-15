<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content

?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container-fluid">
		<div class="row">

			<div class="col-sm-8 col-md-9 cups main-content">

				<h1>Alla lag</h1>

				<?php 
				$url = $controller->getURL("view/team_details.php?id=");

					foreach($controller->getAllTeams() as $row) { ?>
						<div class="team-image">
							<a href="<?php echo $url . $row['teamId'] ?>"><img src="../img/teams/<?php echo $row['teamId'] ?>.jpg" alt="Bild p&aring; laget"></a>
							<h4><a href="<?php echo $url . $row['teamId'] ?>"><?php echo $row['name']; ?></a></h4>
						</div>

						<?php
					}

				?>
	
			</div>

			<?php
				$controller->getSidebarRight(); // Gets the sidebar and loads it after the main content
			?>

		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>