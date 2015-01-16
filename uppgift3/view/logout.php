<?php

	// This is a simple page for logging the user out.

	require_once('../controller/controller.php'); // The file with all functions is required (can't be loaded more than once)
	$controller = new Controller; // Creates a controller object // The file with all functions is required (can't be loaded more than once)
	$controller->logout();
	
	header("Location: logged_out.php");
?>