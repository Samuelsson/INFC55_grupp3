<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	require_once('../model/Cup.php');

	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content

?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container-fluid">
		<div class="row">

			<div class="col-sm-8 col-md-9 cups main-content">

				<h1>Cuper</h1>

				<div class="cups-all">
					<table>
					
					<?php
						// This loops all the cups and display them in table view
						$cupList = $controller->getAllCups();

						foreach($cupList as $cup) {
							echo "<tr>";
							echo '<td class="cups-first-row"><a href="' . $controller->getURL("view/cup_details.php") . '?id=' . $cup->cupId . '">' . $cup->name . '</a></td>';
							echo '<td>' . $cup->year . '</td>';
							echo "</tr>";
						}
					?>

					</table>
				</div>
			
			</div>

			<?php
				$controller->getSidebarRight(); // Gets the sidebar and loads it after the main content
			?>

		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>