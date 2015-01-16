<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	
	$controller = new Controller; // Creates a controller object
	$controller->checkLoggedInCookie();
	$controller->setAccessLevel(7);

	$controller -> getHeader(); // Loads the header before the main content

	if( isset($_POST) && !empty($_POST) ) {
			if(count($_POST)  == 3) {
				unset($_POST['cupId']);
				$controller->create("DivisionTeam", $_POST);

				$cup = $controller->getCupEager($_GET['id']);
				$divisions = $cup->divisionList;
				$cupMaster = $cup->cupMaster;
			} elseif(count($_POST) > 3) {
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

	$goToURL = $controller->getURL("view/manage_cup.php") . '?id=' . $cup->cupId;

	$availableTeams = $controller->getAllTeamsNotInCup($cup->cupId);

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 main-content">
			<div class="col-md-3">
				<h2>Hantera cup</h2>
				<h3> <?php echo $cup->name . ' ' . $cup->year ?> </h3>
				<?php echo 'Spelledare: ' . $cupMaster->email ; ?>
			</div>
			<div class="col-md-6">
				<div class="addTeamToDivision-form" id="addTeamToDivision-form">
					<form role="form" action="<?php echo $goToURL ?>" method="POST">
						<div class ="form-group">
							<label for="division">Division</label>
							<select id="division" name="divisionId">
								<?php
									foreach($divisions as $d) {
								?>
										<option value= "<?php echo $d->divisionId; ?>" > <?php echo $d->name ?></option>
								<?php
										}
								?>
							</select>
						</div>

						<div class ="form-group">
							<label for="team">Lag</label>
							<select id="team" name="teamId">
								<?php
									foreach($availableTeams as $t) {
								?>
									<option value= "<?php echo $t->teamId; ?>" > <?php echo $t->name ?></option>
								<?php
									}
								?>
							</select>
						</div>
						<input id="cupId" name="cupId" type="hidden" class="form-control" value="<?php echo $cup->cupId ?>">
						<button type="submit" class="btn btn-default">Lägg till</button>
					</form>
				</div>

			</div>
			<div class="col-md-12">
				<?php
				foreach($divisions as $d) {
				?>
					<div class="col-md-3">
						<h3><?php echo $d->name; ?></h3></a>
						<?php
						$d->teamList = $controller->getTeamsForDivision($d->divisionId);
						
						if(isset($d->teamList) && !empty($d->teamList));
						foreach($d->teamList as $t) {
						?>
							<div class="teamList">
								<div class="team">
									<?php echo $t->name ?>
								</div>
							</div>
						<?php
						}
						?>

					</div>
				<?php
				}
				?>
			</div>


		</div>
	</div>
</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>