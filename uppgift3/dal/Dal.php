<?php

class Dal {


	// The main function for the database connection and quering/executing. 
	private $dbh;

	function __construct() {
		try {
			$dbh = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME, DB_USER, DB_PASS); // Creating the PDO object for db connection.
			$dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, 1); // Extra attributes added to the PDO object.
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Error attributes, if there is an error. Debugging etc.
			$dbh->exec("set names utf8"); // This sets the encoding of all chars from MySQL to UTF8.
			$this->dbh = $dbh;
		}
		catch (PDOException $e) {
			print "<br>There was a problem with the DB operation: <br>" . $e->getMessage() . "<br>"; // Catches and shows an error msg if there is any. Good in production environment.
			die();
		}
	}

	function dbHandle() {
		return $this->dbh;
	}


	/**
	*Saves an existing object to the database.
	*Requirements: The object exists in the database
	*The name of the class is singular and the table is plural
	*The class names first letter is Capitalized
	* @param obj object to be saved
	*/
	function save($obj, $dbh)	{
		//This part generates an SQL-string based on the attributes.
		 $vars = get_object_vars($obj);  	//Get all attributes
		 $firstKey = key($vars); 			//Save the primary key
		 $firstValue = array_shift($vars); 			//Save and remove the primary key value
		 $sqlQuery = "UPDATE " . get_class($obj) . "s SET "; 			//Generate the first part, gets the table name.
		 foreach ($vars as $key => $value) {			 //Add the attributes and attribute names to the string.
		 	$sqlQuery = $sqlQuery . "$key='$value', ";
		 }
		 $sqlQuery = trim($sqlQuery, ", ") . " WHERE $firstKey = $firstValue"; 			//Identify the row with the primary key
		 $query = $dbh->prepare($sqlQuery);
		 $query->execute();
	}

	/**
	 *Inserts a new object in to the DB. 
	 * @param $tableName The name of the table in the DB.
	 * @param $arr Array of the row to be inserted. The key equals the attribute name.
	 */
	function create($tableName, $arr) {
		foreach($arr as $key=>$value) { //generates the keys and value strings.
			$keys .= "" . $key . ",";
			$values .= "'" . $value . "',";
		}
		
		$keys = rtrim("$keys,", ","); //Remove the trailing comma
		$values = rtrim("$values,", ",");
		$sqlQuery = "INSERT INTO $tableName ($keys) VALUES ($values)"; //Build the query.

		$query = $this->dbh->prepare($sqlQuery);
		$query->execute();
	}


	/**
	* Removes a database object.
	* @param $tablenme The table name.
	* @param $idName The Primary key of the table.
	* @param $id The identifying value.
	*/
	function delete($tableName, $idName, $id) {
		$sqlQuery = "DELETE FROM $tableName WHERE $idName = '$id'";
		$query = $this->dbh->prepare($sqlQuery);
		$query->execute();
	}

}
?>