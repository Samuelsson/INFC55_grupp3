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

				<h1>Administration</h1>

				<h2>Skapa anv&auml;ndare</h2>

				<!-- Create Team Leader -->

				<div class="admin-form">
					<h3>Skapa spelledare</h3>

					<form>
						<div class="form-group">
							<label for="teamLeaderName">Namn</label>
							<input type="text" class="form-control" id="teamLeaderName" placeholder="Spelledarens namn" required>
						</div>

						<div class="form-group">
							<label for="teamLeaderPassword">L&ouml;senord</label>
							<input type="password" class="form-control" id="teamLeaderPassword" placeholder="L&ouml;senord" required>
						</div>

						<div class="form-group">
							<input type="password" class="form-control" id="teamLeaderPasswordRepeat" placeholder="Upprepa l&ouml;senord" required>
						</div>

						<button type="submit" class="btn btn-default">Skapa</button>
					</form>
				</div>

				<hr>

				<!-- Create Field Host -->

				<div class="admin-form">
					<h3>Skapa planv&auml;rd</h3>

					<form>
						<div class="form-group">
							<label for="fieldHostName">Namn</label>
							<input type="text" class="form-control" id="fieldHostName" placeholder="Planv&auml;rdens namn" required>
						</div>

						<div class="form-group">
							<label for="teamLeaderPassword">L&ouml;senord</label>
							<input type="password" class="form-control" id="fieldHostPassword" placeholder="L&ouml;senord" required>
						</div>

						<div class="form-group">
							<input type="password" class="form-control" id="fieldHostPasswordRepeat" placeholder="Upprepa l&ouml;senord" required>
						</div>

						<button type="submit" class="btn btn-default">Skapa</button>
					</form>
				</div>

			</div>

		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>