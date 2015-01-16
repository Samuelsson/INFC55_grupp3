<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content

	if(isset($_POST['name'])) {
		$password = md5($_POST['password'] . SALT);
		echo $password;
		$values = $arrayName = array('email' => $_POST['email'], 'password' => $password, 'accessLevel' => $_POST['accessLevel']);
		$controller->create("Users", $values);
		echo "Done";
	}
?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container-fluid">
		<div class="row">

			<div class="col-md-12">

				<h1>Administration</h1>

				<h2>Skapa anv&auml;ndare</h2>

				<!-- Create Team Leader -->

				<div class="admin-form">
					<h3>Skapa användare</h3>

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

				<hr>

				<!-- Create Field Host -->

				<div class="admin-form">
					<h3>Skapa planv&auml;rd</h3>

					<form>
						<div class="form-group">
							<label for="fieldHostName">Namn</label>
							<input type="text" class="form-control" id="fieldHostName" placeholder="Planv&auml;rdens namn" required>
						</div>

						<div class="form-group">
							<label for="teamLeaderPassword">L&ouml;senord</label>
							<input type="password" class="form-control" id="fieldHostPassword" placeholder="L&ouml;senord" required>
						</div>

						<div class="form-group">
							<input type="password" class="form-control" id="fieldHostPasswordRepeat" placeholder="Upprepa l&ouml;senord" required>
						</div>

						<button type="submit" class="btn btn-default">Skapa</button>
					</form>
				</div>

			</div>

		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>