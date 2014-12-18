<?php

class User {

		/**
	*Saves an existing object to the database.
	*Requirements: The object exists in the database
	*The name of the class is singular and the table is plural
	*The class names first letter is Capitalized
	* @param obj object to be saved
	*/
	function save($obj)	{
	 $vars = get_object_vars($obj);
	 $firstKey = key($vars);
	 $firstValue = array_shift($vars);
	 $sqlQuery = "UPDATE " . get_class($obj) . "s SET ";
	 foreach ($vars as $key => $value) {
	 	$sqlQuery = $sqlQuery . "$key='$value', ";
	 }
	 $sqlQuery = trim($sqlQuery, ", ") . " WHERE $firstKey = $firstValue";
	 return $sqlQuery;
	}
}

?>