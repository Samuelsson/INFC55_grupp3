<?php

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content

?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container-fluid">
		<div class="row">

			<div class="col-md-12">

			<h1>Lagnamnet</h1>

			<p class="team-description">H&auml;r har vi description om laget. Bacon ipsum dolor amet beef kevin swine hamburger brisket spare ribs pig corned beef flank. Venison picanha turducken boudin pastrami. Spare ribs andouille pig kevin capicola short loin pork ground round salami chicken. Cow shank pancetta pork chop drumstick ham flank.</p>

			<h2>Spelare</h2>

				<div class="player-img">
					<img src="../img/player_noimg.png" alt="Bild p&aring; spelare"><br>
					<span>Olle Braconier</span><br>
					<span>Nummer 12</span>
				</div>

				<div class="player-img">
					<img src="../img/player_noimg.png" alt="Bild p&aring; spelare"><br>
					<span>Olle Braconier</span><br>
					<span>Nummer 12</span>
				</div>

				<div class="player-img">
					<img src="../img/player_noimg.png" alt="Bild p&aring; spelare"><br>
					<span>Olle Braconier</span><br>
					<span>Nummer 12</span>
				</div>

				<div class="player-img">
					<img src="../img/player_noimg.png" alt="Bild p&aring; spelare"><br>
					<span>Olle Braconier</span><br>
					<span>Nummer 12</span>
				</div>

				<div class="player-img">
					<img src="../img/player_noimg.png" alt="Bild p&aring; spelare"><br>
					<span>Olle Braconier</span><br>
					<span>Nummer 12</span>
				</div>

				<div class="player-img">
					<img src="../img/player_noimg.png" alt="Bild p&aring; spelare"><br>
					<span>Olle Braconier</span><br>
					<span>Nummer 12</span>
				</div>

				<div class="player-img">
					<img src="../img/player_noimg.png" alt="Bild p&aring; spelare"><br>
					<span>Olle Braconier</span><br>
					<span>Nummer 12</span>
				</div>

				<div class="player-img">
					<img src="../img/player_noimg.png" alt="Bild p&aring; spelare"><br>
					<span>Olle Braconier</span><br>
					<span>Nummer 12</span>
				</div>

				<div class="player-img">
					<img src="../img/player_noimg.png" alt="Bild p&aring; spelare"><br>
					<span>Olle Braconier</span><br>
					<span>Nummer 12</span>
				</div>

				<div class="player-img">
					<img src="../img/player_noimg.png" alt="Bild p&aring; spelare"><br>
					<span>Olle Braconier</span><br>
					<span>Nummer 12</span>
				</div>

				<div class="player-img">
					<img src="../img/player_noimg.png" alt="Bild p&aring; spelare"><br>
					<span>Olle Braconier</span><br>
					<span>Nummer 12</span>
				</div>

				<div class="player-img">
					<img src="../img/player_noimg.png" alt="Bild p&aring; spelare"><br>
					<span>Olle Braconier</span><br>
					<span>Nummer 12</span>
				</div>
	
			</div>

		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>