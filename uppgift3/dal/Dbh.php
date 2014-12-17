<?php

/* ==|== Database ===============================================================================
	All database related.
   ============================================================================================== */
class Dbh {

	// The main function for the database connection and quering/executing. 
	function dbHandle() {
		try {
			$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS); // Creating the PDO object for db connection.
			$dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, 1); // Extra attributes added to the PDO object.
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Error attributes, if there is an error. Debugging etc.
			return $dbh;
		}
		catch (PDOException $e) {
			print "<br>There was a problem with the DB operation: <br>" . $e->getMessage() . "<br>"; // Catches and shows an error msg if there is any. Good in production environment.
			die();
		}
	}

}

?>