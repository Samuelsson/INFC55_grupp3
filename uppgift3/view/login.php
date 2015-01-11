<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object // The file with all functions is required (can't be loaded more than once)
	$controller->getHeader(); // Loads the header before the main content
	

?>


	<!-- The Main Content
	====================================================================== -->

	<div class="container">


	<?php $u1 = $controller->getUser(2);


		//$u1->password = "Hello World2";
		//$u1->save($controller);

		if($controller->checkLogin("eric@epitet.net", "Hello World2"))
			echo "true";
		else
			echo "false";

	 ?>

		<form class="form-login" role="form">
			
			<h2>Supersport administration</h2>
			
			<label for="inputEmail" class="sr-only">E-post</label>
			<input type="email" id="inputEmail" class="form-control" placeholder="E-post" required autofocus>
			
			<label for="inputPassword" class="sr-only">Lösenord</label>
			<input type="password" id="inputPassword" class="form-control" placeholder="Lösenord" required>
			
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