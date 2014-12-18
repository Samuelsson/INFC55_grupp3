<?php

class Dal {


	/**
	*Saves an existing object to the database.
	*Requirements: The object exists in the database
	*The name of the class is singular and the table is plural
	*The class names first letter is Capitalized
	* @param obj object to be saved
	*/
	function save($obj)	{
		//This part generates an SQL-string based on the attributes.
		 $vars = get_object_vars($obj);  	//Get all attributes
		 $firstKey = key($vars); 			//Save the primary key
		 $firstValue = array_shift($vars); 			//Save and remove the primary key value
		 $sqlQuery = "UPDATE " . get_class($obj) . "s SET "; 			//Generate the first part, gets the table name.
		 foreach ($vars as $key => $value) {			 //Add the attributes and attribute names to the string.
		 	$sqlQuery = $sqlQuery . "$key='$value', ";
		 }
		 $sqlQuery = trim($sqlQuery, ", ") . " WHERE $firstKey = $firstValue"; 			//Identify the row with the primary key
		 return $sqlQuery;
	}
}
?>