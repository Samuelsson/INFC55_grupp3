<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	
	$controller = new Controller; // Creates a controller object
	$controller->checkLoggedInCookie();
	$controller->setAccessLevel(2);

	$controller -> getHeader(); // Loads the header before the main content

	if( isset($_POST) && !empty($_POST) ) {
		$cupArr = array('name' => $_POST['name'], 'year' => $_POST['year'], 'description' => $_POST['description'], 'userId' => $_POST['userId'] );

		$theRest = $_POST;
		unset($theRest['name']);
		unset($theRest['year']);
		unset($theRest['description']);
		unset($theRest['userId']);
		unset($theRest['email']);

		$divisionArr = array_chunk($theRest, 2, true);

		$controller->createCupWithDivisions($cupArr, $divisionArr);
		if($CURRENT_USER->accessLevel >= 7) {
			$cup = $controller->getLatestCupForUser($cupArr['userId']);
			$redirectURL = $controller->getURL("view/manage_cup.php") . '?id=' . $cup->cupId;
			redirect_to($redirectURL);
		} 
	} elseif( isset($_GET) || !empty($_GET) ) {
		if($CURRENT_USER->accessLevel >= 7) {
			$cup = $controller->getCupEager($_GET['id']);
			$divisions = $cup->divisionList;
			$cupMaster = $cup->cupMaster;
		} else {
			echo "Du har inte behörighet hit";
		}
	} elseif( !isset($_POST) || empty($_POST) ) {
		echo 'Något gick precis väldigt fel =(';
	}


?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
				<h2>Hantera cup</h2>
				<h3> <?php echo $cup->name . ' ' . $cup->year ?> </h3>
				<?php echo 'Spelledare: ' . $cupMaster->email ; ?>

				<?php
				foreach($divisions as $d) {
					echo $d->name;

				}
				?>


		</div>
	</div>
</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>