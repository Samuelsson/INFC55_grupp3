<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content

	if(isset($_POST['email'])) {
		$password = md5($_POST['password'] . SALT);
		$values = $arrayName = array('email' => $_POST['email'], 'password' => $password, 'accessLevel' => $_POST['accessLevel']);
		$controller->create("Users", $values);
	}
?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container-fluid">
		<div class="row">

			<div class="col-md-12 admin-area">
				<?php if(isset($_POST['email']))

					echo "<p>Användaren är sparad</p>";
				?>

				<h1>Administration</h1>

				<!-- Create User -->

				<div class="panel panel-default admin-create-user">
					<div class="panel-heading">
						Skapa anv&auml;ndare
					</div>

					<div class="panel-body">


						<div class="admin-form">
							<form method="POST">
								<div class="form-group">
									<label for="email">E-mail</label>
									<input type="text" class="form-control" id="email" name='email' placeholder="Användarens epost/inloggning" required>
								</div>

								<div class="form-group">
									<label for="teamLeaderPassword">L&ouml;senord</label>
									<input type="password" class="form-control" id="password" name="password" placeholder="L&ouml;senord" required>
								</div>

								<div class="form-group">
									<input type="password" class="form-control" id="passwordRepeat" name="passwordRepeat" placeholder="Upprepa l&ouml;senord" required>
								</div>

								<div class="form-group">
									<label for="accessLevel">Klass</label>
									<select class="form-control" id="accessLevel" name="accessLevel">
									<!-- Should be gotten from the DB -->
									<option value="9">Admin</option>
									<option value="7">Cupmaster</option>
									<option value="5">Fieldhost</option>
									<option value="3">Teamowner</option>
									<option value="1">Player</option>
									</select>
								</div>

								<button type="submit" class="btn btn-default">Skapa</button>
							</form>
						</div>
					</div>
				</div>


				<hr>

			</div>

		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>