<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	
	$controller = new Controller; // Creates a controller object
	$controller->checkLoggedInCookie();
	$controller->setAccessLevel(2);
	$controller -> getHeader(); // Loads the header before the main content

	if( $CURRENT_USER->accessLevel == 1 ) {
		
		$users = $controller->getCupMasters();
	
	} elseif ( $CURRENT_USER->accessLevel == 2 ) {

		$users = $CURRENT_USER;
		echo $controller->CURRENT_USER->email;
		echo $controll->CURRENT_USER->userId;
	}
	$goToURL = $controller->getURL('view/manage_cup.php');
?>
	

	<div class="container-fluid">
		<div class="row">

			<div class="col-md-12">
				<h2>Skapa cup</h2>

				<!-- Create cup -->

				<div class="cup-form" id="cup-form">
					<form role="form" action="manage_cup.php" method="POST">
						
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
							<label for="user">* Spelledare </label>
						
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
					

						<button type="submit" class="btn btn-default">Skicka</button>
					</form>
				</div>
			</div>

		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>

<script type="text/javascript">
	$(function() {

		// Get everything started by running init function
		initForm();

		function initForm() {
		

		//	$('#saveCup').click(function() { saveCup(); });

		}
		

		function saveCup() {
			alert('Somethin"');
			var $cupName = $('#cupName').val();
			var $cupYear = $('#cupYear').val();
			var $cupDescription = $('#cupDescription').val();
			var $userId = $('#cupMaster').val();

			var data = {cupName: $cupName, cupYear: $cupYear, cupDescription: $cupDescription, userId: $userId};

			for(var key in data) {
				alert("key " + key + " has value " + data[key]);
			}
		}

		var postAsync = function(url, data) {
			$.ajax({
				type: "POST",
				contentType: "application/json",
				url: url,
				data: JSON.stringify(data),
				dataType: "JSON",
				success: function(response) { return response; },
				error: function() { alert("error"); }
			})
		}

	});
</script> 