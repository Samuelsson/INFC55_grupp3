<?php
	require_once('inc/functions.php');
	get_header();
?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container">
		<div class="row">

			<section class="col-lg-12">

			<?php
				$DBH = db_handle(); // Just for testing the db connection.
			?>

			</section>

		</div>
	</div>

<?php
	get_footer();
?>