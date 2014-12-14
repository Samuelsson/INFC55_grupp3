<?php
	require_once('inc/functions.php'); // The file with all functions is required (can't be loaded more than once)
	get_header(); // Loads the header before the main content
?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container">

		<form class="form-login" role="form">
			
			<h2>Supersport administration</h2>
			
			<label for="inputEmail" class="sr-only">E-post</label>
			<input type="email" id="inputEmail" class="form-control" placeholder="E-post" required autofocus>
			
			<label for="inputPassword" class="sr-only">L&ouml;senord</label>
			<input type="password" id="inputPassword" class="form-control" placeholder="L&ouml;senord" required>
			
			<div class="checkbox">
				<label>
					<input type="checkbox" value="remember-me"> Kom ih&aring;g mig
				</label>
			</div>

			<button class="btn btn-lg btn-primary btn-block" type="submit">Logga in</button>

		</form>

	</div> <!-- /container -->

<?php
	get_footer(); // Loads the footer after the main content
?>