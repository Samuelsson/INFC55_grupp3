<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	
	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content

	$users =$controller->getCupMasters();

?>
	

	<div class="container-fluid">
		<div class="row">

			<div class="col-md-12">
				<h2>Skapa cup</h2>

				<!-- Create cup -->

				<div class="admin-form" id="cup-form">
					<form>
						<div class="form-group">
							<label for="cupName">* Cupnamn</label>
							<input id="cupName" type="text" class="form-control"  placeholder="Cupnamn" required>
						</div>

						<div class="form-group">
							<label for="cupYear">* Cup-år</label>
							<input id="cupYear" type="text" class="form-control"  placeholder="Cup-år" required>
						</div>

						<div class="form-group">
							<label for="cupDescription">Cupbeskrivning</label>
							<input id="cupDescription" type="text" class="form-control" placeholder="Cupbeskrivning">
						</div>

						<div class="form-group">
							<label for="cupMasterEmail">* Spelledare </label>
							<select id="cupMaster">
							<?php
								foreach($users as $u) {
							?>
									<option value= <?php $u->userId ?> > <?php echo $u->email ?></option>
							<?php
								}
							?>
							</select>
						</div>


						

						<input id="saveCup" type="submit" class="btn btn-default"/>
					</form>
				</div>
			</div>

		</div>
	</div>


	


<script type="text/javascript">
	$(function() {

		// Get everything started by running init function
		initForm();

		/**
		* Inits event handlers on input elements
		*/
		function initForm() {
		//	$('input').keyup(function() { validateForm(); });

			//$('#saveCup').click(function() { saveCup(); });

	//		validateForm();
		}

		
		/**
		* Validate add form
		*/
		function validateForm() {
			if (validateTextInputs())
				toggleSave(true);
			else 
				toggleSave(false);
		}


		function saveCup() {
			var data = [];

			data.push({ cupName: $('#cupName').val(), cupYear: $('#cupYear').val(), cupDescription: $('#cupDescription').val(), $('#cupOwnerEmail') });

			alert($('$cupName').val());
			postAsync(<?php $controller->getURL("view/dtest.php") ?>, data);
		}

		var postAsync = function(url, data) {
			$.ajax({
			  type: "POST",
			  contentType: "application/json",
			  url: url,
			  data:  JSON.stringify(data),
			  dataType: 'JSON',
			  success: function(response) { return reponse; },
			  error: function() { alert('error') }
			});
		}

	});
</script> 