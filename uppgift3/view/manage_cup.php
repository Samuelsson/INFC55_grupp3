<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	
	$controller = new Controller; // Creates a controller object
	$controller->checkLoggedInCookie();
	$controller->setAccessLevel(2);

	$controller -> getHeader(); // Loads the header before the main content

	if( isset($_POST) && !empty($_POST) ) {
		$arr = array('name' => $_POST['name'], 'year' => $_POST['year'], 'description' => $_POST['description'], 'userId' => $_POST['userId'] );
		$controller->create('Cups', $arr);
	} elseif( !isset($_POST) || empty($_POST) ) {
		echo 'fail';
	}

	if($CURRENT_USER->accessLevel == 2) {
		$cup = $controller->getLatestCupForUser($CURRENT_USER->userId);
	} elseif($CURRENT_USER->accessLevel == 1) {
		$cup = $controller->getLatestCup();
	}
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
				<h2>Hantera cup</h2>
				<h3> <?php echo $cup->name . ' ' . $cup->year ?> </h3>
				<?php echo $CURRENT_USER->email; ?>


				


		</div>
	</div>
</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>