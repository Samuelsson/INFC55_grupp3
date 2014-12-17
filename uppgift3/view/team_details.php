<?php
	require_once('inc/functions.php'); // The file with all functions is required (can't be loaded more than once)

	// Prevents the user to access the team_details.php directly without team id.
	if (!isset($_GET['id']) || empty($_GET['id'])) {
		redirect_to("teams.php"); // if no $_GET the user gets redirected to teams.php
	}

	get_header(); // Loads the header before the main content
?>

<?php
	// The database connection established
	$dbh = db_handle();

	// Our query for this page saved to a variable
	$sql = '
		SELECT * 
		FROM teams 
		WHERE id = :id 
	';

	$sth = $dbh->prepare($sql);
	$sth->execute( array('id' => $_GET['id']));

	$result = $sth->fetchAll(PDO::FETCH_ASSOC);

	// Save all the important information in variables for use later in the HTML code
	foreach($result as $row) {
		$teamName = $row['team_name'];
		$desc = $row['description'];
		$manager = $row['manager'];
		$founded = $row['founded'];
	}
?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container-fluid">
		<div class="row">

			<div class="col-sm-8 col-md-9 main-content">

				<h1><?php echo $teamName; ?></h1>

				<p><?php echo "Grundat: {$founded} och nuvarande manager &auml;r {$manager}."; ?></p>

				<p><?php echo $desc; ?></p>

				<h2>Detta &auml;r en print av v&aring;r array f&ouml;r testning och verifiering</h2>

				<pre>
					<?php
					print_r($result);
					?>
				</pre>

			</div>

		<?php
			get_sidebarright(); // Gets the sidebar and loads it after the main content
		?>

		</div>
	</div>

<?php
	get_footer(); // Loads the footer after the main content
?>