<?php
	require_once('inc/functions.php'); // The file with all functions is required (can't be loaded more than once)

	if (is_null($_GET['team'])) { // prevents the user to access the team_details.php directly without team id.
		redirect_to("teams.php");
	}

	get_header(); // Loads the header before the main content
?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container-fluid">
		<div class="row">

			<div class="col-sm-8 col-md-9 main-content">

				<h1>Team name</h1>

			</div>

		<?php
			get_sidebarright(); // Gets the sidebar and loads it after the main content
		?>

		</div>
	</div>

<?php
	get_footer(); // Loads the footer after the main content
?>