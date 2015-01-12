<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object // The file with all functions is required (can't be loaded more than once)
	$controller->checkLoggedInCookie();
	//PHP CODE in before HTML
	if(isset($_GET['logout']))
		$controller->logout();
	if(isset($_POST['email']))  	//Checks if user is logging in.
		$controller->login($_POST['email'], $_POST['pwd']);
	
	$controller->getHeader(); // Loads the header before the main content
	
?>




	<!-- The Main Content
	====================================================================== -->

	<div class="container">

		<form class="form-login" role="form" action="login.php" method="POST">
			
			<h2>Supersport administration</h2>
			<label for="inputEmail" class="sr-only">E-post</label>
			<input type="email" id="inputEmail" name="email" class="form-control" placeholder="E-post" required autofocus>
			
			<label for="inputPassword" class="sr-only">Lösenord</label>
			<input type="password" id="inputPassword" name="pwd" class="form-control" placeholder="Lösenord" required>
			
			<div class="checkbox">
				<label>
					<input type="checkbox" value="remember-me"> Kom ihåg mig
				</label>
			</div>

			<button class="btn btn-lg btn-primary btn-block" type="submit">Logga in</button>

		</form>

	</div> <!-- /container -->

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>