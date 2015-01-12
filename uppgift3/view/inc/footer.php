<?php 

	// Creates a controller object
	$con = new Controller;

?>

	<!-- Footer
	====================================================================== -->

	<footer>
		<div class="container-fluid">
			<div class="row">

				<div class="col-lg-12">
					<hr>
					<p>&copy; Group3 2014 - 2015 <br>
					Created by Group 3 as a school project in INFC55</p>
				</div>

			</div>
		</div>
	</footer>

	<!-- Post site Javascripts
	====================================================================== -->
	<script src="<?php $con->getURL("js/jquery-2.1.1.min.js");?>"></script>
	<script src="<?php $con->getURL("js/bootstrap.min.js");?>"></script>
	<script src="<?php $con->getURL("js/postscripts.js");?>"></script>

</body>
</html>