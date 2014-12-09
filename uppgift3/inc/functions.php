<?php

/*
 *	functions.php
 *
 *	Here we save all the php functions.
 */

/* ==|== Includes ===============================================================================
	All files that should be included on the homepage, for example Header and Footer.
   ============================================================================================== */
	
	//	Header
	function get_header() {
		include('header.php');
	}

	//	Footer
	function get_footer() {
		include('footer.php');
	}


/* ==|== Database ===============================================================================
	All database related.
   ============================================================================================== */
	
	// The function for the database connection and quering/execute. 
	function db_handle() {
		try {
			$DBH = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS); // The PDO object for db connection.
			$DBH->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, 1); // Attributes added to the PDO object.
			$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Error attributes, if there is an error. Debugging etc.
			return $DBH;
		}
		catch (PDOException $e) {
			print "There is a problem with the DB operation!: <br>" . $e->getMessage() . "<br>"; // Catches and shows an error msg if there is any.
			die();
		}

	}



?>