<?php

	// Config file is always required
	require_once('controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object
	$controller -> getHeader(); // Loads the header before the main content

?>

	<!-- The Main Content
	====================================================================== -->

	<div class="container-fluid">
		<div class="row">

			<div class="col-sm-8 col-md-9 main-content">

				<h1>Testsida f&ouml;r Grupp 3</h1>

				<?php 
					$dbh = $controller->getDbh(); // Just for testing the db connection.
				?>

				<div>
					<h2>Division 1</h2>
					<div class="table-responsive">
						<table class="table table-striped">
							
							<thead>
								<tr>
									<th>Placering</th>
									<th>Plan</th>
									<th>Lag</th>
									<th>Resultat</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>1</td>
									<td>3</td>
									<td>AIK - HBK</td>
									<td>2-5</td>
								</tr>
								<tr>
									<td>2</td>
									<td>2</td>
									<td>HIF - Bajslaget</td>
									<td>1-34</td>
								</tr>
								<tr>
									<td>3</td>
									<td>4</td>
									<td>DIF - Coola Laget</td>
									<td>2-2</td>
								</tr>
								<tr>
									<td>4</td>
									<td>1</td>
									<td>Snygga Laget - Fula Laget</td>
									<td>4-5</td>
								</tr>
								<tr>
									<td>5</td>
									<td>2</td>
									<td>The Losers - The Winners</td>
									<td>2-0</td>
								</tr>
							</tbody>

						</table>
					</div>
				</div>

				<div>
					<h2>Division 2</h2>
					<div class="table-responsive">
						<table class="table table-striped">
							
							<thead>
								<tr>
									<th>Placering</th>
									<th>Plan</th>
									<th>Lag</th>
									<th>Resultat</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>1</td>
									<td>3</td>
									<td>AIK - HBK</td>
									<td>2-5</td>
								</tr>
								<tr>
									<td>2</td>
									<td>2</td>
									<td>HIF - Bajslaget</td>
									<td>1-34</td>
								</tr>
								<tr>
									<td>3</td>
									<td>4</td>
									<td>DIF - Coola Laget</td>
									<td>2-2</td>
								</tr>
								<tr>
									<td>4</td>
									<td>1</td>
									<td>Snygga Laget - Fula Laget</td>
									<td>4-5</td>
								</tr>
								<tr>
									<td>5</td>
									<td>2</td>
									<td>The Losers - The Winners</td>
									<td>2-0</td>
								</tr>
							</tbody>

						</table>
					</div>
				</div>

				<div>
					<h2>Division 3</h2>
					<div class="table-responsive">
						<table class="table table-striped">
							
							<thead>
								<tr>
									<th>Placering</th>
									<th>Plan</th>
									<th>Lag</th>
									<th>Resultat</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>1</td>
									<td>3</td>
									<td>AIK - HBK</td>
									<td>2-5</td>
								</tr>
								<tr>
									<td>2</td>
									<td>2</td>
									<td>HIF - Bajslaget</td>
									<td>1-34</td>
								</tr>
								<tr>
									<td>3</td>
									<td>4</td>
									<td>DIF - Coola Laget</td>
									<td>2-2</td>
								</tr>
								<tr>
									<td>4</td>
									<td>1</td>
									<td>Snygga Laget - Fula Laget</td>
									<td>4-5</td>
								</tr>
								<tr>
									<td>5</td>
									<td>2</td>
									<td>The Losers - The Winners</td>
									<td>2-0</td>
								</tr>
							</tbody>

						</table>
					</div>
				</div>

				<div>
					<h2>Division 4</h2>
					<div class="table-responsive">
						<table class="table table-striped">
							
							<thead>
								<tr>
									<th>Placering</th>
									<th>Plan</th>
									<th>Lag</th>
									<th>Resultat</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>1</td>
									<td>3</td>
									<td>AIK - HBK</td>
									<td>2-5</td>
								</tr>
								<tr>
									<td>2</td>
									<td>2</td>
									<td>HIF - Bajslaget</td>
									<td>1-34</td>
								</tr>
								<tr>
									<td>3</td>
									<td>4</td>
									<td>DIF - Coola Laget</td>
									<td>2-2</td>
								</tr>
								<tr>
									<td>4</td>
									<td>1</td>
									<td>Snygga Laget - Fula Laget</td>
									<td>4-5</td>
								</tr>
								<tr>
									<td>5</td>
									<td>2</td>
									<td>The Losers - The Winners</td>
									<td>2-0</td>
								</tr>
							</tbody>

						</table>
					</div>
				</div>

			</div>

		<?php
			$controller->getSidebarRight(); // Gets the sidebar and loads it after the main content
		?>

		</div>
	</div>

<?php
	$controller->getFooter(); // Loads the footer after the main content
?>