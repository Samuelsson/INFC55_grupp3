<?php
	require_once('inc/functions.php'); // The file with all functions is required (can't be loaded more than once)
	get_header(); // Loads the header before the main content
?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container">
		<div class="row">

			<section class="col-lg-12">

			<?php
				$dbh = db_handle(); // Just for testing the db connection.
			?>

			</section>

		</div>
	</div>

<?php
	get_footer(); // Loads the footer after the main content
?>