<?php

/*
 *	functions.php
 *
 *	Here we save all the php functions.
 */

/* ==|== Includes ===============================================================================
	All files that should be included on the homepage, for example Header and Footer.
   ============================================================================================== */

	// Config file is always required
	require('config.php');
	
	// Header on top of all pages
	function get_header() {
		include('header.php');
	}

	// Right sidebar on medium and large screens
	function get_sidebarright() {
		include('sidebar-right.php');
	}

	// Footer on the bottom of all pages
	function get_footer() {
		include('footer.php');
	}


/* ==|== Database ===============================================================================
	All database related.
   ============================================================================================== */
	
	// The main function for the database connection and quering/executing. 
	function db_handle() {
		try {
			$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS); // Creating the PDO object for db connection.
			$dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, 1); // Extra attributes added to the PDO object.
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Error attributes, if there is an error. Debugging etc.
			return $dbh;
		}
		catch (PDOException $e) {
			print "There was a problem with the DB operation: <br>" . $e->getMessage() . "<br>"; // Catches and shows an error msg if there is any.
			die();
		}

	}


/* ==|== Misc ===================================================================================
	Misch stuff.
   ============================================================================================== */


?>