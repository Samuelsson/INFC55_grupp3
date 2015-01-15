<?php

	// Config file is always required
	require_once('controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object
	$controller->checkLoggedInCookie();
	$controller -> getHeader(); // Loads the header before the main content

?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container-fluid">
		<div class="row">

			<div class="col-sm-8 col-md-9 main-content">

				<h1>Välkommen till Supersport</h1>

				<p>Detta är hemsidan för oss alla som älskar fotboll, och framförallt för oss som följer alla cuper och matcher i Malmö Sport. Här kan alla se kommande matcher, information om alla lag, slutresultat, tabeller och mycket mer. Klicka er bara vidare i menyn högst upp.</p>

				<p>Detta är en helt ny hemsida och alla funktioner fungerar inte ännu då slutkund inte har sagt sitt än. Men för tillfället fungerar det mesta helt perfekt och vi hoppas ni gillar denna online-version framför det gamla systemet.</p>

			</div>

		<?php
			$controller->getSidebarRight(); // Gets the sidebar and loads it after the main content
		?>

		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>