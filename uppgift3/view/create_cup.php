<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	
	$controller = new Controller; // Creates a controller object
	$controller->setAccessLevel(2);
	$controller -> getHeader(); // Loads the header before the main content

	if( $CURRENT_USER->accessLevel == 9 ) {
		
		$users = $controller->getCupMasters();
	
	} elseif ( $CURRENT_USER->accessLevel == 7 ) {

		$users = $CURRENT_USER;
	}
	$goToURL = $controller->getURL('view/manage_cup.php');
?>
	

	<div class="container-fluid">
		<div class="row">

			<div class="col-md-12">
				<h2>Skapa cup</h2>
				<button id="addDivision" class="btn btn-default">Lägg till division</button>
				<button id="removeDivision" class="btn btn-default">Ta bort division</button>
				<!-- Create cup -->

				<div class="cup-form" id="cup-form">
					<form role="form" action="manage_cup.php" method="POST">
						<div id ="cupSection" class="col-md-12">
							<div class ="form-group">
								<label for="cupName">* Cupnamn</label>
								<input id="cupName" name="name" type="text" class="form-control"  placeholder="Cupnamn" required>
							</div>

							<div class ="form-group">
								<label for="cupYear">* Cup-år</label>
								<input id="cupYear" name="year" type="text" class="form-control"  placeholder="Cup-år" required>
							</div>

							<div class ="form-group">
								<label for="cupDescription">Cupbeskrivning</label>
								<input id="cupDescription" name="description" type="text" class="form-control" placeholder="Cupbeskrivning">
							</div>
					
							<div class="form-group">
								<label for="cupMaster">* Spelledare </label>
							
							<?php
								if(is_array($users) ) {
							?>

									<select id="cupMaster" name="userId">
									<?php
										foreach($users as $u) {
									?>
											<option value= "<?php echo $u->userId; ?>" > <?php echo $u->email ?></option>
									<?php
										}
									?>
								</select>
							<?php
								} else {
							?>

								<input id="userEmail" name="email" type="text" class="form-control" value="<?php echo $users->email ?>" readonly>
								<input id="userId" name="userId" type="hidden" class ="form-control" value="<?php echo $users->userId ?>">
							<?php
								}
							?>
							</div>
						</div>
					
						


						<button type="submit" class="btn btn-default">Skicka</button>

						<div id="divisionSection">
							<div class="division" class="col-md-6">
								<div class ="form-group">
									<label for="divisionName">Divisionsnamn</label>
									<input id="divisionName" name="name1" type="text" class="form-control"  placeholder="Divisionens namn" required>
								</div>

									<div class ="form-group">
									<label for="matchDuration">Matchlängd</label>
									<input id="matchDuration" name="matchDuration1" type="int" class="form-control" placeholder="Matchlängd">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>

<script type="text/javascript">
	$(document).ready(function() {
		var $divisionCount = 1;
		$("#addDivision").click(function() 
			{
				addDivision();
			}	
		);

		$('#removeDivision').click(function()
			{
				removeDivision();
			}
		);

	function addDivision() {
		$('#divisionSection').append(oneDivision());
	}

	function removeDivision() {
		//var lastClass = $('divisionSection').attr('class').split(' ').pop();

	}

	function oneDivision() {
		$divisionCount++;
		$s = '<div class="division" class="col-md-6">'; 
		$s += '<div class ="form-group">';
		$s +='<label for="divisionName">Divisionsnamn</label>';		
		$s += '<input id="divisionName" name="divName' + $divisionCount + '" type="text" class="form-control"  placeholder="Divisionens namn" required>';
				
		$s += '</div><div class ="form-group">';
		$s +='<label for="matchDuration">Matchlängd</label>';
		$s +='<input id="matchDuration" name="matchDuration' + $divisionCount + '" type="int" class="form-control" placeholder="Matchlängd">';
		$s +='</div></div>';
		return $s;
	}
	});

		

	
</script> 